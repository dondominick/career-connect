<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resume>
 */
class ResumeFactory extends Factory
{
    private $location = [
        "Panabo",
        "Tagum",
        "Davao",
        "Santo Thomas",
        "New Corella",
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "applicant_id" => Applicant::factory(),
            "name" => fake()->name(),
            "gender" => "Male",
            "age" => fake()->randomNumber(2),
            "email" => fake()->email(),
            "contact_no" => "09916216576",
            "address" => Arr::random($this->location),
            "education" => "elementary",
            "skills" => "communication,programming,accounting",
            "work" => "{\"position\":\"Software Engineer\",\"company\":\"Google\",\"duration\":\"June 2023 - June 2024\",\"value\":\"\"}",
            "educational_background" => "{\"position\":\"Software Engineer\",\"company\":\"Google\",\"duration\":\"June 2023 - June 2024\",\"value\":\"\"}",
            "reference" => "{\"name\":\"Don Dominick Enargan\",\"position\":\"CEO\",\"company\":\"Google\",\"email\":\"donenargan@gmail.com\",\"contact_no\":\"09916216576\"}",
        ];
    }
}
