<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_get_the_desire_blog(): void
    {
        // Arrange
        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'author_id' => $user->id,
        ]);

        // Act
        $response = $this->get('blogs/'. $blog->slug);

        // Assert
        $response->assertStatus(200);
        $response->assertSee($blog->title);

    }
}
