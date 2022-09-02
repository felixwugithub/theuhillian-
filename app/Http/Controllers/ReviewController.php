<?php

namespace App\Http\Controllers;

use App\Models\Course;

use App\Models\Review;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\NewReview;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    public function create($id){
        if (! Review::where('user_id', auth()->id())->where('course_id', $id)->exists()) {
        return view('reviews.create', [
            'course' => Course::find($id)
        ]);}
        else{
            return \redirect('/course/'.$id)->with([
                'message' => 'You can only leave one review.'
            ]);
        }
    }

    public function store($id, Request $request){

        $userId = auth()->id();
        $course = Course::find($id);

        if (! Review::where('user_id', $userId)->where('course_id', $id)->exists()) {

            $data = request()->validate([
                'title' => 'required',
                'personality' => 'required|integer|between:1,10',
                'content_coverage' => 'required|integer|between:1,10',
                'fairness' => 'required|integer|between:1,10',
                'difficulty' => 'required|integer|between:1,10',
                'content' => 'required|min:3|max:2048',
                'course_id' => 'nullable'
            ]);

            $data['course_id'] = $id;

            $review = auth()->user()->reviews()->create($data);

            $notificationData = [
                'body' => $course->course_name.' received a new review from '.Auth::user()->username,
                'course_id' => $course->id,
                'reviewer_id' => auth()->id(),
                'review_id' => $review->id
            ];

            $courseMembers = $course->course_members->pluck('user_id');
            $users = User::findMany($courseMembers);

            foreach($users as $recipient){
                Notification::send($recipient, new newReview($notificationData));
            }


            $this->updateCourseRatings($id);
            $this->calculateTeacherRatings($course->teacher);

            return \redirect('/course-review/'.$id.'/'.$review->id);

        } else {
            return \redirect('/course/'.$id);
        }

    }

    public function destroy($id){

        $review = Review::find($id);

        if(Auth::id() == $review->user->id){

            $review->delete();

            $this->updateCourseRatings($review->course->id);
            $this->calculateTeacherRatings($review->course->teacher);

            return Redirect::route('courseListing', $review->course->id);
        }
        else{
            return ("Nice try.");
        }

    }


    public function update($review_id, Request $request){

        $review = Review::find($review_id);

        if(Auth::id() == $review->user->id){
        $data = $request->validate(
            [
                'title' => 'required',
                'personality' => 'required|integer|between:1,10',
                'content_coverage' => 'required|integer|between:1,10',
                'fairness' => 'required|integer|between:1,10',
                'difficulty' => 'required|integer|between:1,10',
                'content' => 'required',
                'course_id' => 'nullable',
                'updated_at' => 'nullable'
            ]
        );

        $data['course_id'] = $review->course->id;
        $data['updated_at'] = Carbon::now();

        $review->update($data);

        $this->updateCourseRatings($review->course->id);
        $this->calculateTeacherRatings($review->course->teacher);

        return \redirect('/course-review/'.$review->course->id.'/'.$review->id);}
        else{
            return "Nice try.";
        }

    }




    public function updateCourseRatings(int $id){
        $course =  Course::find($id);

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

    public function calculateTeacherRatings($teacher)
    {

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



}
