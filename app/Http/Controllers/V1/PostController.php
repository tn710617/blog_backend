<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostCollection;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use App\Rules\V1\ValidCategoryId;
use App\Rules\V1\ValidTagId;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function show(Post $post)
    {
        $post->load(['tags', 'category']);

        return PostResource::make($post);
    }

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

        $post = DB::transaction(function () use ($toBeInsertedData, $input) {
            $post = Post::create($toBeInsertedData);
            if (isset($input['tag_ids'])) {
                $post->tags()->attach($input['tag_ids']);
            }

            return $post;
        });

        return PostResource::make($post);
    }

    public function index(Request $request)
    {
        $input = $request->validate(rules: [
            'tag_ids' => ['array', 'nullable'],
            'tag_ids.*' => ['required', new ValidTagId()],
            'category_id' => ['nullable', new ValidCategoryId()],
            'sort' => ['nullable', Rule::in(['created_at', 'updated_at'])]
        ]);

        $input = collect($input)->filter();

        $posts = Post::query()->with(['tags', 'category'])
            ->when($input->has('tag_ids'), function (Builder $postBuilder) use ($input) {
                $postBuilder->whereHas('tags',
                    fn(Builder $tagBuilder) => $tagBuilder->whereIn('tags.id', $input['tag_ids']));
            })->when($input->has('category_id') && $input['category_id'] != 1,
                function (Builder $postBuilder) use ($input) {
                    $postBuilder->whereRelation('category', 'id', $input['category_id']);
                })->when($input->has('sort'), fn(Builder $postBuilder) => $postBuilder->orderByDesc($input['sort']),
                fn(Builder $postBuilder) => $postBuilder->orderByDesc('created_at')
            )->paginate(10)->withQueryString();

        return PostCollection::make($posts);
    }
}
