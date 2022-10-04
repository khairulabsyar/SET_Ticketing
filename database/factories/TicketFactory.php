<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => "this is a title: " . Str::random(10),
            'description' => "this is a description" . Str::random(10),
            'user_id' => 1,
            'priority_id' => 1,
            'status_id' => 1,
            'category_id' => 1,
        ];
    }
}