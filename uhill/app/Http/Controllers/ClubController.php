<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('clubs', [
            'clubs' => Club::all()
        ]);
    }

    public function filter(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $search = $request['search'];
        $clubs = Club::query()->where('name', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%')->get();
        return view('clubs', [
            'clubs' => $clubs,
            'clubSearch' => $search
        ]);
    }


    public function display($club_name): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $club = Club::query()->where('name', str_replace('_', ' ', $club_name))->first();

        return view('club',[
            'club' => $club
        ]);
    }

    public function create(){
        if(auth()->user()->admin == 1){
        return view('admin.addClub');
    }else{
            return "fuck off";
        }
}

    public function store(Request $request){
        if(auth()->user()->admin == 1) {
            $formfields = $request->validate([
                'name' => 'required',
                'description' => 'nullable'
            ]);
            $club = Club::create($formfields);
            $club->save();
            return redirect('/clubs');
        }
        else{
            return "lol git gud";
        }
    }
}
