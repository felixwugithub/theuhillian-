<?php

namespace App\Http\Controllers;

use App\Models\Course;

use App\Models\Review;
use App\Models\Teacher;
use App\Notifications\NewReview;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    public function create($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('reviews.create', [
            'course' => Course::find($id)
        ]);
    }

    public function store($id, Request $request){

        $userId = auth()->id();

        if (! Review::where('user_id', $userId)->where('course_id', $id)->exists()) {
            $course = Course::find($id);
            $data = request()->validate([
                'title' => 'required',
                'personality' => 'required|integer|between:1,10',
                'fairness' => 'required|integer|between:1,10',
                'easiness' => 'required|integer|between:1,10',
                'content' => 'required',
                'course_id' => 'nullable'
            ]);

            $data['course_id'] = $id;

            $review = auth()->user()->reviews()->create($data);

            $notificationData = [
                'body' => 'course has received a new review!'
            ];

            $courseMembers = $course->courseMembers->pluck('user_id');
            $users = User::findMany($courseMembers);
            $users->notify(new NewReview($notificationData));






            $this->updateCourseRatings($id);
            $this->calculateTeacherRatings($course->teacher);

            return Redirect::route('courseListing', $review->course->id)->with([
                'reviewIndex' => 'review'.$review->id
            ]);

        } else {
            return view('course', [
                'course' => Course::find($id),
                'message' => 'only 1 review allowed.'
            ]);

        }


    }

    public function destroy($id){

        $review = Review::find($id);


        if(Auth::id() == $review->user->id){

            $review->delete();

        $this->updateCourseRatings($review->course->id);
        $this->calculateTeacherRatings($review->course->teacher);

        return Redirect::route('courseListing', $review->course->id);}
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
                'fairness' => 'required|integer|between:1,10',
                'easiness' => 'required|integer|between:1,10',
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

        return Redirect::route('courseListing', $review->course->id)->with([
            'reviewIndex' => 'review'.$review->id
        ]);}
        else{
            return "Nice try.";
        }

    }




    public function updateCourseRatings(int $id){
        $course =  Course::find($id);

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

    public function calculateTeacherRatings($teacher)
    {

            $personalityAvg = $teacher->courses->avg('personality');
            $fairnessAvg = $teacher->courses->avg('fairness');
            $easinessAvg = $teacher->courses->avg('easiness');
            $overallAvg = $teacher->courses->avg('overall');

            $teacher->update([
                'overall' => $overallAvg,
                'personality' => $personalityAvg,
                'easiness' => $easinessAvg,
                'fairness' => $fairnessAvg
            ]);

    }



}
