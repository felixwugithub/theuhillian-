<?php

namespace App\Http\Controllers;

use App\Models\Review;
use http\Env\Response;
use Illuminate\Http\Request;

class ReviewHelpfulController extends Controller
{

    public function _construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Review $review, Request $request){
        if($review->reviewHelpfuledBy($request->user())){
            return \response(null, 409);
        }

        $review->reviewHelpfuls()->create(
            [
                'user_id' => $request->user()->id,
            ]
        );

        return back();
    }

    public function destroy(Review $review, Request $request){

        $request->user()->reviewHelpfuls()->where('review_id', $review->id)->delete();

        return back();

    }
}
