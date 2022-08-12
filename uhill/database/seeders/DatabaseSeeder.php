<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Review;
use App\Models\Teacher;
use App\Models\User;
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

       $user =  User::factory()->create([
            'email' => 'admin@learn.vsb.bc.ca',
            'password' => bcrypt("123456"),
            'admin' => 1
        ]);

       $user->profile->create([
           ''
       ]);

        for ($x = 0; $x <= 35; $x++) {



            Club::factory()->create();
            $teacher = Teacher::factory()->create();

            for ($y = 0; $y <= 5; $y++){
                $course = Course::factory()->create([
                    'teacher_id' => $teacher->id
                ]);

                for ($y = 0; $y <= 5; $y++){
                    $user = User::factory()->create();

                    Profile::factory()->create([
                        'user_id' => $user->id
                    ]);

                    Review::factory()->create([
                        'course_id' => $course->id,
                        'user_id' => $user->id
                    ]);
                    Comment::factory(random_int(0,5))->create([
                        'course_id' => $course->id,
                        'user_id' => $user->id
                    ]);
                }
            }



        }



    }
}
