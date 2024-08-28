<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'content' => $this->faker->paragraphs(5, true),
            'photo' => $this->faker->imageUrl(640, 480, 'articles', true),
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'created_at' => now(),
            'updated_at' => now()
            ];
    }
}
