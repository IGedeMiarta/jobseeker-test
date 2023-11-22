<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = rand(0, 1);
        $randGender = ($randomNumber == 0) ? 'F' : 'M';
        return [
            'email'         => fake()->unique()->safeEmail(),
            'phone_number'  => fake()->unique()->phoneNumber(),
            'full_name'     => fake()->name(),
            'dob'           => fake()->date(),
            'pob'           => fake()->country(),
            'gender'        => $randGender,
            'year_exp'      => rand(1,5),
            'last_salary'   => rand(400000000,800000000)
        ];
    }
}
