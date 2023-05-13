<?php

namespace App\Rules\V1;

use App\Models\Tag;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidTagId implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, Tag::getValidIds())) {
            $fail("The :attribute is invalid.");
        }
    }
}
