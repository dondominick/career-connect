<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Company;
use App\Models\Employer;
use App\Models\Internship;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // First Initialize applicants, and companies

        User::factory()->applicant()->count(10)->create();
        Company::factory()->newCompany()->count(3)->create();


        // Second initialize job listings and internships

        // Listing::factory()->count(15)->state(new Sequence(
        //     ["company" => 'Schroeder-Ernser', "companyID" => "1", "employer_id" => "1"],
        //     ["company" => 'Koelpin, Watsica and Weber', "companyID" => "2", "employer_id" => "2"],
        //     ["company" => 'Daniel LLC', "companyID" => "3", "employer_id" => "3"],
        // ))->create();
        // Internship::factory()->count(5)->state(new Sequence(
        //     ["company" => 'Schroeder-Ernser', "companyID" => "1", "employer_id" => "1"],
        //     ["company" => 'Koelpin, Watsica and Weber', "companyID" => "2", "employer_id" => "2"],
        //     ["company" => 'Daniel LLC', "companyID" => "3", "employer_id" => "3"],

        // ))->create();
    }
}
