<?php

namespace App\Services;

use App\Models\Color;

class ColorService
{
    /**
     * @param array $input
     * @return Color
     */
    public static function create(array $input): Color
    {
        return Color::firstOrCreate(
            ['name' => $input['name'], 'hex_code' => $input['hex_code']]
        );
    }

    /**
     * @param array $validated
     * @return int
     */
    public static function delete(array $validated): int
    {
        return Color::where('name', $validated['name'])->first()->delete();
    }

}
