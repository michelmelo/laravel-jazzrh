<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\QuestionnaireAnswer;
use MichelMelo\JazzRh\Models\QuestionnaireQuestion;
use MichelMelo\JazzRh\Models\Applicant;

class QuestionnaireAnswerFactory extends Factory
{
    protected $model = QuestionnaireAnswer::class;

    public function definition(): array
    {
        return [
            'question_id' => QuestionnaireQuestion::factory(),
            'applicant_id' => Applicant::factory(),
            'answer' => $this->faker->sentence(),
        ];
    }
}
