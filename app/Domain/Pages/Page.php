<?php

namespace DDD\Domain\Pages;

use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\IsCategorizable;
use DDD\App\Traits\IsStatusable;
// Domains
use DDD\App\Traits\IsTaggable;
// Traits
use DDD\Domain\Sites\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use BelongsToOrganization,
        BelongsToUser,
        HasFactory,
        IsCategorizable,
        IsStatusable,
        IsTaggable,
        SoftDeletes;

    protected $guarded = [
        'id',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
