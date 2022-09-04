<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseRequest>
 */
class CourseRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name' => fake()->jobTitle,
            'code' => fake()->postcode,
            'description' => fake()->paragraph(),
            'teacher_name' => fake()->name,
            'room_number' => fake()->country,
            'grade' => random_int(8,12),
        ];
    }
}
