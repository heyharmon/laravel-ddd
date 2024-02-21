<?php

namespace DDD\Http\Designs;

use DDD\App\Controllers\Controller;
use DDD\Domain\Designs\Design;
// Vendors
use DDD\Domain\Designs\Requests\DesignStoreRequest;
// Models
use DDD\Domain\Designs\Requests\DesignUpdateRequest;
use DDD\Domain\Designs\Resources\DesignResource;
// Requests
use DDD\Domain\Organizations\Organization;
use Illuminate\Http\Request;
// Resources
use Spatie\QueryBuilder\QueryBuilder;

class DesignController extends Controller
{
    public function index(Organization $organization, Request $request)
    {
        $designs = QueryBuilder::for(Design::class)
            ->where('organization_id', $organization->id)
            ->allowedFilters(['designer_email'])
            ->latest()
            ->get();

        return DesignResource::collection($designs);
    }

    public function store(Organization $organization, DesignStoreRequest $request)
    {
        $design = $organization->designs()->create(
            $request->validated()
        );

        return new DesignResource($design);
    }

    public function show(Organization $organization, Design $design)
    {
        return new DesignResource($design);
    }

    public function update(Organization $organization, Design $design, DesignUpdateRequest $request)
    {
        $design->update($request->validated());

        return new DesignResource($design);
    }

    public function destroy(Organization $organization, Design $design)
    {
        $design->delete();

        return new DesignResource($design);
    }
}
