<?php

namespace DDD\Domain\Invitations\Resources;

use DDD\Domain\Organizations\Resources\OrganizationResource;
use DDD\Domain\Users\Resources\UserResource;
// Resources
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'email' => $this->email,
            'role' => $this->role,
            'url' => $this->url(),
            'organization' => new OrganizationResource($this->whenLoaded('organization')),
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
        ];
    }
}
