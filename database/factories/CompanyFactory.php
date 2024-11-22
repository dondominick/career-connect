<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employer;
use App\Models\Internship;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "companyName" => fake()->company(),
            "companyLocation" => "Panabo",
            "companySize" => "<10",
            "companyIndustry" => "Technology",
            "companyNum" => "09916216576",
            "contactPerson" => fake()->name(),
            "companyEmail" => fake()->unique()->safeEmail(),
        ];
    }

    public function newCompany(): Factory
    {

        return $this->afterCreating(function () use (&$user) {

            $user =  User::factory()->create([
                "position" => "company"
            ]);
        })->afterCreating(function (Company $company) use (&$user, &$employer) {

            $employer = Employer::factory()->create([
                'user_id' => $user->id,
                'fname' =>  $user->fname,
                'lname' =>  $user->lname,
                'email' =>  $user->email,
                'birthdate' =>  $user->birthdate,
                "companyID" => $company->id,
                "company" => $company->companyName
            ]);
        })->afterCreating(function (Company $company) use (&$employer) {
            Listing::factory()->count(15)->create([
                "employer_id" => $employer->id,
                "companyID" => $company->id,
                "company" => $company->companyName,
            ]);

            Internship::factory()->count(5)->create([
                "employer_id" => $employer->id,
                "companyID" => $company->id,
                "company" => $company->companyName,
            ]);
        });
    }
}
