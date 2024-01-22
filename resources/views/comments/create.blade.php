@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Komentar</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('thread/comment/add/' . $thread->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Komentar</label>
                                <input type="textarea" name="comment" class="form-control bg-dark text-light ps-3">
                            </div>


                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>
                    <div class="card-header">
                        <a href="{{ route('dashboard') }}" class="btn btn-info">Kembali ke dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
