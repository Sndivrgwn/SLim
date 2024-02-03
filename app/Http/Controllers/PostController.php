<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view posts', ['only' => ['dashboard']]);
        $this->middleware('permission:create posts', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit posts', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete posts', ['only' => ['destroy']]);
    }

    public function index()
    {
        $post = Post::latest()->paginate(10);
        
        return $post;
    }

    public function getLastPost()
    {
        $post = Post::latest()->paginate(3);

        return $post;
    }

    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('posts.create');
    }


    /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        
        $post = new Post;
        $post->image = $image->hashName();
        $post->judul = $request->input('judul');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $post->slug = Str::slug($request->input('judul'));
        $post->save();

        return redirect()->back()->with('status', 'berhasil menambah thread');
    }

    public function edit($id)
    {
        $posts = Post::find($id);
        return view('posts.edit', compact('posts'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if($request->file('image') == "") {
    
            $post->judul = $request->input('judul');
            $post->content = $request->input('content');
            $post->update();
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/posts/'.$post->image);
    
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());
    
            $post->judul = $request->input('judul');
            $post->content = $request->input('content');
            $post->image = $image->hashName();
            $post->update();
        }

        return redirect()->back()->with('status', 'berhasil mengubah thread');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        return redirect()->back()->with('status', 'Berhasil menghapus thread');
    }

    public function trash()
    {
        $post = Post::onlyTrashed()->get();

        return view('posts.sampah', compact('post'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id);
        $post->restore();

        return redirect('/table');
    }

    public function deletePermanent($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
    
        if ($post) {
            Storage::disk('local')->delete('public/posts/'.$post->image);
            $post->forceDelete();
        }
    
        return redirect('/table');
    }
    
}
