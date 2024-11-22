<?php

namespace Database\Factories;

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
            'user_id' => User::factory(),
            'fname' => fake()->firstName(),
            'lname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'birthdate' => fake()->date(),
            'gender' => "Male",
            'resume' => json_encode([
                "name" => fake()->name(),
                "email" => fake()->safeEmail(),
                "contactNum" => "09916216576",
                "age" => "18",
                "gender" => "Male",
                "education" => "College Graduate",
                "work" => "None",
                "address" => Arr::random($this->location),
                "references" => "123",
                'skills' => Arr::random($this->skills),
            ]),
        ];
    }
}
