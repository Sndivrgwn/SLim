<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserDashboardController extends Controller
{
    public function index(PostController $postController)
    {
        $post = $postController->getLastPost();

        return view('dashboard', compact('post'));
    }
}
