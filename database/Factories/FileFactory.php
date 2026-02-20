<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\File;
use MichelMelo\JazzRh\Models\Applicant;
use MichelMelo\JazzRh\Models\Job;

class FileFactory extends Factory
{
    protected $model = File::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . '.pdf',
            'path' => $this->faker->filePath(),
            'type' => 'pdf',
            'size' => $this->faker->numberBetween(1000, 1000000),
            'applicant_id' => Applicant::factory(),
            'job_id' => Job::factory(),
        ];
    }
}
