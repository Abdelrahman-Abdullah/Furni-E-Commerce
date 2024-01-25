<?php

namespace Tests\Feature;

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
    public function test_user_can_register_with_valid_data(): void
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
        $response = $this->post('/users/register', $data);

        // Assert
        $response
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('success', 'User created successfully');

    }

    public function test_user_register_validation_work(): void
    {
        // Arrange
        $data = [
            'name' => 'John Doe',
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Act
        $response = $this->post('/users/register', $data);
        // Assert
        $response
            ->assertStatus(302)
            ->assertSessionMissing(['email', 'phone']);
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
        $response = $this->post('/users/login', $credentials);
        // Assert
        $response
            ->assertStatus(302)
            ->assertRedirect('/');
    }
    public function test_user_can_logout()
    {
        // Arrange
        $user = \App\Models\User::factory()->create([
            'password' => 'password',
        ]);
        // Act
        $this->actingAs($user);
        $response = $this->post('/users/logout');
        // Assert
        $response
            ->assertStatus(302)
            ->assertRedirect('/');

    }
    public function test_user_must_be_logged_in_to_can_logout()
    {
        // Arrange
        $user = \App\Models\User::factory()->create([
            'password' => 'password',
        ]);
        // Act
        $response = $this->post('/users/logout');
        // Assert
        $response
            ->assertStatus(302)
            ->assertRedirect('users/login');

    }
}
