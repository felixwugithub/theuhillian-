<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function store(Request $request, int $id){

        $data = request()->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->content = $data['comment'];
        auth()->user()->comments()->save($comment);
        $course = Course::find($id);
        $course->comments()->save($comment);

        
        return Redirect::route('courseListing', $id)->with([
            'showComments' => true
        ]);
    }


}
