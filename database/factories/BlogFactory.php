<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(4),
            "sub_title" => $this->faker->sentence(),
            'body' => $this->faker->realText(800),
            "category_id" => $this->faker->numberBetween(2, 5),
            "user_id" => $this->faker->numberBetween(2, 5),
        ];
    }
}