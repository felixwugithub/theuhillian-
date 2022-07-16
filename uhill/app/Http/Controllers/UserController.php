<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'username' => 'required|string|regex:/\w*$/|max:255|unique:users,username',
            'email' =>'required|email|max:255|regex:/(.*)@learn.vsb.bc\.ca/i|unique:users',
            'password' =>['required', 'confirmed', 'min:6'],
//            'admin' => 'required'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
//
//        if($formFields['admin'] == true){
//            $formFields['admin'] = 1;
//        }else{
//            $formFields['admin'] = 0;
//        }



        $user = User::create($formFields);
        auth()->login($user);

        auth()->user()->profile()->create([
            'name' => $user['name'],
            'description' => 'Bio is Empty',
            'url' => 'www.example.com',
            'grade' => 0
        ]);

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
}
