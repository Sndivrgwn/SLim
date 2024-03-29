<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(ThreadController $threadController, CommentController $commentController, PostController $postController, UserController $userController)
    {
        $threads = $threadController->index();
        $comments = $commentController->index();
        $post = $postController->index();
        $pengguna = $userController->index();


        return view('table', compact('threads', 'comments', 'post', 'pengguna'));
    }
}
