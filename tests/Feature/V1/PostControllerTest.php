<?php

namespace Tests\Feature\V1;

use App\Helpers\LocaleHelper;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    public function test_used_at_will_be_touched_when_tags_are_used_to_create_post()
    {
        $tag = Tag::all()->random(1)->first();

        $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]))
            ->postJson(route('v1.posts.store'), [
                'post_title' => $this->faker->sentence,
                'post_content' => $this->faker->paragraph,
                'category_id' => Category::all()->random(1)->first()->id,
                'tag_ids' => [$tag->id],
                'is_public' => true,
                'locale' => 'en',
            ])
            ->assertCreated();

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'used_at' => now()->toDateTimeString(),
        ]);
    }

    public function test_used_at_will_be_touched_when_tags_are_updated()
    {
        $post = Post::factory()->create();
        $tag = Tag::all()->random(1)->first();

        $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]))
            ->putJson(route('v1.posts.update', $post), [
                'tag_ids' => [$tag->id],
            ])
            ->assertNoContent();

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'used_at' => now()->toDateTimeString(),
        ]);
    }

    public function test_only_admin_can_show_private_post()
    {
        $post = Post::factory()->create(['is_public' => false]);

        $this->getJson(route('v1.posts.show', $post))
            ->assertForbidden();
    }

    public function test_can_update_a_post_with_duplicate_post_title_if_the_duplicated_post_title_is_its_own()
    {
        $post = Post::factory()->create();
        $expectedPostTitle = $post->post_title;

        $this->actingAs(User::factory()->create())
            ->putJson(route('v1.posts.update', $post), [
                'post_title' => $expectedPostTitle,
            ])
            ->assertNoContent();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'post_title' => $expectedPostTitle,
        ]);
    }

    public function test_can_not_update_a_post_with_existing_post_title_except_its_own_post_title()
    {
        $post = Post::factory()->create();
        $existingPost = Post::factory()->create();
        $expectedPostTitle = $existingPost->post_title;

        $this->actingAs(User::factory()->create())
            ->putJson(route('v1.posts.update', $post), [
                'post_title' => $expectedPostTitle,
            ])
            ->assertJsonValidationErrors(['post_title']);
    }

    public function test_can_update_post()
    {
        $post = Post::factory()->create();
        $expectedLocale = $this->faker->randomElement(['en', 'zh-TW']);
        $expectedPostTitle = $this->faker->sentence;
        $expectedPostContent = $this->faker->paragraph;
        $expectedCategoryId = $this->faker->randomElement(Category::getValidIds());
        $expectedTagIds = Arr::random(Tag::getValidIds(), $this->faker->numberBetween(1, 5));
        $expectedIsPublic = $this->faker->boolean;
        $expectedCreatedAt = $this->faker->dateTimeBetween('-1 year')->format('Y-m-d H:i:s');

        $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]))
            ->putJson(route('v1.posts.update', $post), [
                'post_title' => $expectedPostTitle,
                'post_content' => $expectedPostContent,
                'category_id' => $expectedCategoryId,
                'tag_ids' => $expectedTagIds,
                'is_public' => $expectedIsPublic,
                'created_at' => $expectedCreatedAt,
                'locale' => $expectedLocale,
            ])
            ->assertNoContent();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'post_title' => $expectedPostTitle,
            'post_content' => $expectedPostContent,
            'category_id' => $expectedCategoryId,
            'locale' => Str::replace('-', '_', $expectedLocale),
            'is_public' => $expectedIsPublic,
            'created_at' => $expectedCreatedAt,
        ]);

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $expectedTagIds[0],
        ]);
    }

    public function test_can_show_a_post()
    {
        $tagNumber = $this->faker->numberBetween(1, 5);
        $tags = Tag::all()->random($tagNumber);
        $expectedLocale = $this->faker->randomElement(['en', 'zh_TW']);
        $post = Post::factory()->hasAttached($tags)->create(['locale' => $expectedLocale]);

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
                        'category_name' => Str::studly($post->category->category_name,)
                    ],
                    'locale' => str_replace('_', '-', $expectedLocale),
                    'tags' => $tags->map(fn($tag) => [
                        'id' => $tag->id,
                        'tag_name' => $tag->tag_name,
                    ])->toArray(),
                ]
            ]);
    }

    public function test_only_index_public_posts_when_user_is_not_logged_in()
    {
        $publicPosts = Post::factory()->count(5)->create(['is_public' => true, 'locale' => 'en']);
        $privatePosts = Post::factory()->count(5)->create(['is_public' => false, 'locale' => 'en']);

        $this->getJson(route('v1.posts.index'))
            ->assertOk()
            ->assertJsonCount($publicPosts->count(), 'data')
            ->assertJsonMissing($privatePosts->map(fn($post) => $post->id)->toArray());
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
        $postsOne = Post::factory()->count($postsOneCount)->create(['category_id' => $categoryId, 'locale' => 'en']);
        $postsOne->each(fn($post) => $post->tags()->sync($tag1));

        $postsOne = Post::factory()->count($postsTwoCount)->create(['category_id' => $categoryId, 'locale' => 'en']);
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

    public function test_created_at_will_be_now_if_created_at_is_not_passed()
    {
        $this->actingAsUser();

        $this->postJson(route('v1.posts.store'), [
            'post_title' => Str::random(),
            'post_content' => $this->faker->paragraph(),
            'tag_ids' => Arr::random(Tag::getValidIds(), 2),
            'category_id' => Arr::random(Category::getValidIds()),
            'is_public' => $this->faker->boolean(),
            'locale' => $this->faker->randomElement(app(LocaleHelper::class)->getSupportedLocales()),
        ])->assertCreated();

        $this->assertDatabaseHas(Post::class, [
            'created_at' => now()->toDateTimeString(),
        ]);
    }

    public function test_can_create_a_post()
    {
        $localeHelper = app(LocaleHelper::class);

        $this->actingAsUser();

        $expectation = [];
        $expectation['post_title'] = Str::random();
        $expectation['post_content'] = $this->faker->paragraph();
        $expectation['tag_ids'] = Arr::random(Tag::getValidIds(), 2);
        $expectation['category_id'] = Arr::random(Category::getValidIds());
        $expectation['is_public'] = $this->faker->boolean();
        $expectation['created_at'] = $this->faker->dateTime()->format('Y-m-d H:i:s');
        $expectation['locale'] = $this->faker->randomElement($localeHelper->getSupportedLocales());

        $this->postJson(route('v1.posts.store'), [
            'post_title' => $expectation['post_title'],
            'post_content' => $expectation['post_content'],
            'tag_ids' => $expectation['tag_ids'],
            'category_id' => $expectation['category_id'],
            'is_public' => $expectation['is_public'],
            'created_at' => $expectation['created_at'],
            'locale' => $expectation['locale'],
        ])->assertCreated();

        $this->assertDatabaseHas(Post::class, [
            'post_title' => $expectation['post_title'],
            'post_content' => $expectation['post_content'],
            'category_id' => $expectation['category_id'],
            'is_public' => $expectation['is_public'],
            'created_at' => $expectation['created_at'],
            'locale' => $localeHelper->normalizeLocale($expectation['locale'])
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
