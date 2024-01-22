@extends('layouts.header')

@section('content')
 <div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Edit & Update Thread
                        <a href="{{ url('dashboard') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('thread/update/'.$thread->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">thread judul</label>
                            <input type="text" name="judul" value="{{$thread->judul}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">thread content</label>
                            <input type="text" name="content" value="{{$thread->content}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update thread</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection