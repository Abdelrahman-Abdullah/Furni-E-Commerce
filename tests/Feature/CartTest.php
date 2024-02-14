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
    public function test_only_logged_in_user_can_add_product_to_cart(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        // Act
        $response = $this->post('/cart/add/'. $product->id);
        // Assert
        $response->assertRedirect('/users/login');
    }

    public function test_user_can_increment_product_quantity_in_cart(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post('/cart/add/'. $product->id);
        // Act
        $response = $this->post('/cart/update/'. $product->id , ['increment' => true]);
        // Assert
        $response->assertStatus(200);
        $response->assertSessionHas('cart', [
            $product->id => [
                'id' => $product->id,
                'title' => $product->name,
                'price' => $product->price,
                'imageUrl' => $product->image_url,
                'quantity' => 2
            ]
        ]);
    }
    public function test_user_can_decrement_product_quantity_in_cart(): void
    {
        // Arrange: Set up the environment and prerequisites
        $user = User::factory()->create();
        $product = Product::factory()->for(Category::factory(), 'category')->create(); // Another way to create a product with a category
        $this->actingAs($user);

        // Add a product to the cart and increment its quantity
        $this->post("/cart/add/".$product->id);
        $this->post("/cart/update/".$product->id, ['increment' => 'true']);

        // Act: Perform the action to be tested
        // Decrement the product quantity in the cart
        $response = $this->post("/cart/update/".$product->id, ['increment' => 'false']);

        // Assert: Verify the outcome
        // Check if the HTTP response is OK
        $response->assertStatus(200);

        // Check if the session cart data matches expected values
        $response->assertSessionHas('cart', [
            $product->id => [
                'id' => $product->id,
                'title' => $product->name,
                'price' => $product->price,
                'imageUrl' => $product->image_url,
                'quantity' => 1 // Assuming the initial quantity was 2
            ]
        ]);
    }
    public function test_user_can_remove_product_from_cart(): void
    {
        // Arrange: Set up the environment and prerequisites
        $user = User::factory()->create();
        $product = Product::factory()->for(Category::factory(), 'category')->create();
        $this->actingAs($user);

        // Add a product to the cart
        $this->post("/cart/add/".$product->id);

        // Act: Perform the action to be tested
        // Remove the product from the cart
        $response = $this->delete("/cart/remove/".$product->id);

        // Assert: Verify the outcome
        // Check if the HTTP response is OK
        $response->assertStatus(200);

        // Check if the session cart data matches expected values
        $response->assertSessionHas('cart', []);
    }
}
