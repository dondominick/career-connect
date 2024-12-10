<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Applicant>
 */
class ApplicantFactory extends Factory
{
    private $location = [
        "Panabo",
        "Tagum",
        "Davao",
        "Santo Thomas",
        "New Corella",
    ];
    private $skills = [
        "accounting",
        'programming',
        "communication",
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'birthdate' => fake()->date(),
            'gender' => "Male",

        ];
    }
}
