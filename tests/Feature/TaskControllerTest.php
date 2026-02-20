<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\Task;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_tasks()
    {
        $tasks = Task::factory()->count(3)->create();
        $response = $this->getJson(route('tasks.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_task()
    {
        $task = Task::factory()->create();
        $response = $this->getJson(route('tasks.show', $task->id));
        $response->assertOk()->assertJsonFragment(['id' => $task->id]);
    }

    public function test_store_creates_task()
    {
        $user = User::factory()->create();
        $assignee = User::factory()->create();
        $data = [
            'title' => 'Test Task',
            'description' => 'Test description',
            'status' => 'pending',
            'priority' => 'medium',
            'assigned_to' => $assignee->id,
            'user_id' => $user->id,
            'due_date' => now()->addDays(5)->toDateString(),
            'completed_at' => null,
        ];
        $response = $this->postJson(route('tasks.store'), $data);
        $response->assertCreated()->assertJsonFragment(['title' => 'Test Task']);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    public function test_update_modifies_task()
    {
        $task = Task::factory()->create();
        $data = ['title' => 'Updated Task'];
        $response = $this->putJson(route('tasks.update', $task->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_destroy_deletes_task()
    {
        $task = Task::factory()->create();
        $response = $this->deleteJson(route('tasks.destroy', $task->id));
        $response->assertNoContent();
        $this->assertSoftDeleted('tasks', ['id' => $task->id]);
    }
}
