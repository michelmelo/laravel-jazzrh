<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\Contact;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_contacts()
    {
        $contacts = Contact::factory()->count(3)->create();
        $response = $this->getJson(route('contacts.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_contact()
    {
        $contact = Contact::factory()->create();
        $response = $this->getJson(route('contacts.show', $contact->id));
        $response->assertOk()->assertJsonFragment(['id' => $contact->id]);
    }

    public function test_store_creates_contact()
    {
        $applicant = Applicant::factory()->create();
        $data = [
            'name' => 'Test Name',
            'email' => 'test@example.com',
            'phone' => '123456789',
            'applicant_id' => $applicant->id,
        ];
        $response = $this->postJson(route('contacts.store'), $data);
        $response->assertCreated()->assertJsonFragment($data);
        $this->assertDatabaseHas('contacts', $data);
    }

    public function test_update_modifies_contact()
    {
        $contact = Contact::factory()->create();
        $data = ['name' => 'Updated Name'];
        $response = $this->putJson(route('contacts.update', $contact->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('contacts', $data);
    }

    public function test_destroy_deletes_contact()
    {
        $contact = Contact::factory()->create();
        $response = $this->deleteJson(route('contacts.destroy', $contact->id));
        $response->assertNoContent();
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
}
