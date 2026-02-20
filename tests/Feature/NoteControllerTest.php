<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\Note;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Tests\TestCase;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_notes()
    {
        $notes = Note::factory()->count(3)->create();
        $response = $this->getJson(route('notes.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_note()
    {
        $note = Note::factory()->create();
        $response = $this->getJson(route('notes.show', $note->id));
        $response->assertOk()->assertJsonFragment(['id' => $note->id]);
    }

    public function test_store_creates_note()
    {
        $user = User::factory()->create();
        $applicant = Applicant::factory()->create();
        $job = Job::factory()->create();
        $data = [
            'content' => 'Test note',
            'user_id' => $user->id,
            'applicant_id' => $applicant->id,
            'job_id' => $job->id,
        ];
        $response = $this->postJson(route('notes.store'), $data);
        $response->assertCreated()->assertJsonFragment($data);
        $this->assertDatabaseHas('notes', $data);
    }

    public function test_update_modifies_note()
    {
        $note = Note::factory()->create();
        $data = ['content' => 'Updated note'];
        $response = $this->putJson(route('notes.update', $note->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('notes', $data);
    }

    public function test_destroy_deletes_note()
    {
        $note = Note::factory()->create();
        $response = $this->deleteJson(route('notes.destroy', $note->id));
        $response->assertNoContent();
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
