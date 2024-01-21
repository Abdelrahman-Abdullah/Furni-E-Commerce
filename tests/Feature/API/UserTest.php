<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
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
    public function test_user_can_login_successfully(): void
    {
        // Arrange
        $user = \App\Models\User::factory()->create([
            'password' => 'password',
        ]);
        $credentials = [
            'email' => $user->email,
            'password' => 'password',
        ];

        // Act
        $response = $this->postJson('/api/users/login', $credentials);

        // Assert
        $response->assertJsonStructure(['message', 'user','access_token'])
            ->assertJson(['message' => 'User logged in successfully.', 'user' => $user->toArray()])
            ->assertStatus(200);
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        // Arrange
        $user = \App\Models\User::factory()->create([
            'password' => 'password',
        ]);
        $credentials = [
            'email' => $user->email,
            'password' => 'wrong_password',
        ];

        // Act
        $response = $this->postJson('/api/users/login', $credentials);

        // Assert
        $response->assertJson(['message' => 'Invalid credentials'])
            ->assertStatus(401);
    }
    public function test_user_login_validation_works(): void
    {
        // Arrange
        $credentials = [
            'email' => '',
            'password' => '',
        ];

        // Act
        $response = $this->postJson('/api/users/login', $credentials);

        // Assert
        $response->assertJsonValidationErrors(['email', 'password'])
            ->assertStatus(422);
    }

}
