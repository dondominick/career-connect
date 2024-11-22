<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
    private $degrees = [
        "Bachelor of Arts (B.A.)",
        "Bachelor of Science (B.Sc.)",
        "Bachelor of Business Administration (B.B.A.)",
        "Bachelor of Fine Arts (B.F.A.)",
        "Bachelor of Engineering (B.Eng.)",
        "Bachelor of Education (B.Ed.)",
        "Bachelor of Computer Science (B.C.S.)",
        "Bachelor of Technology (B.Tech.)",
        "Bachelor of Architecture (B.Arch.)",
        "Bachelor of Nursing (B.N.)",
        "Bachelor of Social Work (B.S.W.)",
        "Bachelor of Music (B.Mus.)",
        "Bachelor of Laws (L.L.B.)",
        "Bachelor of Design (B.Des.)",
        "Bachelor of Applied Science (B.A.Sc.)",
    ];


    private $education_level = [
        "none",
        "highschool",
        "undergraduate",
        "bachelor",
        "masters",
        "phd",
    ];
    private $skills = [
        "accounting",
        'programming',
        "communication",
    ];


    private $experience = [
        "entry",
        "mid",
        "senior",
        "director",
        "executive",
    ];
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
        $requirements = [];
        $description = [];
        for ($i = 0; $i < Arr::random([1, 2, 3, 4, 5, 6]); $i++) {
            $requirements[] .= fake()->sentence();
            $description[] .= fake()->sentence();
        }
        $salary = fake()->randomNumber();

        return [
            "location" => Arr::random($this->location),
            "salary" => $salary . "-" . $salary + 1000,
            "education" => Arr::random($this->education_level),
            "requirements" => json_encode($requirements),
            "description" => json_encode($description),
            "company" => "",
            "arrangement" => 'wfh',
            "duration" => fake()->randomNumber(2),
            "email" => fake()->unique()->safeEmail(),
            "employer_id" => "",
            "companyID" => "",
            "age" => "18-25",
            'skills' => Arr::random($this->location),
        ];
    }
}
