<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function create(){
        return view('admin.addTeacher')->with([
            'courses' => Course::all()
        ]);
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'bio' => ['string']
        ]);

        $teacher = Teacher::create($formFields);

        if(isset($request['assignCourse'])){
            $id = $request['assignCourse'];
            $course = Course::find($id);
            $teacher->courses()->save($course);



        $teacherID = $teacher['id'];
        return redirect('/teacher/'.$teacherID);}
    }

}
