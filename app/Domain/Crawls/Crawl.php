<?php

namespace DDD\Domain\Crawls;

use DDD\App\Traits\BelongsToOrganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;

class Crawl extends Model
{
    use BelongsToOrganization,
        HasFactory;

    protected $guarded = [
        'id',
    ];
}
