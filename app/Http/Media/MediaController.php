<?php

namespace DDD\Http\Media;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Vendors
use Spatie\QueryBuilder\QueryBuilder;

// Models
use DDD\Domain\Organizations\Organization;
use DDD\Domain\Media\Media;

// Requests
use DDD\Domain\Media\Requests\StoreMediaRequest;

// Resources
use DDD\Domain\Media\Resources\MediaResource;

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

    public function destroy(Organization $organization, Media $media)
    {
        $media->delete();

        return response()->json(['message' => 'Media destroyed'], 200);
    }
}
