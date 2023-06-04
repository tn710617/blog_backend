<?php

namespace Database\Factories;

use App\Helpers\LocaleHelper;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_title' => Str::random(),
            'post_content' => Str::random(1024),
            'category_id' => $this->faker->randomElement(Category::getValidIds()),
            'locale' => $this->faker->randomElement(['en', 'zh_TW']),
            'user_id' => User::factory()
        ];
    }
}
