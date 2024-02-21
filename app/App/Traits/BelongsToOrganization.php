<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;

trait BelongsToOrganization
{
    /**
     * Scope a query to only include users in an organization.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeOrganization($query, $organization_id)
    {
        $query->where('organization_id', $organization_id);
    }

    /**
     * Organization this model belongs to.
     *
     * @return belongsTo
     */
    public function organization()
    {
        return $this->belongsTo(\DDD\Domain\Organizations\Organization::class);
    }
}
