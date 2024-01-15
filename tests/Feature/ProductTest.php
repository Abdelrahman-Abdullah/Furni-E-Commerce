<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_shop_page_contain_eight_products_as_maximum_per_page(): void
    {
        // Arrange
        $category = Category::factory()->create();
        Product::factory(16)->create(['category_id' => $category->id]);
        $perPage = 8;

        // Act
        $response = $this->get('/products');

        // Assert
        $response->assertOk()
            ->assertSeeInOrder(Product::with('category')->take($perPage)->pluck('name')->toArray());
    }

}
