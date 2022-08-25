<?php

namespace App\Http\Controllers;

use App\Models\Review;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReviewHelpfulController extends Controller
{

    public function _construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Review $review, Request $request, string $reviewIndex){
        if($review->reviewHelpfuledBy($request->user())){
            return \response(null, 409);
        }

        $review->reviewHelpfuls()->create(
            [
                'user_id' => $request->user()->id,
            ]
        );

        return \redirect('/course-review/'.$review->course->id.'/'.$review->id)->with([
            'reviewIndex' => $reviewIndex
        ]);
    }

    public function destroy(Review $review, Request $request, string $reviewIndex){

        $request->user()->reviewHelpfuls()->where('review_id', $review->id)->delete();

        return \redirect('/course-review/'.$review->course->id.'/'.$review->id)->with([
            'reviewIndex' => $reviewIndex
        ]);

    }
}
