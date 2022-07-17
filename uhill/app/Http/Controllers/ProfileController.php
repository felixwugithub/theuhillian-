<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id){

        $user = User::find($id);
        $profile = $user->profile;

        return view('users.profile', [
            'id' => $id,
            'name' => $profile['name'],
            'username' => $user['username'],
            'date_joined' => $user['created_at'],
            'description' => $profile['description'],
            'url' => $profile['url'],
            'grade' => $profile['grade']
            ]);
    }

   public function edit($id){
        $user = User::find($id);
        $profile = $user->profile;
        return view('users.editProfile',
        [
            'id' => $id,
            'name' => $profile['name'],
            'username' => $user['username'],
            'date_joined' => $user['created_at'],
            'description' => $profile['description'],
            'url' => $profile['url'],
            'grade' => $profile['grade']
        ]);
   }

    public function update(){
        $data = \request()->validate(
            [
                'name' => ['nullable', 'min:3'],
                'grade' => 'required|integer|between:8,12',
                'description' => ['required', 'min:3'],
                'url' => 'url'
            ]
        );
        Auth::user()->profile->update($data);
        return redirect()->route('profile', ['id' => Auth::id()]);
    }
}
