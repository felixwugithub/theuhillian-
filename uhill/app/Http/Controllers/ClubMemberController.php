<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubMemberController extends Controller
{
    public function join($id){

        $club = Club::find($id);

        if(Auth::check() && !$club->clubJoined(Auth::user())){
            $club->club_members()->create([
                'club_id' => $club->id,
                'user_id' => Auth::id()
            ]);
            return back();
        }else{
            return "You're already in this club";
        }

    }

    public function quit($id){
        $club = Club::find($id);
        if(Auth::check() && $club->clubJoined(Auth::user())){
            $club->club_members()->where('user_id', Auth::id())->delete();
            return back();
        }else{
            return "You're not in this club to begin with bruh...";
        }
    }
}
