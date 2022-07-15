<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id){

        $user = User::find($id);
        $profile = $user->profile;

        return view('users.profile', [
            'id' => $id,
            'name' => $user['name'],
            'username' => $user['username'],
            'date_joined' => $user['created_at'],
            'description' => $profile['description'],
            'url' => $profile['url']

            ]);
    }

   public function edit($id){
        $user = User::find($id);
        return view('users.editProfile', [
            'user' => $user,
            'id' => $user
            ]);
   }

    public function update($id){
        $user = User::find($id);
        return view('users.editProfile', [
            'user' => $user,
            'id' => $user
        ]);
    }
}
