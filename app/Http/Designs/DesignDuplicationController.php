<?php

namespace DDD\Http\Designs;

use DDD\App\Controllers\Controller;
use DDD\Domain\Designs\Design;
// Models
use DDD\Domain\Designs\Requests\DesignStoreRequest;
use DDD\Domain\Designs\Resources\DesignResource;
// Requests
use DDD\Domain\Organizations\Organization;
// Resources
use Illuminate\Support\Str;

class DesignDuplicationController extends Controller
{
    public function duplicate(Organization $organization, Design $design, DesignStoreRequest $request)
    {
        $newDesign = $design->replicate();

        $newDesign->uuid = Str::uuid();
        $newDesign->parent_id = $design->id;
        $newDesign->designer_name = $request->designer_name;
        $newDesign->designer_email = $request->designer_email;

        $newDesign->save();

        return new DesignResource($newDesign);
    }
}
