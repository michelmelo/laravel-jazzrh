<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Note;
use MichelMelo\JazzRh\Models\User;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Job;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'user_id' => User::factory(),
            'applicant_id' => Applicant::factory(),
            'job_id' => Job::factory(),
        ];
    }
}
