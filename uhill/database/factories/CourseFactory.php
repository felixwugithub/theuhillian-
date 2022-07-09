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
            'course_id' => fake()->unique()->hexColor,
            'teacher_name' => fake()->name,
            'rating' => fake()->biasedNumberBetween(0,10),
            'date_added'=> now(),
            'description'=> fake()->paragraph(5),

        ];
    }
}
