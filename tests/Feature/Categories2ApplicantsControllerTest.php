<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\Categories2Applicants;
use MichelMelo\JazzRh\Models\Category;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Tests\TestCase;

class Categories2ApplicantsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_items()
    {
        $items = Categories2Applicants::factory()->count(3)->create();
        $response = $this->getJson(route('categories2applicants.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_item()
    {
        $item = Categories2Applicants::factory()->create();
        $response = $this->getJson(route('categories2applicants.show', $item->id));
        $response->assertOk()->assertJsonFragment(['id' => $item->id]);
    }

    public function test_store_creates_item()
    {
        $category = Category::factory()->create();
        $applicant = Applicant::factory()->create();
        $data = [
            'category_id' => $category->id,
            'applicant_id' => $applicant->id,
        ];
        $response = $this->postJson(route('categories2applicants.store'), $data);
        $response->assertCreated()->assertJsonFragment($data);
        $this->assertDatabaseHas('categories2applicants', $data);
    }

    public function test_update_modifies_item()
    {
        $item = Categories2Applicants::factory()->create();
        $category = Category::factory()->create();
        $data = ['category_id' => $category->id];
        $response = $this->putJson(route('categories2applicants.update', $item->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('categories2applicants', $data);
    }

    public function test_destroy_deletes_item()
    {
        $item = Categories2Applicants::factory()->create();
        $response = $this->deleteJson(route('categories2applicants.destroy', $item->id));
        $response->assertNoContent();
        $this->assertDatabaseMissing('categories2applicants', ['id' => $item->id]);
    }
}
