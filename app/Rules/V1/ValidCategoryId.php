<?php

namespace App\Rules\V1;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCategoryId implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, Category::getValidIds())) {
            $fail("The :attribute is invalid.");
        }
    }
}
