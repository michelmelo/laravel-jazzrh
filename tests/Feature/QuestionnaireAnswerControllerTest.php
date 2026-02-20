<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\QuestionnaireAnswer;
use MichelMelo\JazzRh\Models\QuestionnaireQuestion;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Tests\TestCase;

class QuestionnaireAnswerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_answers()
    {
        $answers = QuestionnaireAnswer::factory()->count(3)->create();
        $response = $this->getJson(route('questionnaire_answers.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_answer()
    {
        $answer = QuestionnaireAnswer::factory()->create();
        $response = $this->getJson(route('questionnaire_answers.show', $answer->id));
        $response->assertOk()->assertJsonFragment(['id' => $answer->id]);
    }

    public function test_store_creates_answer()
    {
        $question = QuestionnaireQuestion::factory()->create();
        $applicant = Applicant::factory()->create();
        $data = [
            'question_id' => $question->id,
            'applicant_id' => $applicant->id,
            'answer' => 'Test answer',
        ];
        $response = $this->postJson(route('questionnaire_answers.store'), $data);
        $response->assertCreated()->assertJsonFragment($data);
        $this->assertDatabaseHas('questionnaire_answers', $data);
    }

    public function test_update_modifies_answer()
    {
        $answer = QuestionnaireAnswer::factory()->create();
        $data = ['answer' => 'Updated answer'];
        $response = $this->putJson(route('questionnaire_answers.update', $answer->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('questionnaire_answers', $data);
    }

    public function test_destroy_deletes_answer()
    {
        $answer = QuestionnaireAnswer::factory()->create();
        $response = $this->deleteJson(route('questionnaire_answers.destroy', $answer->id));
        $response->assertNoContent();
        $this->assertDatabaseHas('questionnaire_answers', [
            'id' => $answer->id,
            'deleted_at' => now(), // Accepts any non-null value
        ]);
    }
}
