<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubCoverImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubCoverImageController extends Controller
{
    public function store(Request $request, $club_id)
    {


        if (Auth::check()) {
            $club = Club::find($club_id);
            $data = $this->validate($request, [
                'cover_image' => 'required',
                'cover_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);



            $existingimages = ClubCoverImage::where('club_id', $club->id)->get();
            if ($existingimages->count() > 0){
                foreach ($existingimages as $existingimage) {
                    unlink(storage_path('app/public/clubCoverImages/'. $existingimage->image));
                    $existingimage->delete();
                }
            }

            $image = $request->file('cover_image');
            $newImageName = uniqid() . '-' . time() . '.' . $image->extension();
            $image->storeAs('public/clubCoverImages', $newImageName);

            $cci = $club->club_cover_image()->create([
                'image' => $newImageName,
                'club_id' => $club_id
            ]);

            if ($cci->save()){
                return back();
            }else{
                return "failed";
            }

        }else{
            return "nice try";
        }
    }
}
