<?php

namespace DDD\Domain\Redirects\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RedirectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'requested_url' => $this->requested_url,
            'destination_url' => $this->destination_url,
            'group' => $this->group,
            'created_at' => $this->created_at,
        ];
    }
}
