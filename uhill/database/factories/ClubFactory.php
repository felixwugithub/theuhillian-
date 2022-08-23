<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Club>
 */
class ClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->jobTitle,
            'description' => fake()->paragraph,
            'room_number' => fake()->numberBetween(100,999),
            'meeting_times' => fake()->dayOfWeek,
            'overall' => 0,
            'president' => fake()->name,
            'vice_president' => fake()->name
        ];
    }
}
