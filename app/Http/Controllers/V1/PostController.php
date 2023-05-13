<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Rules\V1\ValidCategoryId;
use App\Rules\V1\ValidTagId;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $input = $request->validate(rules: [
            'post_title' => ['required', 'string', Rule::unique(Post::class, 'post_title')],
            'post_content' => ['nullable', 'string'],
            'tag_ids' => ['array', 'nullable'],
            'tag_ids.*' => ['required', new ValidTagId()],
            'category_id' => ['required', new ValidCategoryId()]
        ]);

        $toBeInsertedData = Arr::except($input, ['tag_ids']);

        DB::transaction(function () use ($toBeInsertedData, $input) {
            $post = Post::create($toBeInsertedData);
            if (isset($input['tag_ids'])) {
                $post->tags()->attach($input['tag_ids']);
            }
        });

        return response('', Response::HTTP_CREATED);
    }
}
