<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRequest;
use App\Models\CourseTemplate;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseRequestController extends Controller
{
    public function create(){
        if (Auth::check()){
            if(Auth::user()->course_requests()->today()->count() < 1){
                return view('request');
            }else{
                return "You can only request 1 course per day. We have like 1 guy reviewing course requests, he needs some rest :(((";
            }
        }else{
            return redirect('/login');
        }
    }

    public function store(Request $request){
        if(Auth::check()){
            if(Auth::user()->course_requests()->today()->count() < 1){
                $data = $request->validate([
                    'name' => 'string|min:2|max:64|required',
                    'teacher_name' => 'string|min:2|max:32|required',
                    'code' => 'string|nullable|max:12',
                    'room_number' => 'string|nullable|max:12',
                    'description' => 'string|min:10|max:512|required',
                    'grade' => 'integer|required|min:8|max:12'
                ]);

                $course_request = Auth::user()->course_requests()->create($data, [
                    'user_id' => Auth::id()
                ]);

                return redirect('/')->with([
                    'request-success' => true
                ]);

            }else{
                return "You can only request 1 course per day. We have like 1 guy reviewing course requests, he needs some rest :(((";
            }

        }else{
            return redirect('/login');
        }
    }

    public function display(){
        if (Auth::check() && Auth::user()->admin == 1){
            return view('admin.requests', [
                'requests' => CourseRequest::query()->orderByDesc('created_at')->paginate(20)
            ]);
        }else{
            return redirect('/login');
        }
    }

    public function review($id){
        if(Auth::check()&&Auth::user()->admin == 1){
            $request = CourseRequest::find($id);
            if(isset($request)){
                return view('admin.request-review', [
                    'request' => $request,
                    'teachers' => Teacher::all(),
                    'courses' => Course::all(),
                    'templates' => CourseTemplate::all()
                ]);
            }else{
                return "void";
            }
        }
    }

    public function quickAdd(Request $request, $id)

    {

        $course_request = CourseRequest::find($id);

        if (Auth::check() && Auth::user()->admin == 1) {
            $data = $request->validate([
                'course_name' => ['required', 'min:3', 'max:64'],
                'teacher_real_name' => 'required|min:2|max:32|string',
                'subject' => ['required', 'min:2', 'string'],
                'description' => ['string', 'nullable', 'max:512'],
                'grade' => 'required|integer|between:8,13',
                'teacher' => 'integer|nullable',
                'code' => 'nullable',
                'teacher_name' => 'nullable',
                'createteacher' => 'nullable',
                'template' => 'nullable|integer',
                'usetemplate' => 'nullable'
            ]);

            if(isset($data['usetemplate']) && $data['template'] > 0 ){
                $template = CourseTemplate::find($data['template']);
            }else{
                $template = CourseTemplate::create([
                    'course_name' => $data['course_name'],
                    'grade' => $data['grade'],
                    'subject' => $data['subject'],
                    'code' => $data['code']
                ]);

            }

            if (isset($data['createteacher'])){
                $teacher = Teacher::create([
                    'name' => $data['teacher_name'],
                    'real_name' => $data['teacher_real_name'],
                ]);
            }else{
                $teacher = Teacher::find($data['teacher']);
            }

            $teacher->courses()->create([
                'teacher_id' => $teacher->id,
                'course_name' => $template->course_name,
                'grade' => $template->grade,
                'description' => $data['description'],
                'subject' => $template->subject,
                'code' => $template->code,
                'date_added' => Carbon::now()
            ]);


            $course_request->update([
                'accepted' => true,
                'closed' => true
            ]);

            return back();
        } else {
            return redirect('/');
        }
    }
}
