<?php

namespace DDD\Http\Pages;

use DDD\App\Controllers\Controller;
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Pages\Page;
// Vendors
use DDD\Domain\Pages\Requests\PageStoreRequest;
use DDD\Domain\Pages\Resources\PageResource;
// Models
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// Requests
use Spatie\QueryBuilder\AllowedFilter;
// use DDD\Domain\Pages\Requests\PageUpdateRequest;

// Resources
use Spatie\QueryBuilder\QueryBuilder;

class PageController extends Controller
{
    public function index(Organization $organization)
    {
        $pages = QueryBuilder::for(Page::class)
            ->where('organization_id', $organization->id)
            ->with(['category', 'status'])
            ->allowedFilters([
                'category.slug',
                'status.slug',
                AllowedFilter::trashed(),
            ])
            ->latest()
            ->get();

        return PageResource::collection($pages);
    }

    public function store(Organization $organization, PageStoreRequest $request)
    {
        $page = $organization->pages()->create(
            $request->validated()
        );

        return new PageResource($page->load(['status', 'category', 'user']));
    }

    public function show(Organization $organization, Page $page)
    {
        return new PageResource($page->load(['status', 'category', 'user']));
    }

    public function update(Organization $organization, Request $request): JsonResponse
    {
        $pages = Page::whereIn('id', $request->ids)->get();

        foreach ($pages as $page) {
            $page->update($request->except('ids'));
        }

        return response()->json([
            'message' => 'Pages successfully updated.',
        ], 200);
    }

    public function destroy(Organization $organization, Request $request): JsonResponse
    {
        Page::whereIn('id', $request->ids)->delete();

        return response()->json([
            'message' => 'Pages successfully deleted.',
        ], 200);
    }
}
