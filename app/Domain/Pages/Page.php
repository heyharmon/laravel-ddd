<?php

namespace DDD\Domain\Pages;

use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;
use DDD\App\Traits\IsCategorizable;
// Domains
use DDD\App\Traits\IsStatusable;
// Traits
use DDD\App\Traits\IsTaggable;
use DDD\Domain\Sites\Site;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
