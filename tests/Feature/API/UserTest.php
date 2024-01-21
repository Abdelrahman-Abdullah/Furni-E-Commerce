<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_user_successfully(): void
    {
        // Arrange
            $data = [
                'name' => 'John Doe',
                'email' => 'jhon@doe.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'phone' => '1234567890',
            ];
        // Act
            $response = $this->postJson('/api/users/register', $data);
        // Assert
            $response->assertStatus(201);
            $response->assertJson(['message' => 'User created successfully']);
    }
    public function test_cannot_create_user_with_invalid_data(): void
    {
        // Arrange
        $data = [
            'name' => 'John Doe',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '',
        ];
        // Act
        $response = $this->postJson('/api/users/register', $data);
        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'phone']);
    }
}
