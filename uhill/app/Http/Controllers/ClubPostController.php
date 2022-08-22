<?php

namespace App\Http\Controllers;
use App\Models\ClubPost;
use App\Models\ClubPostPicture;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Illuminate\Http\Request;

class ClubPostController extends Controller
{
    public function store(Request $request, $club_id){

        if(Auth::check()){
        $data = $this->validate($request, [
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'required'
        ]);

        $club_post = ClubPost::create([
            'caption' => $data['caption'],
            'club_id' => $club_id,
            'user_id' => Auth::id()
        ]);

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image) {
                $newImageName = uniqid().'-'.time(). '.' .$image->extension();
                $image->storeAs('public/clubPostImages', $newImageName);

               $cpi =  ClubPostPicture::create([
                    'image' => $newImageName,
                    'club_post_id' => $club_post->id
                ]);
            }

            if($club_post->save()&& $cpi->save()){
                return back();
            }else{
                return "posting failed.";
            }
        }

        if($club_post->save()){
            return back();
        }else{
            return "posting failed.";
        }

    }
    }
}
