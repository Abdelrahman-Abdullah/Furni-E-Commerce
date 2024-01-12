<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories_id = Category::pluck('id')->toArray();
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'description' => $this->faker->text(200),
            'category_id' => $this->faker->randomElement($categories_id),
            'image' => $this->faker->imageUrl(640, 480, 'furniture', true),
        ];
    }
}
