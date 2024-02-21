<?php

namespace DDD\Domain\Users;

use DDD\App\Traits\BelongsToOrganization;
use DDD\Domain\Users\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Enums
use Illuminate\Foundation\Auth\User as Authenticatable;
// Traits
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Scopes
// use DDD\App\Scopes\OrganizationScope;

class User extends Authenticatable
{
    use BelongsToOrganization,
        HasApiTokens,
        HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role',           // TODO: Remove
        'organization_id', // TODO: Remove
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'role' => RoleEnum::class,
        'email_verified_at' => 'datetime',
    ];

    // TODO: Move to a one to many (user belongs to many orgs)
    public function organization()
    {
        return $this->belongsTo('DDD\Domain\Organizations\Organization');
    }

    public function comments()
    {
        return $this->hasMany('DDD\Domain\Comments\Comment');
    }
}
