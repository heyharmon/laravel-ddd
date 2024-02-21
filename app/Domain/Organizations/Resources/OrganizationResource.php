<?php

namespace DDD\Domain\Organizations\Resources;

use Illuminate\Http\Request;
use DDD\Domain\Meta\Resources\MetaResource;
// Resources
use Illuminate\Http\Resources\Json\JsonResource;

// use DDD\Domain\Crawls\Resources\CrawlResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'meta' => MetaResource::collection($this->whenLoaded('meta')),
            // 'last_crawl' => new CrawlResource($this->lastCrawl),
        ];
    }
}
