<?php

namespace DDD\Http\Redirects;

use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;
// Models
use DDD\Domain\Organizations\Organization;

class RedirectImportController extends Controller
{
    public function import(Organization $organization, Crawl $crawl, Crawler $crawler): JsonResponse
    {
        $results = $crawler->getResults($crawl->results_id);

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

        return response()->json([
            'message' => 'Crawl results imported.',
        ]);
    }
}
