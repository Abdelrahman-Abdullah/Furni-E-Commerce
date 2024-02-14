<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_add_product_to_cart(): void
    {
      // Arrange
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $response = $this->post('/cart/add/'. $product->id);
        // Assert
        $response->assertStatus(200);
        $response->assertSessionHas('cart', [
            $product->id => [
                'id' => $product->id,
                'title' => $product->name,
                'price' => $product->price,
                'imageUrl' => $product->image_url,
                'quantity' => 1
            ]
        ]);

    }
}
