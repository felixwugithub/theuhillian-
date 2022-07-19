<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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

        $paginatePage = true;

        session([
            'search' => $request['search']
        ]);


        if($request->has('search')) {
            $search = $request['search'];
            $paginated_courses = Course::query()->where('course_name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")->paginate(12);
        }

        if($request->has('order') && $request->has('sort_by')) {
            if ($request['order'] == 'asc') {
                $courses = $paginated_courses->sortBy($request['sort_by']);
            } elseif ($request['order'] == 'desc') {
                $courses = $paginated_courses->sortByDesc($request['sort_by']);
            }
        }

        if($request->has('sort_by') && $request['sort_by'] == 'review_count'){
            if ($request['order'] == 'asc') {
                $courses = $courses->sortBy($request['sort_by']);

            } elseif ($request['order'] == 'desc') {
                $courses = $courses->sortByDesc($request['sort_by']);
            }
        }

        $courses = new LengthAwarePaginator($courses, $paginated_courses->total(), $paginated_courses->perPage());


        return view('home', [
            'filtered' => true,
            'courses' => $courses,
            'sort_by' => $request['sort_by'],
            'order' => $request['order'],
            'paginatePage' => $paginatePage
        ]);

    }
}
