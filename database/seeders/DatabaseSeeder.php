<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleCoverImage;
use App\Models\Club;
use App\Models\Comment;
use App\Models\Course;
use App\Models\CourseRequest;
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

       $user1 = User::factory()->create([
            'email' => 'admin@learn.vsb.bc.ca',
            'password' => bcrypt("123456"),
            'admin' => 1
        ]);

       Profile::factory()->create([
           'user_id' => $user1->id
       ]);

        for ($x = 0; $x <= 35; $x++) {

            $club = Club::factory()->create();
            $article = Article::factory()->create([
                'club_id' => $club->id
            ]);

            ArticleCoverImage::factory()->create([
                'article_id' => $article->id
            ]);


            $teacher = Teacher::factory()->create();

            for ($y = 0; $y <= 5; $y++){
                $course = Course::factory()->create([
                    'teacher_id' => $teacher->id
                ]);

                for ($y = 0; $y <= 30; $y++){
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

                    CourseRequest::factory()->create([
                        'user_id' => $user->id
                    ]);
                }
            }



        }



    }
}
