<?php

namespace DDD\Http\Designs;

use DDD\App\Controllers\Controller;
use DDD\Domain\Designs\Design;
// Models
use DDD\Domain\Media\Resources\MediaResource;
use DDD\Domain\Organizations\Organization;
// Resources
use Illuminate\Http\Request;

class DesignMediaController extends Controller
{
    public function store(Organization $organization, Design $design, Request $request)
    {
        // TODO: Add a request class to this
        $media = $design
            ->addMedia($request->file)
            ->toMediaCollection('fonts');

        return new MediaResource($media->load('tags'));
    }
}
