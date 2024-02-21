<?php

namespace DDD\Http\Crawls;

use DDD\App\Controllers\Controller;
// Models
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;
use DDD\Domain\Crawls\Crawl;
// Services
use DDD\Domain\Crawls\Resources\CrawlResultResource;
// Resources
use DDD\Domain\Organizations\Organization;

class CrawlResultsController extends Controller
{
    public function show(Organization $organization, Crawl $crawl, Crawler $crawler)
    {
        $results = $crawler->getResults($crawl->results_id);

        return CrawlResultResource::collection($results);
    }
}
