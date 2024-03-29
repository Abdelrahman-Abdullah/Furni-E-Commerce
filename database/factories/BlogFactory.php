<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users_id = \App\Models\User::pluck('id')->toArray();
        return [
            'author_id' => $this->faker->randomElement($users_id),
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug(),
            'image' => '/post-'.rand(1, 3).'.jpg', // 'blog-1.png', 'blog-2.png', 'blog-3.png
            'description' => $this->faker->paragraph(5),
        ];
    }
}
