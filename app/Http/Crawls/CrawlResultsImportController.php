<?php

namespace DDD\Http\Crawls;

use DDD\App\Controllers\Controller;
use DDD\App\Services\Crawler\CrawlerInterface as Crawler;
// Models
use DDD\App\Services\UrlService;
use DDD\Domain\Crawls\Crawl;
// Services
use DDD\Domain\Organizations\Organization;
use Illuminate\Http\JsonResponse;

class CrawlResultsImportController extends Controller
{
    public function import(Organization $organization, Crawl $crawl, Crawler $crawler): JsonResponse
    {
        $results = $crawler->getResults($crawl->results_id);

        // Import clean, unique items as pages
        foreach ($results as $result) {
            $cleanDestinationUrl = UrlService::getClean($result['destination_url']);

            $organization->pages()->updateOrCreate(
                ['url' => $cleanDestinationUrl],
                [
                    'http_status' => $result['http_status'],
                    'title' => $result['title'],
                    'wordcount' => $result['wordcount'],
                    'url' => $cleanDestinationUrl,
                ]
            );
        }

        // Import redirects
        foreach ($results as $result) {
            if ($result['redirected']) {
                $organization->redirects()->updateOrCreate(
                    ['requested_url' => $result['requested_url']],
                    [
                        'title' => $result['title'],
                        'requested_url' => $result['requested_url'],
                        'destination_url' => $result['destination_url'],
                        'group' => 'Old Website',
                    ]
                );
            }
        }

        return response()->json([
            'message' => 'Crawl results imported.',
        ]);
    }
}
