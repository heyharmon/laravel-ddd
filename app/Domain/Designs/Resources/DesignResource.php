<?php

namespace DDD\Domain\Designs\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DesignResource extends JsonResource
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
            'title' => $this->title,
            'designer_name' => $this->designer_name,
            'designer_email' => $this->designer_email,
            'variables' => $this->variables,
            'created_at' => $this->created_at,
        ];
    }
}
