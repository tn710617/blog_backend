<?php

namespace App\Http\Requests\V1;

use App\Models\Post;
use App\Rules\V1\ValidCategoryId;
use App\Rules\V1\ValidLocale;
use App\Rules\V1\ValidTagId;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
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
        /** @var Post $post */
        $post = $this->route('post');
        $locale = Str::replace('-', '_', $post->locale);

        return [
            'post_title' => [
                'nullable', 'string',
                Rule::unique(Post::class, 'post_title')->where('locale', $locale)->ignoreModel($post)
            ],
            'post_content' => ['nullable', 'string'],
            'tag_ids' => ['array', 'nullable'],
            'tag_ids.*' => ['required', new ValidTagId()],
            'category_id' => ['nullable', new ValidCategoryId()],
            'is_public' => ['nullable', 'boolean'],
            'created_at' => ['nullable', 'date'],
            'locale' => ['nullable', new ValidLocale()],
            'should_publish_medium' => ['nullable', 'boolean'],
        ];
    }
}
