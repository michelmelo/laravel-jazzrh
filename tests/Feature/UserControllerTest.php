<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class UserControllerTest extends TestCase
{
    #[Test]
    public function it_can_get_all_users()
    {
        User::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_a_user()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'recruiter',
        ];

        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    #[Test]
    public function it_can_get_a_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/v1/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $user->id]);
    }

    #[Test]
    public function it_returns_404_for_non_existent_user()
    {
        $response = $this->getJson('/api/v1/users/99999');

        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
            'role' => 'manager',
        ];

        $response = $this->putJson("/api/v1/users/{$user->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

    #[Test]
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/v1/users/{$user->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
