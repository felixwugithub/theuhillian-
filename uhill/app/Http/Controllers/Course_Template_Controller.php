<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTemplate;
use App\Models\Teacher;
use Illuminate\Http\Request;

class Course_Template_Controller extends Controller
{
    public function create(){
        return view('admin.addCourse')->with([
            'courses' => Course::all(),
            'teachers' => Teacher::all()
        ]);
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'course_name' => ['required', 'min:3'],
            'subject' => ['required', 'min:2'],
            'description' => ['string'],
            'grade' => 'required|integer|between:1,10'
        ]);

        CourseTemplate::create($formFields);
        return redirect('/');
    }
}
