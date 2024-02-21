<?php

namespace DDD\Domain\Organizations;

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
    public function crawls()
    {
        return $this->hasMany(\DDD\Domain\Crawls\Crawl::class);
    }

    /**
     * Last crawl associated with the organization.
     *
     * @return model
     */
    public function lastCrawl()
    {
        return $this->hasOne(\DDD\Domain\Crawls\Crawl::class)->latest();
    }

    /**
     * Users associated with the organization.
     *
     * @return hasMany
     */
    public function users()
    {
        return $this->hasMany(\DDD\Domain\Users\User::class);
    }

    /**
     * Invitations associated with the organization.
     *
     * @return hasMany
     */
    public function invitations()
    {
        return $this->hasMany(\DDD\Domain\Invitations\Invitation::class);
    }

    /**
     * Pages associated with the organization.
     *
     * @return hasMany
     */
    public function pages()
    {
        return $this->hasMany(\DDD\Domain\Pages\Page::class);
    }

    /**
     * Redirects associated with the organization.
     *
     * @return hasMany
     */
    public function redirects()
    {
        return $this->hasMany(\DDD\Domain\Redirects\Redirect::class);
    }

    /**
     * Teams that belong to this team.
     *
     * @return hasMany
     */
    public function teams()
    {
        return $this->hasMany(\DDD\Domain\Teams\Team::class);
    }

    /**
     * Sites associated with this organization.
     *
     * @return hasMany
     */
    public function sites()
    {
        return $this->hasMany(\DDD\Domain\Sites\Site::class);
    }

    /**
     * Designs associated with this organization.
     *
     * @return hasMany
     */
    public function designs()
    {
        return $this->hasMany(\DDD\Domain\Designs\Design::class);
    }
}
