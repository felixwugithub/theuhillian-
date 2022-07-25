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
            $courseClone = $course->replicate();
            $teacher->courses()->save($courseClone);

        $teacherID = $teacher['id'];
        return redirect('/teacher/'.$teacherID);}
    }

    public function addCourse(Request $request, int $id){

        $teacher = Teacher::find($id);
        if(isset($request['assignCourse'])){
            $id = $request['assignCourse'];
            $course = Course::find($id);
            $courseClone = $course->replicate();
            $teacherID = $teacher['id'];
            $teacher->courses()->save($courseClone);
            return redirect('/teacher/'.$teacherID);}
    }

}
