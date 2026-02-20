<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\File;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Tests\TestCase;

class FileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_files()
    {
        $files = File::factory()->count(3)->create();
        $response = $this->getJson(route('files.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_file()
    {
        $file = File::factory()->create();
        $response = $this->getJson(route('files.show', $file->id));
        $response->assertOk()->assertJsonFragment(['id' => $file->id]);
    }

    public function test_store_creates_file()
    {
        $applicant = Applicant::factory()->create();
        $job = Job::factory()->create();
        $data = [
            'name' => 'document.pdf',
            'path' => '/files/document.pdf',
            'type' => 'pdf',
            'size' => 12345,
            'applicant_id' => $applicant->id,
            'job_id' => $job->id,
        ];
        $response = $this->postJson(route('files.store'), $data);
        $response->assertCreated()->assertJsonFragment($data);
        $this->assertDatabaseHas('files', $data);
    }

    public function test_update_modifies_file()
    {
        $file = File::factory()->create();
        $data = ['name' => 'updated.pdf'];
        $response = $this->putJson(route('files.update', $file->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('files', $data);
    }

    public function test_destroy_deletes_file()
    {
        $file = File::factory()->create();
        $response = $this->deleteJson(route('files.destroy', $file->id));
        $response->assertNoContent();
        $this->assertDatabaseMissing('files', ['id' => $file->id]);
    }
}
