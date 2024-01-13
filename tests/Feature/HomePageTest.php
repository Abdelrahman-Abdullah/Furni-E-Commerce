<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_homepage_contains_correct_latest_three_products(): void
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

    public function test_homepage_contains_correct_latest_three_blogs(): void
    {
        // Arrange
        $author = User::factory()->create();
        $latestBlogs = Blog::factory(3)->create(['author_id' => $author->id]);

        // Act
        $response = $this->get(route('home'));

        // Assert
        $response->assertSeeInOrder([$latestBlogs[0]->name, $latestBlogs[1]->name, $latestBlogs[2]->name]);
        $response->assertOk();

    }
}
