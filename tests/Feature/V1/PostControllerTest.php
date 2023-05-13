<?php

namespace Tests\Feature\V1;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function test_can_create_a_post()
    {
        $expectation = [];
        $expectation['post_title'] = Str::random();
        $expectation['post_content'] = $this->faker->paragraph();
        $expectation['tag_ids'] = Arr::random(Tag::getValidIds(), 2);
        $expectation['category_id'] = Arr::random(Category::getValidIds());

        $this->postJson(route('posts.store'), [
            'post_title' => $expectation['post_title'],
            'post_content' => $expectation['post_content'],
            'tag_ids' => $expectation['tag_ids'],
            'category_id' => $expectation['category_id']
        ])->assertCreated();

        $this->assertDatabaseHas(Post::class, [
            'post_title' => $expectation['post_title'],
            'post_content' => $expectation['post_content'],
            'category_id' => $expectation['category_id'],
        ]);

        $post = Post::first();

        foreach ($expectation['tag_ids'] as $tagId) {
            $this->assertDatabaseHas('post_tag', [
                'post_id' => $post->getKey(),
                'tag_id' => $tagId
            ]);
        }
    }
}
