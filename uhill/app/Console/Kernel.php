<?php

namespace App\Console;

use App\Http\Controllers\CourseController;
use App\Models\Course;
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
        })->daily();
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
        foreach (Course::all() as $course){
            $personalityAvg = $course->reviews->avg('personality');
            $fairnessAvg = $course->reviews->avg('fairness');
            $easinessAvg = $course->reviews->avg('easiness');
            $overallAvg = ($personalityAvg + $easinessAvg + $fairnessAvg)/3;

            $course->update([
                'overall' => $overallAvg,
                'personality' => $personalityAvg,
                'easiness' => $easinessAvg,
                'fairness' => $fairnessAvg
            ],
            );
            $course->update(
                [
                    'review_count' => count($course->reviews)
                ]
            );
        }
    }
}
