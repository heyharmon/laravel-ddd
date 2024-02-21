<?php

namespace DDD\Domain\Organizations;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DDD\App\Traits\HasComments;
use DDD\App\Traits\HasMeta;
// Vendors
use DDD\App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Traits
use Illuminate\Database\Eloquent\Model;
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
     *
     * @return hasMany
     */
    public function crawls(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Crawls\Crawl::class);
    }

    /**
     * Last crawl associated with the organization.
     *
     * @return model
     */
    public function lastCrawl(): HasOne
    {
        return $this->hasOne(\DDD\Domain\Crawls\Crawl::class)->latest();
    }

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Users\User::class);
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Invitations\Invitation::class);
    }

    /**
     * Pages associated with the organization.
     *
     * @return hasMany
     */
    public function pages(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Pages\Page::class);
    }

    /**
     * Redirects associated with the organization.
     *
     * @return hasMany
     */
    public function redirects(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Redirects\Redirect::class);
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Teams\Team::class);
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Sites\Site::class);
    }

    /**
     * Designs associated with this organization.
     *
     * @return hasMany
     */
    public function designs(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Designs\Design::class);
    }
}
