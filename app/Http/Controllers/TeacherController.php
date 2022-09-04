<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTemplate;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function create(){
        if(Auth::check() && \auth()->user()->admin == 1){
        return view('admin.addTeacher')->with([
            'courses' => Course::all()
        ]);}else{
            return "lmao nice try.";
        }
    }

    public function store(Request $request){

        if(Auth::check() && auth()->user()->admin == 1){

        $formFields = $request->validate([
            'name' => ['required', 'min:2', 'max:32'],
            'real_name' => ['required', 'min:2', 'max:32'],
        ]);

        $teacher = Teacher::create($formFields);
        $teacherID = $teacher['id'];
        return redirect('/teacher/'.$teacherID);}
        else{
            return "nice try bro hehehehaw";
        }
    }


    public function assignCourse(int $id)
    {

        if(\auth()->user()->admin == 1){
        return view('admin.assignCourse')->with([
            'courses' => CourseTemplate::all(),
            'teacherID' => $id
        ]);}
        else{
            return "nice try brotha";
        }
    }

    public function storeCourse(Request $request, int $id)
    {

        if(auth()->user()->admin == 1)
        {
        $teacher = Teacher::find($id);
        $courseTemplate = CourseTemplate::find($request['assignCourse']);

        $course_name = $courseTemplate['course_name'];
        $grade = $courseTemplate['grade'];
        $description = $courseTemplate['description'];
        $subject = $courseTemplate['subject'];

        $teacher->courses()->create([
            'teacher_id' => $teacher['id'],
            'course_name' => $course_name,
            'grade' => $grade,
            'description' => $description,
            'subject' => $subject,
            'date_added' => Carbon::now(),

        ]);

        return redirect('teacher/'.$teacher['id']);}

        else{
            return "go to hell.";
        }

    }




}
