<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseMemberController extends Controller
{
    public function join($id){

        $course = Course::find($id);

        if(Auth::check() && !$course->courseJoined(Auth::user())){
            $course->course_members()->create([
                'course_id' => $course->id,
                'user_id' => Auth::id()
            ]);
            return back();
        }else{
            return "You're already in this course";
        }
    }

    public function quit($id){

        $course = Course::find($id);
        if(Auth::check() && $course->courseJoined(Auth::user())){
            $course->course_members()->where('user_id', Auth::id())->delete();
            return back();
        }else{
            return "You're not in this course to begin with bruh...";
        }
    }
}
