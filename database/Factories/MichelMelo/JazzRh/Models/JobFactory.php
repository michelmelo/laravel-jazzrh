<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Category;
use MichelMelo\JazzRh\Models\Job;
use MichelMelo\JazzRh\Models\User;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'category_id' => Category::factory(),
            'location' => $this->faker->city(),
            'salary_min' => $this->faker->numberBetween(3000, 5000),
            'salary_max' => $this->faker->numberBetween(6000, 10000),
            'contract_type' => $this->faker->randomElement(['clt', 'pj', 'temporary', 'internship']),
            'seniority_level' => $this->faker->randomElement(['junior', 'mid-level', 'senior']),
            'status' => $this->faker->randomElement(['draft', 'published', 'closed']),
            'posted_by' => User::factory(),
            'posted_at' => $this->faker->dateTime(),
            'closes_at' => $this->faker->dateTimeBetween('+1 days', '+30 days'),
        ];
    }

    public function active(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'posted_at' => now()->subDays(5),
            'closes_at' => now()->addDays(25),
        ]);
    }

    public function closed(): self
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'closed',
        ]);
    }
}
