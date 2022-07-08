<?php

namespace App\Http\Controllers;

use App\Models\Course;

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

    public function store(Request $request, $id){

        $course = Course::find($id);
        $data = request()->validate([
            'title' => 'required',
            'rating' => 'required|integer|between:1,10',
            'content' => 'required'
        ]);
        $data['course_id'] = $course['id'];

        auth()->user()->reviews()->create($data);

        return redirect('/course/');
    }
}
