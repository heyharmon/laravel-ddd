<?php

namespace DDD\Domain\Teams;

use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\HasSlug;
// Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use BelongsToOrganization,
        HasFactory,
        HasSlug;

    protected $guarded = ['id', 'slug'];

    /**
     * Get the users who belong to this team.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany(\DDD\Domain\Users\User::class);
    }
}
