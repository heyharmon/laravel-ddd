<?php

namespace DDD\Http\Redirects;

use DDD\App\Controllers\Controller;
use DDD\Domain\Organizations\Organization;
// Models
use Illuminate\Http\JsonResponse;

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
