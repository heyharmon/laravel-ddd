<?php

namespace DDD\Domain\Organizations;

use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasMeta;
use DDD\App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Vendors
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
// Traits
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Organization extends Model implements HasMedia
{
    use HasComments,
        HasFactory,
        HasMeta,
        HasSlug,
        InteractsWithMedia;

    protected $guarded = ['id', 'slug'];

    /**
     * Crawls associated with the organization.
     */
    public function crawls(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Crawls\Crawl::class);
    }

    /**
     * Last crawl associated with the organization.
     */
    public function lastCrawl(): HasOne
    {
        return $this->hasOne(\DDD\Domain\Crawls\Crawl::class)->latest();
    }

    /**
     * Users associated with the organization.
     */
    public function users(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Users\User::class);
    }

    /**
     * Invitations associated with the organization.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Invitations\Invitation::class);
    }

    /**
     * Pages associated with the organization.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Pages\Page::class);
    }

    /**
     * Redirects associated with the organization.
     */
    public function redirects(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Redirects\Redirect::class);
    }

    /**
     * Teams that belong to this team.
     */
    public function teams(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Teams\Team::class);
    }

    /**
     * Sites associated with this organization.
     */
    public function sites(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Sites\Site::class);
    }

    /**
     * Designs associated with this organization.
     */
    public function designs(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Designs\Design::class);
    }
}
