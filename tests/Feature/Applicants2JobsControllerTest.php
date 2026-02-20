<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Applicants2Jobs;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class Applicants2JobsControllerTest extends TestCase
{
    #[Test]
    public function it_can_get_all_applicants2jobs()
    {
        Applicants2Jobs::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/applicants2jobs');
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_an_applicants2jobs()
    {
        $applicant = Applicant::factory()->create();
        $job = Job::factory()->create();
        $data = [
            'applicant_id' => $applicant->id,
            'job_id' => $job->id,
            'status' => 'applied',
        ];
        $response = $this->postJson('/api/v1/applicants2jobs', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('applicants2jobs', ['applicant_id' => $applicant->id, 'job_id' => $job->id]);
    }

    #[Test]
    public function it_can_get_an_applicants2jobs()
    {
        $item = Applicants2Jobs::factory()->create();
        $response = $this->getJson("/api/v1/applicants2jobs/{$item->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $item->id]);
    }

    #[Test]
    public function it_returns_404_for_non_existent_applicants2jobs()
    {
        $response = $this->getJson('/api/v1/applicants2jobs/99999');
        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_an_applicants2jobs()
    {
        $item = Applicants2Jobs::factory()->create();
        $data = [
            'status' => 'hired',
        ];
        $response = $this->putJson("/api/v1/applicants2jobs/{$item->id}", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('applicants2jobs', ['id' => $item->id, 'status' => 'hired']);
    }

    #[Test]
    public function it_can_delete_an_applicants2jobs()
    {
        $item = Applicants2Jobs::factory()->create();
        $response = $this->deleteJson("/api/v1/applicants2jobs/{$item->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('applicants2jobs', ['id' => $item->id]);
    }
}
