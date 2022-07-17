<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
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

    public function search(Request $request){

        session([
            'search' => $request['search']
        ]);

        $courses = Course::all();

        if($request->has('search')) {
            $search = $request['search'];
            $courses = Course::query()->where('course_name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->get();
        }

        if($request->has('order') && $request->has('sort_by')) {
            if ($request['order'] == 'asc') {
                $courses = $courses->sortBy($request['sort_by']);
            } elseif ($request['order'] == 'desc') {
                $courses = $courses->sortByDesc($request['sort_by']);
            }

        }


        if($request->has('sort_by') && $request['sort_by'] == 'review_count'){
            if ($request['order'] == 'asc') {
                $courses = $courses->sortBy($request['sort_by']);

            } elseif ($request['order'] == 'desc') {
                $courses = $courses->sortByDesc($request['sort_by']);
            }
        }




        return view('home', [
            'filtered' => true,
            'courses' => $courses,
            'sort_by' => $request['sort_by'],
            'order' => $request['order']
        ]);

    }
}
