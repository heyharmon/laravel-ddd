<?php

namespace DDD\Domain\Statuses;

use DDD\App\Traits\HasParents;
use DDD\App\Traits\HasSlug;
// Traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory,
        HasParents,
        HasSlug;

    protected $guarded = [
        'id',
    ];
}
