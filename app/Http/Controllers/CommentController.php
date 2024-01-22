<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\DetailComment;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = DetailComment::all();

        foreach ($comments as $comment) {
            $user = $comment->user;
            $thread = $comment->thread;
            $post = $comment->post;
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
        $comment->save();

        $dcomment = new DetailComment;
        $dcomment->comment_id = $comment->getKey();
        $dcomment->user_id = Auth::user()->id;

        $thread = Thread::find($threadId);

        if (!$thread) {
            return redirect()->back()->with('error', 'Thread tidak ditemukan');
        }

        $dcomment->thread_id = $thread->id;
        $dcomment->save();

        return redirect()->back()->with('status', 'Berhasil Menambah komentar pada Thread');
    }

    public function storePostComment(Request $request, $postId)
    {
        // Add validation as needed

        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->save();

        $dcomment = new DetailComment;
        $dcomment->comment_id = $comment->getKey();
        $dcomment->user_id = Auth::user()->id;

        $post = Post::find($postId);

        if (!$post) {
            return redirect()->back()->with('error', 'Post tidak ditemukan');
        }

        $dcomment->post_id = $post->id;
        $dcomment->save();

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
