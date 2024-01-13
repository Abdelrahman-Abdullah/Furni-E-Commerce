<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_homepage_contains_correct_latest_products(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $latestProducts = Product::factory(3)->create(['category_id' => $category->id]);

        // Act
        $response = $this->get(route('home'));

        // Assert
        $response->assertSeeInOrder([$latestProducts[0]->name, $latestProducts[1]->name, $latestProducts[2]->name]);
        $response->assertOk();

    }
}
