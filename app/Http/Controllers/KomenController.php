<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class KomenController extends Controller
{
    public function index()
    {
        $komen = Comment::all();

        foreach ($komen as $kom)
        {
            $comment = $kom->comment;
        }

        return $komen;
    }
}
