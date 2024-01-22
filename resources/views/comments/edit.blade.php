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
                    <h4>Edit & Update Komentar
                        <a href="{{ url('dashboard') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('comment/update/'.$comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">Komentar</label>
                            <input type="text" name="comment" value="{{$comment->comment}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update komentar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection