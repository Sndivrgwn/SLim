<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ThreadController $threadController, CommentController $commentController, PostController $postController, UserController $userController)
    {
        $threads = $threadController->index();
        $comments = $commentController->index();
        $post = $postController->index();
        $user = $userController->index();


        return view('table', compact('threads', 'comments', 'post', 'user'));
    }
}
