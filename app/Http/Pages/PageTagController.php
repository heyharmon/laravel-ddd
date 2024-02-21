<?php

namespace DDD\Http\Pages;

use DDD\App\Controllers\Controller;
use DDD\Domain\Pages\Page;
// Models
use DDD\Domain\Sites\Site;
use Illuminate\Http\Request;

class PageTagController extends Controller
{
    public function tag(Site $site, Page $page, Request $request)
    {
        $page->tag(['accounts', 'checking']);

        return response()->json($page->tags);
    }

    public function untag(Site $site, Page $page, Request $request)
    {
        $page->untag();

        return response()->json($page->tags);
    }

    public function retag(Site $site, Page $page, Request $request)
    {
        $page->retag(['checking', 'share']);

        return response()->json($page->tags);
    }
}
