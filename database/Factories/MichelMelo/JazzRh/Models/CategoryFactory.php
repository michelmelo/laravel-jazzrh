<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'color' => $this->faker->hexColor(),
            'icon' => $this->faker->word(),
            'type' => $this->faker->randomElement(['job', 'applicant']),
        ];
    }
}
