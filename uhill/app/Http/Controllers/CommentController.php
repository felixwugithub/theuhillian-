<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function store(Request $request, int $id){

        $course = Course::find($id);

        $course->comments()->create([
            'user_id' => Auth::id(),
            'course_id' => $id,
            'content' => $request['content'],
        ]);


        return Redirect::route('courseListing', $id)->with([
            'commented' => true,
        ]);

    }


}
