<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use MichelMelo\JazzRh\Models\Activity;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ActivityControllerTest extends TestCase
{
    #[Test]
    public function it_can_get_all_activities()
    {
        Activity::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/activities');
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_an_activity()
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'Reunião',
            'description' => 'Reunião de alinhamento',
            'type' => 'meeting',
            'status' => 'pending',
            'priority' => 'high',
            'user_id' => $user->id,
        ];
        $response = $this->postJson('/api/v1/activities', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('activities', ['title' => 'Reunião']);
    }

    #[Test]
    public function it_can_get_an_activity()
    {
        $activity = Activity::factory()->create();
        $response = $this->getJson("/api/v1/activities/{$activity->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $activity->id]);
    }

    #[Test]
    public function it_returns_404_for_non_existent_activity()
    {
        $response = $this->getJson('/api/v1/activities/99999');
        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_an_activity()
    {
        $activity = Activity::factory()->create();
        $data = [
            'title' => 'Atualizado',
            'description' => 'Nova descrição',
            'type' => 'call',
            'status' => 'completed',
            'priority' => 'low',
        ];
        $response = $this->putJson("/api/v1/activities/{$activity->id}", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'title' => 'Atualizado']);
    }

    #[Test]
    public function it_can_delete_an_activity()
    {
        $activity = Activity::factory()->create();
        $response = $this->deleteJson("/api/v1/activities/{$activity->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('activities', ['id' => $activity->id]);
    }
}
