<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with([
            'user' => function ($query) {
                $query->select('id', 'Name', 'image'); 
            },
            'post' => function ($query) {
                $query->select('id', 'Judul'); 
            },
            'thread' => function ($query) {
                $query->select('id', 'Judul'); 
            },
        ])->get();
    
        foreach ($comments as $comment) {
            $user = $comment->user;
            $post = $comment->post;
            $thread = $comment->thread;
        }
    
        return $comments;
    }
    

    public function addThreadComment($threadId)
    {
        $thread = Thread::find($threadId);
    
        if (!$thread) {
            return redirect()->back()->with('error', 'Thread tidak ditemukan');
        }
    
        return view('comments.create', compact('thread'));
    }
    
    public function addPostComment($postId)
    {
        $post = Post::find($postId);
    
        if (!$post) {
            return redirect()->back()->with('error', 'Post tidak ditemukan');
        }
    
        return view('comments.create_post', compact('post'));
    }
    
    
    public function storeThreadComment(Request $request, $threadId)
    {
        // Add validation as needed

        $comment = new Comment;
        $comment->comment = $request->input('comment');
        
        $comment->comment_id = $comment->getKey();
        $comment->user_id = Auth::user()->id;
        $comment->save();

        $thread = Thread::find($threadId);

        if (!$thread) {
            return redirect()->back()->with('error', 'Thread tidak ditemukan');
        }

        $comment->thread_id = $thread->id;
        $comment->save();

        return redirect()->back()->with('status', 'Berhasil Menambah komentar pada Thread');
    }

    public function storePostComment(Request $request, $postId)
    {
        // Add validation as needed

        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->user_id = Auth::user()->id;
        $comment->save();

        $post = Post::find($postId);

        if (!$post) {
            return redirect()->back()->with('error', 'Post tidak ditemukan');
        }

        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->back()->with('status', 'Berhasil Menambah komentar pada Post');
    }

    
    
    


    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment = $request->input('comment');
        $comment->update();

        return redirect()->back()->with('status', 'berhasil merubah komentar');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('status', 'Berhasil menghapus komentar');
    }
}
