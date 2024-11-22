<?php

namespace Database\Factories;

use App\Models\Applicant;
use App\Models\Company;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
            'email_verified_at' => now(),
            'password' => "123",
            'remember_token' => Str::random(10),
            'position' => 'applicant',
        ];
    }


    public function employer(array $attributes) {}

    public function applicant()
    {

        return $this->state(function () {
            return [
                'position' => "applicant"
            ];
        })->afterCreating(function (User $user) {
            Applicant::factory()->create([
                'user_id' => $user->id,
                'fname' =>  $user->fname,
                'lname' =>  $user->lname,
                'email' =>  $user->email,
                'birthdate' =>  $user->birthdate,
            ]);
        });
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
