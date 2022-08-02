<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTemplate;
use App\Models\Teacher;
use Carbon\Carbon;
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
            'bio' => ['string'],
            'subject' => ['required', 'min:3']
        ]);

        $teacher = Teacher::create($formFields);
        $teacherID = $teacher['id'];
        return redirect('/teacher/'.$teacherID);
    }

    public function assignCourse(int $id)
    {
        return view('admin.assignCourse')->with([
            'courses' => CourseTemplate::all(),
            'teacherID' => $id
        ]);
    }

    public function storeCourse(Request $request, int $id)
    {
        $teacher = Teacher::find($id);
        $courseTemplate = CourseTemplate::find($request['id']);

        $course_name = $courseTemplate['course_name'];
        $grade = $courseTemplate['grade'];
        $description = $courseTemplate['description'];

        $teacher->courses()->create([
            'teacher_id' => $teacher['id'],
            'course_name' => $course_name,
            'grade' => $grade,
            'description' => $description,
            'date_added' => Carbon::now(),

        ]);

        return redirect('teacher/'.$teacher['id']);

    }




}
