<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubEvent;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClubEventController extends Controller
{

    public function store($club_id, Request $request){


        $club = Club::find($club_id);


        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_time' => 'required|date_format:"Y-m-d\TH:i"|after:1 hours',
            'end_time' => 'nullable|date_format:"Y-m-d\TH:i"|after:5 hours',
            'url' => 'nullable'
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->with([
                'openEvents' => true,
                'scrollDown' => true
            ]);
        }else{
            $club->events()->create($validator->valid(),[
                'club_id' => $club_id
            ]);

            return Redirect::back()->with([
                'openEvents' => true,
                'scrollDown' => true
            ]);
        }



    }

    public function fetch($id, Request $request){
        $club = Club::find($id);
        $results = ClubEvent::query()->where('club_id', $club->id)->orderByDesc('start_time')->paginate(1, ['*'], 'events');
        $club_events = '';

        if ($request->ajax()) {
            foreach ($results as $result) {

                $club_events.='<div class="mx-auto my-5 p-5 w-11/12 bg-blue-50 h-96"><p class="h-5 text-3x;">'.$result->title.'</p></div>';
            }
            return $club_events;
        }

    }
}
