<?php

namespace App\Console;

use App\Http\Controllers\CourseController;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            $this->calculateRatings();
        })->everyMinute();

        $schedule->call(function (){
            $this->calculateTeacherRatings();
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function calculateRatings()
    {
        foreach (Course::query()->where('review_count', '>', 0) as $course){

            $personalityAvg = $course->reviews->avg('personality');
            $content_coverageAvg = $course->reviews->avg('content_coverage');
            $fairnessAvg = $course->reviews->avg('fairness');
            $difficultyAvg = $course->reviews->avg('difficulty');
            $overallAvg = ($personalityAvg + $fairnessAvg + $content_coverageAvg)/3;

            $course->update([
                'overall' => $overallAvg,
                'personality' => $personalityAvg,
                'content_coverage' => $content_coverageAvg,
                'difficulty' => $difficultyAvg,
                'fairness' => $fairnessAvg
            ],
            );
            $course->update(
                [
                    'review_count' => count($course->reviews)
                ]
            );

        }

        foreach (Course::query()->where('review_count', '=', 0) as $course){

            $course->update(
                [
                    'review_count' => 0
                ]
            );

        }



        return 1;
    }

    private function calculateTeacherRatings()
    {
        foreach (Teacher::all() as $teacher){

            $content_coverageAvg = $teacher->courses->avg('content_coverage');
            $personalityAvg = $teacher->courses->avg('personality');
            $fairnessAvg = $teacher->courses->avg('fairness');
            $difficultyAvg = $teacher->courses->avg('difficulty');
            $overallAvg = $teacher->courses->avg('overall');

            $teacher->update([
                'overall' => $overallAvg,
                'personality' => $personalityAvg,
                'content_coverage' => $content_coverageAvg,
                'fairness' => $fairnessAvg,
                'difficulty' => $difficultyAvg
            ]);

        }

        return 1;
    }
}
