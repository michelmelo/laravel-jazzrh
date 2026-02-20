<?php

namespace MichelMelo\JazzRh\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MichelMelo\JazzRh\Models\QuestionnaireQuestion;
use MichelMelo\JazzRh\Tests\TestCase;

class QuestionnaireQuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_questions()
    {
        $questions = QuestionnaireQuestion::factory()->count(3)->create();
        $response = $this->getJson(route('questionnaire_questions.index'));
        $response->assertOk()->assertJsonCount(3);
    }

    public function test_show_returns_single_question()
    {
        $question = QuestionnaireQuestion::factory()->create();
        $response = $this->getJson(route('questionnaire_questions.show', $question->id));
        $response->assertOk()->assertJsonFragment(['id' => $question->id]);
    }

    public function test_store_creates_question()
    {
        $data = [
            'question' => 'What is your favorite color?',
            'type' => 'text',
            'options' => ['Red', 'Blue', 'Green'],
            'order' => 1,
            'is_required' => true,
            'status' => 'active',
        ];
        $response = $this->postJson(route('questionnaire_questions.store'), $data);
        $response->assertCreated()->assertJsonFragment(['question' => 'What is your favorite color?']);
        $this->assertDatabaseHas('questionnaire_questions', ['question' => 'What is your favorite color?']);
    }

    public function test_update_modifies_question()
    {
        $question = QuestionnaireQuestion::factory()->create();
        $data = ['question' => 'Updated question?'];
        $response = $this->putJson(route('questionnaire_questions.update', $question->id), $data);
        $response->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('questionnaire_questions', $data);
    }

    public function test_destroy_deletes_question()
    {
        $question = QuestionnaireQuestion::factory()->create();
        $response = $this->deleteJson(route('questionnaire_questions.destroy', $question->id));
        $response->assertNoContent();
        $this->assertSoftDeleted('questionnaire_questions', ['id' => $question->id]);
    }
}
