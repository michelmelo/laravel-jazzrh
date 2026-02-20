<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Activity;
use MichelMelo\JazzRh\Models\User;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['meeting', 'call', 'task']),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'user_id' => User::factory(),
            'job_id' => null,
            'applicant_id' => null,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'completed_at' => null,
        ];
    }
}
