<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Applicants2Jobs;
use MichelMelo\JazzRh\Models\Job;

class Applicants2JobsFactory extends Factory
{
    protected $model = Applicants2Jobs::class;

    public function definition(): array
    {
        return [
            'applicant_id' => Applicant::factory(),
            'job_id' => Job::factory(),
            'status' => $this->faker->randomElement(['applied', 'hired', 'rejected']),
            'applied_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'hired_at' => null,
        ];
    }
}
