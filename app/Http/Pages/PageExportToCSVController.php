<?php

namespace DDD\Http\Pages;

use DDD\App\Controllers\Controller;
use DDD\Domain\Organizations\Organization;
// Vendors

// Models
use Illuminate\Http\Request;

class PageExportToCSVController extends Controller
{
    public function export(Organization $organization, Request $request)
    {
        $fileName = $organization->slug.'-pages.csv';

        $pages = $organization->pages()->latest()->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Title', 'Url', 'Category', 'Wordcount'];

        $callback = function () use ($pages, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pages as $page) {
                $row['Title'] = $page->title;
                $row['Url'] = $page->url;
                $row['Category'] = $page->category ? $page->category->title : 'Uncategorized';
                $row['Wordcount'] = $page->wordcount;

                fputcsv($file, [
                    $row['Title'],
                    $row['Url'],
                    $row['Category'],
                    $row['Wordcount'],
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
