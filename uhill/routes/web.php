<?php

use App\Http\Controllers\ReviewController;
use App\Models\Course;
use App\Models\Review;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'courses' => Course::all(),
        'sort_by' => 'id',
        'order' => 0
    ]);
});

Route::post('/courses/', [\App\Http\Controllers\CourseController::class, 'sortBy']);

Route::get('/courses/{sort_by}/{order}', [\App\Http\Controllers\CourseController::class, 'show']);

Route::get('/teachers', function () {
    return view('teachers', [
        'teachers' => Teacher::all()
    ]);
});


Route::get('/teacher/{id}', function ($id){
    return view('teacher',[
        'teacher' => Teacher::find($id),
        'courses' => Course::find($id)->where('teacher_id', $id)->get()
    ]);

});

Route::get('/course/{id}', function ($id){
    return view('course', [
        'course' => Course::find($id),
        'reviews' => Review::find($id)
    ]);
});



Route::get('/register', [UserController::class, 'create']);

Route::get('/login', [UserController::class,'login']);

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/course/{id}/review', [ReviewController::class, 'create']);

Route::post('/course/{id}', [ReviewController::class, 'store']);

Route::get('/teacher/create', [\App\Http\Controllers\TeacherController::class, 'create']);

Route::post('/teacher/store', [\App\Http\Controllers\TeacherController::class, 'store']);
