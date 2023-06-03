<?php

namespace App\Http\Requests\V1;

use App\Helpers\LocaleHelper;
use App\Models\Post;
use App\Rules\V1\ValidCategoryId;
use App\Rules\V1\ValidLocale;
use App\Rules\V1\ValidTagId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'post_title' => ['required', 'string', Rule::unique(Post::class, 'post_title')],
            'post_content' => ['nullable', 'string'],
            'tag_ids' => ['array', 'nullable'],
            'tag_ids.*' => ['required', new ValidTagId()],
            'category_id' => ['required', new ValidCategoryId()],
            'is_public' => ['required', 'boolean'],
            'created_at' => ['nullable', 'date'],
            'locale' => ['required', new ValidLocale()],
        ];
    }
}
