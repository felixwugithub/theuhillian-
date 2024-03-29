<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewReport;
use App\Models\User;
use App\Notifications\NewReview;
use App\Notifications\Warning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ReviewReportController extends Controller
{
    public function create($id){

        $review = Review::find($id);

        if (!Auth::user()->review_reports->pluck('review_id')->contains($id)) {

            if (Auth::check()) {
                return view('review-report', [
                    'review' => $review
                ]);
            } else {
                return "bruh";
            }
        }else{
            return "One report per review";
        }
    }

    public function store(Request $request, $id){
        if(Auth::check()){

            $review = Review::find($id);

            if (!Auth::user()->review_reports()->pluck('review_id')->contains($review->id)){

                $data = $request->validate([
                    'description' => 'required|min:2|max:512|string'
                ]);
                $review->reports()->create([
                    'user_id' => Auth::id(),
                    'review_id' => $id,
                    'description' => $data['description']
                ]);

                return redirect('/course-review/'.$review->course->id.'/'.$review->id);
            }else{
                return "One report per review";
            }
        }
    }

    public function view(){


        if (Auth::check()&&\auth()->user()->admin == 1){
        return view('admin.review-reports',[
            'reports' => ReviewReport::query()->where('closed', false)->paginate(20)
        ]);}

    }

    public function reject($id){
        if (Auth::check()){
            if(\auth()->user()->admin == 1){
                $report = ReviewReport::find($id);
                $report->update([
                    'closed' => true
                ]);

                $this->updateRating($report->review->course);
                
                return back()->with([
                    'message' => 'report rejected'
                ]);

            }else{
                return "bruh";
            }
        }else{
            return "bruh";
        }

    }

    public function warn($id){
        if (Auth::check()){
            if(\auth()->user()->admin == 1){
                $report = ReviewReport::find($id);


                $notificationData = [
                    'body' => 'Your recent review on '. $report->review->course->course_name. ' was against our community guidelines.
                    repeated violations will lead to a permanent, irreversible ban.',
                    'context_title' => $report->review->title,
                    'context_content' => $report->review->content,
                ];

                Notification::send($report->review->user, new Warning($notificationData));


                $report->review->delete();

                $report->update([
                    'closed' => true
                ]);

                $this->updateRating($report->review->course);

                return back()->with([
                    'message' => 'review deleted, user warned'
                ]);

            }else{
                return "bruh";
            }
        }else{
            return "bruh";
        }
    }


    public function ban($id){
        if (Auth::check()){
            if(\auth()->user()->admin == 1){
                $report = ReviewReport::find($id);

                $notificationData = [
                    'body' => 'Your recent review on '. $report->review->course->course_name. ' was against our community guidelines.
                    You have been banned. :( ',
                    'context_title' => $report->review->title,
                    'context_content' => $report->review->content,
                ];

                Notification::send($report->review->user, new Warning($notificationData));

                $report->review->user->update([
                    'banned' => true,
                    'username' => 'banned_user_'.uniqid()
                 ]);

                $report->review->delete();

                $report->update([
                    'closed' => true
                ]);

                $this->updateRating($report->review->course);

                return back()->with([
                    'message' => 'review deleted, user banned'
                ]);

            }else{
                return "bruh";
            }
        }else{
            return "bruh";
        }
    }


    private function updateRating($course){

        $course->update(
            [
                'review_count' => count($course->reviews)
            ]
        );

        if($course->review_count > 0){

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

        }else{
            $course->update([
                'overall' => 5,
                'personality' => 5,
                'difficulty' => 5,
                'content_coverage' => 5,
                'fairness' => 5,
                'review_count' => count($course->reviews)
            ]);
        }
    }

}
