<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Categories2Applicants;
use MichelMelo\JazzRh\Models\Category;
use MichelMelo\JazzRh\Models\Applicant;

class Categories2ApplicantsFactory extends Factory
{
    protected $model = Categories2Applicants::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'applicant_id' => Applicant::factory(),
        ];
    }
}
