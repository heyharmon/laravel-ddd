<?php

namespace DDD\Domain\Designs;

use DDD\App\Traits\HasParents;
use DDD\App\Traits\HasUuid;
use DDD\Domain\Designs\Casts\DesignVariables;
// Vendors
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Casts
use Illuminate\Database\Eloquent\SoftDeletes;
// Traits
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Design extends Model implements HasMedia
{
    use HasFactory,
        HasParents,
        HasUuid,
        InteractsWithMedia,
        SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'variables' => DesignVariables::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $count = self::where('organization_id', $model->organization_id)->withTrashed()->count();

            $model->title = 'Style #'.$count + 1;
        });
    }
}
