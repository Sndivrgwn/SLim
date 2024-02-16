<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(ThreadController $threadController, CommentController $commentController, PostController $postController)
    {
        $threads = $threadController->index();
        $comments = $commentController->index();
        $post = $postController->index();

        return view('table', compact('threads', 'comments', 'post'));
    }
}
