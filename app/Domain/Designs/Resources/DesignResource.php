<?php

namespace DDD\Domain\Designs\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DesignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
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
