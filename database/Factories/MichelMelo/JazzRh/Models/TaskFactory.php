<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Task;
use MichelMelo\JazzRh\Models\User;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'assigned_to' => User::factory(),
            'user_id' => User::factory(),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'completed_at' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
