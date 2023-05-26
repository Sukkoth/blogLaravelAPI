<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_name" => Str::random(6),
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "phone" => $this->faker->phoneNumber(),
            "password" => Hash::make('password'),
            "birth_date" => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}