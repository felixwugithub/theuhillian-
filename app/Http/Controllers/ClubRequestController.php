<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubRequestController extends Controller
{
    public function create(){
        if (Auth::check()){
            if(Auth::user()->club_requests()->today()->count() < 1){
                return view('club-request');
            }else{
                return "You can only request 1 club per day. We have like 1 guy reviewing club requests, he needs some rest :(((";
            }
        }else{
            return redirect('/login');
        }
    }

    public function store(Request $request){
        if(Auth::check()){
            if(Auth::user()->club_requests()->today()->count() < 1){
                $data = $request->validate([
                    'name' => 'string|min:2|max:64|required',
                    'president' => 'string|min:2|max:64|required',
                    'vice_president' => 'string|nullable|max:64|min:2',
                    'room_number' => 'string|required|max:50|min:2',
                    'description' => 'string|min:10|max:512|required',
                    'meeting_times' => 'string|required|min:2|max:50'
                ]);

                $course_request = Auth::user()->club_requests()->create($data, [
                    'user_id' => Auth::id()
                ]);

                return redirect('/clubs')->with([
                    'request_success' => true
                ]);

            }else{
                return "You can only request 1 course per day. We have like 1 guy reviewing course requests, he needs some rest :(((";
            }

        }else{
            return redirect('/login');
        }
    }
}
