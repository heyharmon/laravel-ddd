<?php

namespace DDD\Domain\Crawls\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CrawlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'status' => $this->status,
            'total' => $this->total,
            'handled' => $this->handled,
            'pending' => $this->pending,
            'created_at' => $this->created_at,
        ];
    }
}
