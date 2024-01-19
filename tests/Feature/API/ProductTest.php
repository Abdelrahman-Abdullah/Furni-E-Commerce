<?php

namespace Tests\Feature\API;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use refreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_return_all_products_as_json_response(): void
    {
        // Arrange
        $categories = Category::factory()->create();
        $products = Product::factory(10)->configure()->create(['category_id' => $categories->id,]);
        // Act
        $response = $this->getJson('/api/products');
        // Assert
        $response->assertStatus(200);
//        $response->assertJson([
//            'products' => [$products->toArray()],
//        ]);
        $response->assertJsonStructure([
            'products' => [
                '*' => [
                    'id',
                    'name',
                    'price',
                    'description',
                    'categoryName',
                    'imageUrl',
                ],
            ],
        ]);
    }
}
