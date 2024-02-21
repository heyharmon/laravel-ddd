<?php

namespace DDD\Http\Crawls;

use DDD\App\Controllers\Controller;
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;
// Models
use DDD\Domain\Crawls\Crawl;
use DDD\Domain\Crawls\Jobs\CheckCrawlStatusJob;
// Services
use DDD\Domain\Crawls\Requests\CrawlStoreRequest;
// Jobs
use DDD\Domain\Crawls\Resources\CrawlResource;
// Requests
use DDD\Domain\Organizations\Organization;
// Resources
use Illuminate\Http\JsonResponse;

class CrawlController extends Controller
{
    public function index(Organization $organization)
    {
        $crawls = $organization->crawls()->latest()->get();

        return CrawlResource::collection($crawls);
    }

    public function store(Organization $organization, CrawlStoreRequest $request, Crawler $crawler): JsonResponse
    {
        $service = $crawler->crawlSite($request->url);

        $crawl = $organization->crawls()->create([
            'url' => $request->url,
            'crawl_id' => $service['crawl_id'],
            'queue_id' => $service['queue_id'],
            'results_id' => $service['results_id'],
        ]);

        dispatch(new CheckCrawlStatusJob($crawl));

        return response()->json([
            'message' => 'Crawl in progress',
            'data' => new CrawlResource($crawl),
        ]);
    }

    public function show(Organization $organization, Crawl $crawl)
    {
        return new CrawlResource($crawl);
    }

    public function destroy(Organization $organization, Crawl $crawl, Crawler $crawler): JsonResponse
    {
        $crawler->abortCrawl($crawl->crawl_id);

        return response()->json([
            'message' => 'Crawl aborted.',
        ]);
    }
}
