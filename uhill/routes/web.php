<?php

use App\Http\Controllers\ReviewController;
use App\Models\Course;
use App\Models\Review;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
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
        'courses' => Course::paginate(12),
        'paginatePage' => true,
        'no_results' => false
    ]);
});

Route::get('/magazine', [\App\Http\Controllers\ArticleController::class,'show']);
Route::get('/magazine/article/{title}', [\App\Http\Controllers\ArticleController::class,'display'])->name('article');
Route::any('/upload/article',[\App\Http\Controllers\ArticleController::class, 'store']);

Route::get('/clubs', [\App\Http\Controllers\ClubController::class, 'show'])->name('clubs');
Route::any('/club/{club_name}', [\App\Http\Controllers\ClubController::class, 'display'])->name('club');
Route::any('/joinclub/{id}', [\App\Http\Controllers\ClubMemberController::class, 'join'])->name('joinClub');
Route::any('/quitclub/{id}', [\App\Http\Controllers\ClubMemberController::class, 'quit'])->name('quitClub');

Route::any('/filter', [\App\Http\Controllers\CourseController::class, 'search'])->name('search');
Route::get('/courses/{sort_by}/{order}', [\App\Http\Controllers\CourseController::class, 'show']);
Route::get('/teachers', function () {
    return view('teachers', [
        'teachers' => Teacher::all()
    ]);
});

Route::get('/admin/teacher/create', [\App\Http\Controllers\TeacherController::class, 'create']);
Route::get('/admin/course/create', [\App\Http\Controllers\Course_Template_Controller::class, 'create']);


Route::post('/admin/teacher/store', [\App\Http\Controllers\TeacherController::class, 'store']);
Route::any('/teacher/{id}/assigncourse', [\App\Http\Controllers\TeacherController::class, 'assignCourse']);
Route::post('/teacher/{id}/store', [\App\Http\Controllers\TeacherController::class, 'storeCourse']);


Route::post('/admin/course/store', [\App\Http\Controllers\Course_Template_Controller::class, 'store']);


Route::get('/teacher/{id}', function ($id){
    return view('teacher',[
        'teacher' => Teacher::find($id),
    ]);
});

Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'show']);
Route::get('/profile/{id}/edit', [\App\Http\Controllers\ProfileController::class, 'edit']);
Route::patch('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile');

Route::get('/course/{id}', function ($id){

    if(\Illuminate\Support\Facades\Auth::check()){
    return view('course', [
        'course' => Course::find($id),
    ]);}
    else{
        return view('unauthorized',[
            'authMessage' => 'Course reviews and comments are only accessible by authorized users.'
        ]);
    }
})->name('courseListing');

Route::any('/reviewEdit/{review_id}', [ReviewController::class, 'update'])->name('reviewUpdate');
Route::any('/reviewDelete/{review_id}', [ReviewController::class, 'destroy'])->name('reviewDelete');

Route::any('/course/{id}/courseComment', [\App\Http\Controllers\CommentController::class, 'store'])->name('courseComment');
Route::any('courseCommentLike/{id}/{commentIndex}', [\App\Http\Controllers\CommentLikeController::class, 'store'])->name('courseCommentLike');
Route::any('courseCommentUnlike/{id}/{commentIndex}', [\App\Http\Controllers\CommentLikeController::class, 'destroy'])->name('courseCommentUnlike');


Route::get('/register', [UserController::class, 'create']);

Route::get('/login', [UserController::class,'login']);

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/course/{id}/review', [ReviewController::class, 'create']);

Route::post('/course/{id}', [ReviewController::class, 'store']);

Route::post('/course/reviewHelpful/{review}/{reviewIndex}', [\App\Http\Controllers\ReviewHelpfulController::class, 'store'])->name('reviewHelpful');
Route::delete('/course/reviewHelpful/{review}/{reviewIndex}', [\App\Http\Controllers\ReviewHelpfulController::class, 'destroy'])->name('reviewHelpful');

Route::any('/course/{id}/join', [\App\Http\Controllers\CourseMemberController::class, 'join'])->name('joinCourse');
Route::any('/course/{id}/quit', [\App\Http\Controllers\CourseMemberController::class, 'quit'])->name('quitCourse');


Route::any('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');



