<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public function scrollToReview($id, $review_id){
        if(\Illuminate\Support\Facades\Auth::check()){
            return Redirect::route('courseListing', $id)->with([
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
