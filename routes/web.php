<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserDashboardController;
use App\Models\Post;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('welcome');
});

Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
Route::get('/table', [DashboardController::class, 'index'])->middleware(['auth'])->name('table');

/*
    INSERT DATA
*/
//THREAD
Route::get('/thread/add', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/thread/add', [ThreadController::class, 'store']);
//COMMENT
Route::get('thread/comment/add/{id}', [CommentController::class, 'addThreadComment'])->name('comments.create');
Route::get('post/comment/add/{id}', [CommentController::class, 'addPostComment'])->name('commennts.create_post');
Route::post('thread/comment/add/{id}', [CommentController::class, 'storeThreadComment']);
Route::post('post/comment/add/{id}', [CommentController::class, 'storePostComment']);
//POST
Route::get('/post/add', [PostController::class, 'create'])->name('posts.create');
Route::post('/post/add', [PostController::class, 'store']);
Route::get('/post/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::get('/post/restore/{id}', [PostController::class, 'restore']);
Route::get('/post/forcedelete/{id}', [PostController::class, 'deletePermanent']);


/*
EDIT & UPDATE DATA
*/
Route::get('/thread/edit/{id}', [ThreadController::class, 'edit'])->name('threads.edit');
Route::put('/thread/update/{id}', [ThreadController::class, 'update']);
Route::get('/comment/edit/{id}', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comment/update/{id}', [CommentController::class, 'update']);
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('/post/update/{id}', [PostController::class, 'update']);

/*
DELETE DATA
*/
Route::delete('/thread/delete/{id}', [ThreadController::class, 'destroy']);
Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy']);
Route::delete('/post/delete/{id}', [PostController::class, 'destroy']);



Route::get('/dashboard/profile', function() {
    return view('users.dashboard');
})->middleware('auth')->name('users.dashboard');

require __DIR__.'/auth.php';

/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
Route::get('/logout', [SocialiteController::class, 'logout']);

//POST
Route::get('/post/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('posts.show', compact('post'));
})->name('posts.show');
