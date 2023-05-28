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

    public function test_can_show_a_post()
    {
        $tagNumber = $this->faker->numberBetween(1, 5);
        $tags = Tag::all()->random($tagNumber);
        $post = Post::factory()->hasAttached($tags)->create();

        $this->getJson(route('v1.posts.show', $post))
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $post->id,
                    'post_title' => $post->post_title,
                    'post_content' => $post->post_content,
                    'category_id' => $post->category_id,
                    'category' => [
                        'id' => $post->category->id,
                        'category_name' => $post->category->category_name,
                    ],
                    'tags' => $tags->map(fn($tag) => [
                        'id' => $tag->id,
                        'tag_name' => $tag->tag_name,
                    ])->toArray(),
                ]
            ]);
    }

    public function test_can_index_posts()
    {
        $tags = Arr::random(Tag::getValidIds(), 2);
        $tag1 = $tags[0];
        $tag2 = $tags[1];
        $postsOneCount = $this->faker->numberBetween(1, 5);
        $postsTwoCount = $this->faker->numberBetween(1, 5);
        $totalCount = $postsTwoCount + $postsOneCount;
        $categoryId = Arr::random(Category::getValidIds());
        $postsOne = Post::factory()->count($postsOneCount)->create(['category_id' => $categoryId]);
        $postsOne->each(fn($post) => $post->tags()->sync($tag1));

        $postsOne = Post::factory()->count($postsTwoCount)->create(['category_id' => $categoryId]);
        $postsOne->each(fn($post) => $post->tags()->sync($tag2));

        $queryOne = http_build_query([
            'category_id' => $categoryId,
            'tag_ids' => [$tag1],
        ]);

        $postsResultOne = $this->getJson(sprintf("%s?%s",
            route('v1.posts.index'),
            $queryOne
        ))->assertOk()->json();

        $this->assertCount($postsOneCount, $postsResultOne['data']);

        foreach ($postsResultOne['data'] as $post) {
            $this->assertSame($post['tags'][0]['id'], $tag1);
            $this->assertSame($post['category_id'], $categoryId);
        }

        $queryTwo = http_build_query([
            'category_id' => $categoryId,
            'tag_ids' => [$tag2],
        ]);

        $postsResultTwo = $this->getJson(sprintf("%s?%s",
            route('v1.posts.index'),
            $queryTwo
        ))->assertOk()->json();

        foreach ($postsResultTwo['data'] as $post) {
            $this->assertSame($post['tags'][0]['id'], $tag2);
            $this->assertSame($post['category_id'], $categoryId);
        }

        $this->travelTo(now()->addSeconds(5));

        $expectedRecentlyCreatedPost = tap($postsOne->random())->update(['created_at' => now()]);

        $result = $this->getJson(route('v1.posts.index'))->json();

        $this->assertSame($result['data'][0]['id'], $expectedRecentlyCreatedPost->getKey());

        $this->travelTo(now()->addSeconds(5));

        $expectedRecentlyUpdatedPost = tap($postsOne->random())->update(['updated_at' => now()]);

        $result = $this->getJson(sprintf('%s?%s', route('v1.posts.index'),
            http_build_query(['sort' => 'updated_at'])))->json();

        $this->assertSame($result['data'][0]['id'], $expectedRecentlyUpdatedPost->getKey());

        $this->getJson(route('v1.posts.index'))->assertJsonCount($totalCount, 'data');
    }

    public function test_can_create_a_post()
    {
        $expectation = [];
        $expectation['post_title'] = Str::random();
        $expectation['post_content'] = $this->faker->paragraph();
        $expectation['tag_ids'] = Arr::random(Tag::getValidIds(), 2);
        $expectation['category_id'] = Arr::random(Category::getValidIds());

        $this->postJson(route('v1.posts.store'), [
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
