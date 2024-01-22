<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(ThreadController $threadController, CommentController $commentController, KomenController $komenController, PostController $postController)
    {
        $threads = $threadController->index();
        $comments = $commentController->index();
        $komen = $komenController->index();
        $post = $postController->index();

        return view('table', compact('threads', 'comments', 'komen', 'post'));
    }
}
