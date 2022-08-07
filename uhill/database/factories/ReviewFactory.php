<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence,
            'personality' => fake()->numberBetween(1,10),
            'fairness' => fake()->numberBetween(1,10),
            'easiness' => fake()->numberBetween(1,10),
            'content' => fake()->paragraph(4, true)
        ];
    }
}
