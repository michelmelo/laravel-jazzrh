<?php

namespace Database\Factories\MichelMelo\JazzRh\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use MichelMelo\JazzRh\Models\Applicant;

class ApplicantFactory extends Factory
{
    protected $model = Applicant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'cpf' => $this->generateCPF(),
            'birth_date' => $this->faker->dateTimeBetween('-65 years', '-18 years'),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'zip_code' => $this->faker->postcode(),
            'linkedin' => 'https://linkedin.com/in/'.str_replace(' ', '', $this->faker->name()),
            'portfolio' => 'https://example.com/portfolio',
            'status' => $this->faker->randomElement(['new', 'reviewing', 'approved', 'rejected', 'hired']),
            'score' => $this->faker->numberBetween(0, 100),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }

    private function generateCPF(): string
    {
        $numbers = '';
        for ($i = 0; $i < 9; $i++) {
            $numbers .= rand(0, 9);
        }

        $first_verifier = 0;
        for ($i = 0; $i < 9; $i++) {
            $first_verifier += (int) $numbers[$i] * (10 - $i);
        }
        $first_verifier = 11 - ($first_verifier % 11);
        $first_verifier = $first_verifier > 9 ? 0 : $first_verifier;

        $second_verifier = 0;
        for ($i = 0; $i < 10; $i++) {
            $second_verifier += (int) ($numbers[$i] ?? $first_verifier) * (11 - $i);
        }
        $second_verifier = 11 - ($second_verifier % 11);
        $second_verifier = $second_verifier > 9 ? 0 : $second_verifier;

        return $numbers.$first_verifier.$second_verifier;
    }
}
