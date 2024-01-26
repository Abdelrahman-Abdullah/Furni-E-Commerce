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
    public function test_user_can_get_the_right_single_product(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        // Act
        $response = $this->get('/products/' . $product->name);

        // Assert
        $response->assertOk()
           ->assertViewHas('product', $product);
    }
    public function test_user_get_not_found_in_wrong_product_name(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        // Act
        $response = $this->get('/products/' . $product->name . 'AnyThing');

        // Assert
        $response->assertRedirect()
            ->assertSessionHasErrors('error', 'Product Not Found');
    }

}
