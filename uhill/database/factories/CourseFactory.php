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
            'course_name' => substr(fake()->jobTitle(),0, 32) ,
            'grade' => fake()->numberBetween(8,13),
            'personality' => fake()->NumberBetween(0,10),
            'fairness' => fake()->NumberBetween(0,10),
            'easiness' => fake()->NumberBetween(0,10),
            'overall' => fake()->numberBetween(0, 10),
            'subject' =>fake()->randomElement([
                'english', 'math', 'science', 'art', 'biology', 'chemistry', 'theatre', 'computers', 'languages',
                'career', 'community', 'economics', 'engineering', 'foods', 'music', 'physics', 'skills', 'statistics',
                'PE'
            ]),
            'date_added'=> now(),
            'description'=> fake()->paragraph(5),
        ];
    }
}
