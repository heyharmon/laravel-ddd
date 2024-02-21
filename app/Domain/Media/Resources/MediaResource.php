<?php

namespace DDD\Domain\Media\Resources;

use DDD\Domain\Tags\Resources\TagResource;
// Resources
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'collection' => $this->collection_name,
            'name' => $this->name,
            'file_name' => $this->file_name,
            'size' => $this->size,
            'original_url' => $this->original_url,
            'extension' => $this->extension,
            'tags' => TagResource::collection($this->whenLoaded('tags'))->pluck('slug'),
        ];
    }
}
