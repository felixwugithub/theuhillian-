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
            'grade' => fake()->numberBetween(8,13),
            'personality' => fake()->NumberBetween(0,10),
            'fairness' => fake()->NumberBetween(0,10),
            'easiness' => fake()->NumberBetween(0,10),
            'overall' => fake()->numberBetween(0, 10),
            'date_added'=> now(),
            'description'=> fake()->paragraph(5),
        ];
    }
}
