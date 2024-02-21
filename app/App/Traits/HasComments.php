<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use DDD\Domain\Comments\Comment;

trait HasComments
{
    /**
     * Get comments using polymorphic relationship
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id')
            ->latest();
    }
}
