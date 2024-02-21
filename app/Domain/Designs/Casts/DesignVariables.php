<?php

namespace DDD\Domain\Designs\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DesignVariables implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @return mixed
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        $value = isset($value) ? json_decode($value, true) : [];

        $defaults = [
            // Colors
            'color_white' => '#ffffff',
            'color_black' => '#404040',
            'color_primary' => '#404040',
            'color_accent' => '#16e09a',
            'color_contrast_high' => '#404040',
            'color_contrast_higher' => '#404040',
            'color_background' => '#ffffff',

            // Base text
            'text_base_size' => '1.3',

            // Primary font
            'font_primary' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => '400',
            ],

            // Secondary font
            'font_secondary' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => '400',
            ],

            // Buttons font
            'font_buttons' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => '400',
            ],

            // Buttons text colors
            'btn_primary_text_color' => null,
            'btn_secondary_text_color' => null,
            'btn_tertiary_text_color' => null,

            // Buttons styles
            'btn_padding_y' => '0.5',
            'btn_padding_x' => '0.75',
            'btn_radius' => '0.25',
            'btn_text_transform' => 'none',
        ];

        return array_merge($defaults, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        if (isset($value)) {
            return json_encode($value);
        }
    }
}
