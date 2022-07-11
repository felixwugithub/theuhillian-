<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'course_name' => fake()->jobTitle(),
            'personality' => fake()->biasedNumberBetween(0,10),
            'fairness' => fake()->biasedNumberBetween(0,10),
            'easiness' => fake()->biasedNumberBetween(0,10),
            'date_added'=> now(),
            'description'=> fake()->paragraph(5),
        ];
    }
}
