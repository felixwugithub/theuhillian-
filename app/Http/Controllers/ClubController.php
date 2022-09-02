<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubPost;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('clubs', [
            'clubs' => Club::paginate(9),
            'paginatePage' => true
        ]);
    }

    public function filter(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $search = $request['search'];
        $clubs = Club::query()->where('name', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%')->paginate(9);
        return view('clubs', [
            'clubs' => $clubs,
            'clubSearch' => $search,
            'paginatePage' => true
        ]);
    }


    public function display($club_name): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $club = Club::query()->where('name', str_replace('_', ' ', $club_name))->first();
        $club_posts = ClubPost::query()->where('club_id', $club->id)->orderByDesc('created_at')->paginate(1, ['*'], 'posts');

        return view('club',[
            'club' => $club,
            'club_posts' => $club_posts
        ]);
    }

    public function getClubPosts($club_name, Request $request){

        $club = Club::query()->where('name', str_replace('_', ' ', $club_name))->first();
        $club_slug = str_replace('_', ' ', $club_name);
        $results = ClubPost::query()->where('club_id', $club->id)->orderByDesc('created_at')->paginate(1, ['*'], 'posts');
        $club_posts = '';
        if ($request->ajax()) {
            foreach ($results as $post) {

                $club_posts.= view('club-components.post', compact('post'))->render();
            }
            return $club_posts;
        }
        return view('club',[
            'club' => $club,
            'club_slug' => $club_slug
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
