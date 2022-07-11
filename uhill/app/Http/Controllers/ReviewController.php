<?php

namespace App\Http\Controllers;

use App\Models\Course;

use App\Models\Review;
use Illuminate\Http\Request;

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
        $data = request()->validate([
            'title' => 'required',
            'rating' => 'required|integer|between:1,10',
            'content' => 'required',
            'course_id' => 'nullable'
        ]);

        $data['course_id'] = $id;
        auth()->user()->reviews()->create($data);

        return view('course', [
            'course' => Course::find($id),
            'reviews' => Review::find($id)
        ]);
    }
}
