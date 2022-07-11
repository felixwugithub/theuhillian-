<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        for ($x = 0; $x <= 10; $x++) {
            $teacher = Teacher::factory()->create();
            Course::factory(random_int(1,5))->create([
                'teacher_id' => $teacher->id
            ]);
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
