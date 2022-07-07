<?php

use App\Http\Controllers\ReviewController;
use App\Models\Course;
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
        'courses' => Course::all()
    ]);
});

Route::get('/course/{id}', function ($id){
    return view('course', [
        'course' => Course::find($id)
    ]);
});

Route::get('/register', [UserController::class, 'create']);

Route::get('/login', [UserController::class,'login']);

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/course/{id}/review', [ReviewController::class, 'create']);

Route::post('/course/{id}', [ReviewController::class, 'store']);
