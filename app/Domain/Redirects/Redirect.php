<?php

namespace DDD\Domain\Redirects;

use DDD\App\Traits\BelongsToOrganization;
use DDD\App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model
{
    use BelongsToOrganization,
        BelongsToUser,
        HasFactory,
        SoftDeletes;

    protected $guarded = [
        'id',
    ];
}
