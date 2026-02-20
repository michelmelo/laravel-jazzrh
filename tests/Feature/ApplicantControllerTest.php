<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Category;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ApplicantControllerTest extends TestCase
{
    #[Test]
    public function it_can_get_all_applicants()
    {
        Applicant::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/applicants');

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_an_applicant()
    {
        $data = [
            'name' => 'João Silva',
            'email' => 'joao'.time().'@example.com',
            'phone' => '11987654321',
            'cpf' => $this->generateCPF(),
            'birth_date' => '1990-05-15',
            'address' => 'Rua das Flores, 123',
            'city' => 'São Paulo',
            'state' => 'SP',
            'zip_code' => '01234-567',
            'linkedin' => 'https://linkedin.com/in/joao',
            'portfolio' => 'https://joao.com',
        ];

        $response = $this->postJson('/api/v1/applicants', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('applicants', ['email' => $data['email']]);
    }

    #[Test]
    public function it_can_get_an_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->getJson("/api/v1/applicants/{$applicant->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $applicant->id]);
    }

    #[Test]
    public function it_returns_404_for_non_existent_applicant()
    {
        $response = $this->getJson('/api/v1/applicants/99999');

        $response->assertStatus(404);
    }

    #[Test]
    public function it_can_update_an_applicant()
    {
        $applicant = Applicant::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated'.time().'@example.com',
            'phone' => '11987654321',
            'cpf' => $this->generateCPF(),
            'birth_date' => '1990-05-15',
            'address' => 'Rua Nova, 456',
            'city' => 'Rio de Janeiro',
            'state' => 'RJ',
            'zip_code' => '98765-432',
            'linkedin' => 'https://linkedin.com/in/updated',
            'portfolio' => 'https://updated.com',
        ];

        $response = $this->putJson("/api/v1/applicants/{$applicant->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('applicants', ['id' => $applicant->id, 'name' => 'Updated Name']);
    }

    #[Test]
    public function it_can_delete_an_applicant()
    {
        $applicant = Applicant::factory()->create();

        $response = $this->deleteJson("/api/v1/applicants/{$applicant->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('applicants', ['id' => $applicant->id]);
    }

    #[Test]
    public function it_can_get_applicants_by_job()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $job = Job::factory()->create([
            'posted_by' => $user->id,
            'category_id' => $category->id,
        ]);
        $applicants = Applicant::factory()->count(3)->create();

        foreach ($applicants as $applicant) {
            $applicant->jobs()->attach($job);
        }

        $response = $this->getJson("/api/v1/applicants/job/{$job->id}");

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_search_applicants()
    {
        Applicant::factory()->create(['name' => 'John Developer', 'email' => 'john'.time().'@example.com']);
        Applicant::factory()->create(['name' => 'Jane Designer', 'email' => 'jane'.time().'@example.com']);

        $response = $this->getJson('/api/v1/applicants/search/john');

        $response->assertStatus(200);
    }

    private function generateCPF(): string
    {
        $numbers = '';
        for ($i = 0; $i < 9; $i++) {
            $numbers .= rand(0, 9);
        }

        $first_verifier = 0;
        for ($i = 0; $i < 9; $i++) {
            $first_verifier += (int) $numbers[$i] * (10 - $i);
        }
        $first_verifier = 11 - ($first_verifier % 11);
        $first_verifier = $first_verifier > 9 ? 0 : $first_verifier;

        $second_verifier = 0;
        for ($i = 0; $i < 10; $i++) {
            $second_verifier += (int) ($numbers[$i] ?? $first_verifier) * (11 - $i);
        }
        $second_verifier = 11 - ($second_verifier % 11);
        $second_verifier = $second_verifier > 9 ? 0 : $second_verifier;

        return $numbers.$first_verifier.$second_verifier;
    }
}
