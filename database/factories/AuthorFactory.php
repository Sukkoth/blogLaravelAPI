<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            "phone" => $this->faker->phoneNumber(),
            "password" => Hash::make('password'),
            "bio" => "lorem ipsum dash has joe done dum tightredd",
            "birth_date" => $this->faker->date()
        ];
    }
}