<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTemplate;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Course_Template_Controller extends Controller
{
    public function create(){
        if (Auth::check() && \auth()->user()->admin == 1){
        return view('admin.addCourse')->with([
            'courses' => Course::all(),
            'teachers' => Teacher::all()
        ]);}
    }

    public function store(Request $request){
        if (Auth::check() && \auth()->user()->admin == 1){
        $formFields = $request->validate([
            'course_name' => ['required', 'min:3'],
            'subject' => ['required', 'min:2'],
            'description' => ['string'],
            'grade' => 'required|integer|between:8,13'
        ]);

        CourseTemplate::create($formFields);
        return redirect('/');
    }}
}
