<?php

namespace App\Rules;

use App\Models\Color;
use Illuminate\Contracts\Validation\Rule;

class ColorNotExists implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Color::where('name', $value)->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The color is already registered.';
    }
}
