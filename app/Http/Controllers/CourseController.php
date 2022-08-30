<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use App\Models\Review;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CourseController extends Controller
{

    public function show($sort_by, $order){

        if($order == 'asc'){
            $results = Course::all()->sortBy($sort_by);
        }elseif ($order == 'desc'){
            $results = Course::all()->sortByDesc($sort_by);
        }

        return view('home', [
            'courses' => $results,
            'sort_by' => $sort_by,
            'order' => $order
        ]);
    }

    public function display($id, Request $request){

        $comments = Comment::query()->where('course_id', $id)->orderByDesc('created_at') ->paginate(5, ['*'], 'comments');
        $body = '';
        if ($request->ajax()) {
            foreach ($comments as $comment) {
                $body.='<div id="'.'comment'.$comment->id.'"><div class="bg-white justify-center flex m-4 p-10 rounded-3xl container relative text-left justify-between items-center"><a href="/profile/'.$comment->user->id.'" class="text-hotPink">'.$comment->user->username.':</a><div class="container w-2/3 ml-2"><p class="text-notRealBlack font-slim text-lg text-center">'.$comment->content.'</p></div>
                <p class="text-sm text-gray-500 font-ooga absolute bottom-1 left-4 md:relative">'.$comment->created_at.'</p></div></div>';

            }
            return $body;
        }
        return view('course',[
            'course' =>  Course::find($id),
            'reviews' => Review::query()->where('course_id', $id)->orderBy('created_at')->paginate(10, ['*'], 'reviews')
        ]);

    }

    public function scrollToReview($id, $review_id){
        if(\Illuminate\Support\Facades\Auth::check()){


            $review = Review::find($review_id);
            $pageReviews = Review::query()->where('course_id', $id)->orderBy('created_at')->get()->toArray();
            $pos = 0;

            foreach($pageReviews as $reviewCompare){

                if ($reviewCompare['id'] === $review->id){
                    break;
                }
                $pos = $pos+1;
            }
            $pageNum = floor($pos/10)+1;

            return \redirect('/course/'.$id.'?reviews='.$pageNum)->with([
                'reviewIndex' => 'review'.$review_id,
                'simple' => true
            ]);
        }
        else{
            return view('unauthorized',[
                'authMessage' => 'Course reviews and comments are only accessible by authorized users.'
            ]);
        }

    }

    public function reviewRead($id, $review_id, $notification_id){

        if(Auth::check())                           {
        $userUnreadNotification = auth()->user()
            ->unreadNotifications
            ->where('id', $notification_id)
            ->first();

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
        }

            $review = Review::find($review_id);
            $pageReviews = Review::query()->where('course_id', $id)->orderBy('created_at')->get()->toArray();
            $pos = 0;

            foreach($pageReviews as $reviewCompare){
                if ($reviewCompare['id'] === $review->id){
                    break;
                }
                $pos = $pos+1;
            }
            $pageNum = floor($pos/10)+1;


        return \redirect('/course/'.$id.'?reviews='.$pageNum)->with([
            'reviewIndex' => 'review'.$review_id,
            'simple' => true
        ]);


        }        else{
            return view('unauthorized',[
                'authMessage' => 'Course reviews and comments are only accessible by authorized users.'
            ])    ;
        }

    }

    public function search(Request $request){

        $no_results = false;

        session([
            'search' => $request['search']
        ]);

        $search = $request['search'];
        $grade = $request['grade'];
        $order = $request['order'];
        $sort_by = $request['sort_by'];
        $subject = $request['subject'];

        if($grade != 13){
        $courses = Course::query()
            ->where('course_name', 'LIKE', "%".$search."%")
            ->where('grade', $grade)
        ->get();}else{
            $courses = Course::query()->where('course_name', 'LIKE', '%'.$search.'%')
            ->get();
        }

        if($subject != "all"){
            $courses = $courses->where('subject', $subject);
        }

        if (!$courses->isEmpty()) {
            if ($order == 'asc') {
                $courses = $courses->toQuery()->orderBy($sort_by)->paginate(12);
            } else {
                $courses = $courses->toQuery()->orderByDesc($sort_by)->paginate(12);
            }


            $courses->appends([
                'search' => $search,
                'grade' => $grade,
                'sort_by' => $sort_by,
                'order' => $order,
                'subject' => $subject
            ]);

        }else{
            $courses = Course::query()->paginate(12);
            $no_results = true;
        }

                return view('home', [
                    'courses' => $courses,
                    'grade' => $grade,
                    'sort_by' => $sort_by,
                    'order' => $order,
                    'paginatePage' => true,
                    'no_results' => $no_results,
                    'subject' => $subject
                ]);
            }




}
