<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function sortBy(Request $request){
        return view('home', [
            'courses' => Course::all(),
            'sort_by' => $request['sort_by'],
            'order' => $request['order']
        ]);
    }

    public function show($sort_by, $order){
        return view('home', [
            'courses' => Course::all(),
            'sort_by' => $sort_by,
            'order' => $order
        ]);
    }
}
