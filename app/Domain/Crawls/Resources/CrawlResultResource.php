<?php

namespace DDD\Domain\Crawls\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CrawlResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'http_status' => $this['http_status'],
            'title' => $this['title'],
            'wordcount' => $this['wordcount'],
            'redirected' => $this['redirected'],
            'requested_url' => $this['requested_url'],
            'destination_url' => $this['destination_url'],
        ];
    }
}
