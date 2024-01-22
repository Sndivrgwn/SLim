<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
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
        $threads = Thread::all();

        foreach ($threads as $thread) {
            $creator = $thread->creator; // Ini seharusnya bekerja dengan baik
        } // Ini juga seharusnya bekerja dengan baik

        return $threads;
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {
        $thread = new Thread;
        $thread->judul = $request->input('judul');
        $thread->content = $request->input('content');
        $thread->creator_user_id = Auth::user()->id;
        $thread->save();

        return redirect()->back()->with('status', 'berhasil menambah thread');
    }

    public function edit($id)
    {   
        $thread = Thread::find($id);
        return view('threads.edit', compact('thread'));
    }

    public function update(Request $request, $id)
    {
        $thread = Thread::find($id);
        $thread->judul = $request->input('judul');
        $thread->content = $request->input('content');
        $thread->update();

        return redirect()->back()->with('status', 'berhasil mengubah thread');
    }

    public function destroy($id)
    {
        $thread = Thread::find($id);
        $thread->delete();
    
        if (!$thread) {
            return redirect()->back()->with('error', 'Thread not found');
        }
    
        return redirect()->back()->with('status', 'Berhasil menghapus thread');
    }
    
}
