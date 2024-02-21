<?php

namespace DDD\Http\Media;

use Illuminate\Http\JsonResponse;
use DDD\App\Controllers\Controller;
use DDD\Domain\Media\Media;
// Vendors
use DDD\Domain\Media\Requests\StoreMediaRequest;
// Models
use DDD\Domain\Media\Resources\MediaResource;
use DDD\Domain\Organizations\Organization;
// Requests
use Illuminate\Http\Request;
// Resources
use Spatie\QueryBuilder\QueryBuilder;

class MediaController extends Controller
{
    public function index(Organization $organization, Request $request)
    {
        $media = QueryBuilder::for(Media::class)
            ->where('model_id', $organization->id)
            ->allowedFilters(['tags.slug'])
            ->with('tags')
            ->latest()
            ->get();

        return MediaResource::collection($media);
    }

    public function store(Organization $organization, StoreMediaRequest $request)
    {
        $media = $organization
            ->addMedia($request->file)
            ->toMediaCollection($request->collection);

        return new MediaResource($media->load('tags'));
    }

    public function show(Organization $organization, Media $media)
    {
        return new MediaResource($media->load('tags'));
    }

    public function destroy(Organization $organization, Media $media): JsonResponse
    {
        $media->delete();

        return response()->json(['message' => 'Media destroyed'], 200);
    }
}
