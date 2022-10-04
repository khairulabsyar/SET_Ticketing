<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            "first_name" => $this->faker->name(),
            "last_name" => $this->faker->name(),
            "password" => $this->faker->password(),
            'email' => $this->faker->email(),
        ];
    }
}