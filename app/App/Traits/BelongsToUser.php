<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;

trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::creating(function (Model $model) {
            if ($user = request()->user()) {
                $model->user_id = request()->user()->id;
            }
        });
    }

    /**
     * User this model belongs to.
     *
     * @return belongsTo
     */
    public function user()
    {
        return $this->belongsTo(\DDD\Domain\Users\User::class);
    }
}
