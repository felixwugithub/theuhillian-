<?php

use App\Http\Controllers\ClubCoverImageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewReportController;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Review;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;


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

Auth::routes(['verify' => true]);


Route::get('/', function () {

    return view('home', [
        'courses' => Course::paginate(12),
        'paginatePage' => true,
        'no_results' => false
    ]);
});

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/read-notification/{id}', function($id){
    $userUnreadNotification = auth()->user()
        ->unreadNotifications
        ->where('id', $id)
        ->first();

    $userUnreadNotification->markAsRead();

    return back();
});

Route::get('/report-review/{id}', [ReviewReportController::class, 'create'])->middleware(['verified']);
Route::get('/review-report-store/{id}', [ReviewReportController::class, 'store'])->middleware(['verified']);
Route::get('/admin/view-review-reports', [ReviewReportController::class, 'view'])->middleware(['verified']);

Route::get('/admin/reject-review-report/{id}',[ReviewReportController::class, 'reject'])->middleware(['verified']);

Route::get('/admin/review-report-warn/{id}',[ReviewReportController::class, 'warn'])->middleware(['verified']);
Route::get('/admin/review-report-ban/{id}',[ReviewReportController::class, 'ban'])->middleware(['verified']);




Route::get('/magazine', [\App\Http\Controllers\ArticleController::class,'show'])->middleware(['verified']);;
Route::get('/magazine/article/{title}', [\App\Http\Controllers\ArticleController::class,'display'])->name('article');
Route::any('/upload/article',[\App\Http\Controllers\ArticleController::class, 'store'])->middleware(['verified'])->name('articlePDFUpload');
Route::get('/magazine/editor', [\App\Http\Controllers\ArticleController::class, 'create'])->middleware(['verified'])->name('articleEditor');
Route::get('/like-article/{id}', [\App\Http\Controllers\ArticleController::class, 'like'])->middleware(['verified'])->name('like-article');
Route::get('/article-comment/{id}', [\App\Http\Controllers\ArticleCommentController::class, 'store'])->middleware(['verified'])->name('article-comment');
Route::get('/article-comments/{id}', [\App\Http\Controllers\ArticleCommentController::class, 'fetch']);
Route::get('/like-article-comment/{id}', [\App\Http\Controllers\ArticleCommentController::class, 'like'])->middleware(['verified'])->name('like-article-comment');


Route::get('/clubs', [\App\Http\Controllers\ClubController::class, 'show'])->name('clubs')->middleware(['verified']);;
Route::post('/club-post-store/{club_id}' , [\App\Http\Controllers\ClubPostController::class, 'store'])->middleware(['verified'])->name('club-post-store');
Route::post('/club-cover-store/{club_id}', [ClubCoverImageController::class, 'store'])->middleware(['verified'])->name('club-cover-store');

Route::any('/filterclubs',[\App\Http\Controllers\ClubController::class, 'filter'])->name('filterClubs');

Route::any('/club/{club_name}', [\App\Http\Controllers\ClubController::class, 'getClubPosts'])->middleware(['verified'])->name('club');

Route::any('/joinclub/{id}', [\App\Http\Controllers\ClubMemberController::class, 'join'])->middleware(['verified'])->name('joinClub');
Route::any('/quitclub/{id}', [\App\Http\Controllers\ClubMemberController::class, 'quit'])->middleware(['verified'])->name('quitClub');

Route::any('/filter', [\App\Http\Controllers\CourseController::class, 'search'])->name('search');
Route::get('/courses/{sort_by}/{order}', [\App\Http\Controllers\CourseController::class, 'show'])->middleware(['verified']);;
Route::get('/teachers', function () {

    return view('teachers', [
        'teachers' => Teacher::all()
    ]);
})->middleware(['verified']);;

Route::get('/admin/teacher/create', [\App\Http\Controllers\TeacherController::class, 'create'])->middleware(['verified']);
Route::get('/admin/course/create', [\App\Http\Controllers\Course_Template_Controller::class, 'create'])->middleware(['verified']);
Route::get('/admin/club/create', [\App\Http\Controllers\ClubController::class, 'create'])->middleware(['verified']);



Route::post('/admin/teacher/store', [\App\Http\Controllers\TeacherController::class, 'store'])->middleware(['verified']);
Route::any('/teacher/{id}/assigncourse', [\App\Http\Controllers\TeacherController::class, 'assignCourse'])->middleware(['verified']);
Route::post('/teacher/{id}/store', [\App\Http\Controllers\TeacherController::class, 'storeCourse'])->middleware(['verified']);
Route::post('/admin/course-quick-add/{id}', [\App\Http\Controllers\CourseRequestController::class, 'quickAdd'])->middleware(['verified']);

Route::post('/admin/course/store', [\App\Http\Controllers\Course_Template_Controller::class, 'store'])->middleware(['verified']);
Route::post('/admin/club/store', [\App\Http\Controllers\ClubController::class, 'store'])->middleware(['verified']);
Route::get('/admin/course-requests', [\App\Http\Controllers\CourseRequestController::class,'display'])->middleware(['verified']);
Route::get('/admin/course-request-review/{id}', [\App\Http\Controllers\CourseRequestController::class,'review'])->middleware(['verified']);


Route::get('/teacher/{id}', function ($id){
    return view('teacher',[
        'teacher' => Teacher::find($id),
    ]);
})->middleware(['verified']);;

Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'show'])->middleware(['verified']);;
Route::get('/profile/{id}/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->middleware(['verified']);
Route::patch('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile')->middleware(['verified']);



Route::get('/course/{id}', [\App\Http\Controllers\CourseController::class, 'display'])->name('courseListing');
Route::get('/course-review/{id}/{review_id}', [\App\Http\Controllers\CourseController::class, 'scrollToReview'])->name('courseListingReview');
Route::get('/course-request', [\App\Http\Controllers\CourseRequestController::class, 'create'])->middleware(['verified']);
Route::post('/course-request-store', [\App\Http\Controllers\CourseRequestController::class, 'store'])->middleware(['verified']);

Route::get('/club-request', [\App\Http\Controllers\ClubRequestController::class, 'create'])->middleware(['verified']);
Route::post('/club-request-store', [\App\Http\Controllers\ClubRequestController::class, 'store'])->middleware(['verified']);


Route::get('/course-review-read/{id}/{review_id}/{notification_id}', [\App\Http\Controllers\CourseController::class, 'reviewRead'])->middleware(['verified'])->name('reviewRead');
Route::get('/markallasread', [UserController::class, 'markAllAsRead'])->middleware(['verified']);

Route::any('/reviewEdit/{review_id}', [ReviewController::class, 'update'])->middleware(['verified'])->name('reviewUpdate');
Route::any('/reviewDelete/{review_id}', [ReviewController::class, 'destroy'])->middleware(['verified'])->name('reviewDelete');

Route::any('/course/{id}/courseComment', [\App\Http\Controllers\CommentController::class, 'store'])->middleware(['verified'])->name('courseComment');
Route::any('courseCommentLike/{id}/{commentIndex}', [\App\Http\Controllers\CommentLikeController::class, 'store'])->middleware(['verified'])->name('courseCommentLike');
Route::any('courseCommentUnlike/{id}/{commentIndex}', [\App\Http\Controllers\CommentLikeController::class, 'destroy'])->middleware(['verified'])->name('courseCommentUnlike');


Route::get('/register', [UserController::class, 'create']);

Route::get('/login', [UserController::class,'login']);

Route::post('/users', [UserController::class, 'store']);

Route::any('/logout', [UserController::class, 'logout']);

Route::get('/about-info-protection', function (){
    return view('privacy');
});

Route::get('/review-guidelines', function (){
    return view('review-guide');
});



Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/course/{id}/review', [ReviewController::class, 'create'])->middleware(['verified']);

Route::post('/course/{id}', [ReviewController::class, 'store'])->middleware(['verified']);

Route::post('/course/reviewHelpful/{review}/{reviewIndex}', [\App\Http\Controllers\ReviewHelpfulController::class, 'store'])->middleware(['verified'])->name('reviewHelpful');
Route::delete('/course/reviewHelpfulDestroy/{review}/{reviewIndex}', [\App\Http\Controllers\ReviewHelpfulController::class, 'destroy'])->middleware(['verified'])->name('reviewHelpfulDestroy');

Route::any('/course/{id}/join', [\App\Http\Controllers\CourseMemberController::class, 'join'])->middleware(['verified'])->name('joinCourse');
Route::any('/course/{id}/quit', [\App\Http\Controllers\CourseMemberController::class, 'quit'])->middleware(['verified'])->name('quitCourse');


Route::any('/dashboard', [UserController::class, 'dashboard'])->middleware(['verified'])->name('dashboard');



Route::post('/attachments', function () {
    request()->validate([
        'attachment' => ['required', 'file'],
    ]);

    $name = time().'_'. request()->file('attachment')->getClientOriginalName().request()->file('attachment')->getExtension();
    request()->file('attachment')->storeAs('public/articleRichTextAttachments', $name);

    return [
        'image_url' => '/storage/articleRichTextAttachments/'.$name
    ];
})->middleware(['verified'])->name('attachments.store');


Route::get('/club-manager/{id}', [\App\Http\Controllers\ClubController::class, 'manager'])->middleware(['verified'])->name('club-manager');
Route::get('/club-info-update/{id}', [\App\Http\Controllers\ClubController::class, 'update'])->middleware(['verified'])->name('club-info-update');
Route::get('/club-magazine-manager/{id}', [\App\Http\Controllers\ArticleController::class, 'magazine_manager'])->middleware(['verified'])->name('club-magazine-manager');
Route::get('/club-magazine-editor/{id}', [\App\Http\Controllers\ArticleController::class, 'editor'])->middleware(['verified'])->name('club-magazine-editor');
Route::get('/club-magazine-editor/{id}/{article_id}', [\App\Http\Controllers\ArticleController::class, 'edit'])->middleware(['verified'])->name('club-magazine-edit');
Route::post('/club-magazine-store/{id}', [\App\Http\Controllers\ArticleController::class, 'store'])->middleware(['verified'])->name('club-magazine-store');
Route::post('/club-magazine-update/{article_id}', [\App\Http\Controllers\ArticleController::class, 'update'])->middleware(['verified'])->name('club-magazine-update');
Route::get('/club-magazine-publish/{article_id}', [\App\Http\Controllers\ArticleController::class, 'publish'])->middleware(['verified'])->name('club-magazine-publish');
Route::get('/club-articles-fetch/{id}', [\App\Http\Controllers\ArticleController::class, 'fetch']);

Route::get('/club-events-fetch/{id}', [\App\Http\Controllers\ClubEventController::class, 'fetch']);
Route::post('/club-event-store/{club_id}', [\App\Http\Controllers\ClubEventController::class, 'store'])->middleware(['verified'])->name('club-event-store');
Auth::routes();
