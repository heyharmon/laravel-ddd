<?php

namespace DDD\Domain\Sites;

use Illuminate\Database\Eloquent\Relations\HasMany;
use DDD\App\Traits\BelongsToOrganization;
use DDD\Domain\Sites\Casts\LaunchInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Casts
use Illuminate\Database\Eloquent\Model;
// Traits
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use BelongsToOrganization,
        HasFactory,
        SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'launch_info' => LaunchInfo::class,
    ];

    /**
     * Get the pages associated with this site.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Pages\Page::class);
    }
}
