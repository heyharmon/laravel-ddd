<?php

namespace DDD\Http\Pages;

use DDD\App\Controllers\Controller;
use DDD\Domain\Pages\Page;
use DDD\Domain\Sites\Site;
// Models
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageTagController extends Controller
{
    public function tag(Site $site, Page $page, Request $request): JsonResponse
    {
        $page->tag(['accounts', 'checking']);

        return response()->json($page->tags);
    }

    public function untag(Site $site, Page $page, Request $request): JsonResponse
    {
        $page->untag();

        return response()->json($page->tags);
    }

    public function retag(Site $site, Page $page, Request $request): JsonResponse
    {
        $page->retag(['checking', 'share']);

        return response()->json($page->tags);
    }
}
