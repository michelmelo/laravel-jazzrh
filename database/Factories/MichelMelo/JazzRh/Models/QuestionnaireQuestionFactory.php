<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\QuestionnaireQuestion;

class QuestionnaireQuestionFactory extends Factory
{
    protected $model = QuestionnaireQuestion::class;

    public function definition()
    {
        return [
            'question' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['text', 'multiple_choice', 'checkbox', 'rating', 'file']),
            'options' => $this->faker->randomElement([null, json_encode(['A', 'B', 'C'])]),
            'order' => $this->faker->numberBetween(1, 10),
            'is_required' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
