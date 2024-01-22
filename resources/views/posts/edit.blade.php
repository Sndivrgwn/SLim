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

                    <form action="{{ url('post/update/'.$posts->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">judul</label>
                            <input type="text" name="judul" value="{{$posts->judul}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">content</label>
                            <input type="text" name="content" value="{{$posts->content}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Gambar</label>
                            <input type="file" name="image" value="{{$posts->image}}" class="form-control">
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