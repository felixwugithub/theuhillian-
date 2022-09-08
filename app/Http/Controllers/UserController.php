<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Course;
use App\Models\CourseMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use mysql_xdevapi\Collection;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'username' => 'required|string|regex:/\w*$/|max:255|unique:users,username',
            'email' =>'required|email|max:255|unique:users,email',
            'password' =>['required', 'confirmed', 'min:6', 'max:36'],

        ]);

//        regex:/(.*)@learn.vsb.bc\.ca/i

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        auth()->login($user);


        return redirect('/')->with('message', 'User created and logged in.');

    }
    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' =>'required|email|max:255',
            'password' =>['required']
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in.');
        }

        return back()->withErrors([
            'email' =>'Wrong email or password.'
        ])->onlyInput('email');


    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    public function dashboard()
    {

        if(!Auth::check()) return \redirect('/login');

        $user = auth()->user();
        $courses =  $user->course_members->pluck('course_id');
        $clubs = $user->club_members->pluck('club_id');

        $unread_data = $user->unreadNotifications->pluck('data');
        $unread_course_ids = [];
        foreach ($unread_data as $unread){
            $unread_course_ids[] = $unread['course_id'];
        }



        return view('dashboard',[
            'courses' => Course::findMany($courses),
            'clubs' => Club::findMany($clubs),
            'user' => User::find(\auth()->id()),
            'unread_course_ids' => $unread_course_ids
        ]);

    }

    public function markAllAsRead(){
        if (Auth::check()){
            foreach(auth()->user()->unreadNotifications as $notification){
                $notification->markAsRead();
            }
            return \redirect('/dashboard');
        }else{
            return "bruh";
        }
    }
}
