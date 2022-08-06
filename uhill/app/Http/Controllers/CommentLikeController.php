<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentLikeController extends Controller
{
    public function store(int $id, string $commentIndex){
            $comment = Comment::find($id);
            $comment->commentLikes()->create([
                'user_id' => Auth::id(),
                'comment_id' => $id,
            ]);
            return Redirect::route('courseListing', $comment->course->id)->with([
                'returnScrollComment' => true,
                'scroll' => $commentIndex
            ]);
    }

    public function destroy(int $id, string $commentIndex){

        $comment = Comment::find($id);
        auth()->user()->commentLikes()->where('comment_id', $comment->id)->delete();
        return Redirect::route('courseListing', $comment->course->id)->with([
            'returnScrollComment' => true,
            'scroll' => $commentIndex
        ]);

    }
}
