<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function create(){
        return view('admin.addTeacher');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'bio' => ['string']
        ]);

        $teacher = Teacher::create($formFields);
        $teacherID = $teacher['id'];
        return redirect('/teacher/{{$teacherID}}');
    }

}
