@extends('layouts.header')
@section('content')

    <div class="d-flex w-100" style="height: 100vh;">
		<div class="bg-secondary w-25 p-3" style="overflow-y: scroll; overflow-x: hidden;">
			<div class="d-flex">
				<img src="img/s.jpg" alt="ProfilePhoto" width="45px" height="45px" class="rounded rounded-5 rounded-cirle">
				<div class="text-light ms-2 d-flex align-items-baseline flex-column">
					<h6 class="m-0">{{ $post->user->name }}</h6>
					<p class="m-0" style="font-size: 13px;">12 hour</p>
				</div>
				<div class="ms-auto text-light me-3 ">
					<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle bg-light text-dark pe-2 ps-1 pt-0 pb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				     
				  </button>
				  <ul class="dropdown-menu">
                  {{-- @foreach($ as $id)
                        
				    <li><a class="dropdown-item" href="#">{{ $id }}</a></li>
                  @endforeach --}}
				    <li><a class="dropdown-item" href="#">Another action</a></li>
				    <li><a class="dropdown-item" href="#">Something else here</a></li>
				  </ul>
				</div>
				</div>
				<ul class="dropdown-menu">
			    <li><a class="dropdown-item" href="#">Action</a></li>
			    <li><a class="dropdown-item" href="#">Another action</a></li>
			    <li><a class="dropdown-item" href="#">Something else here</a></li>
			  </ul>
			</div>
			<div class="mt-3 ms-1 text-light p-1 me-2" style="text-align: justify;">
				<p>
                {{ Str::limit($post->content, 400, '') }}
                @if((strlen($post->content) > 400))
                    <span id="dots">...</span>
                    <span id="more">{{ substr($post->content, 400) }}</span>    
                <button onclick="readMore()" id="readMoreBtn" class="border border-0 bg-info opacity-25 text-light rounded rounded-2 ps-2 pe-2 mb-3">Read more</button>
                @endif
                </p>
			</div>
			<hr class="border border-1 opacity-75 m-0">
			<div class="text-light d-flex justify-content-center mt-2 mb-0">
				<button class="bg-transparent border border-0 d-flex text-light">
				<i class="fa-solid fa-comment mt-1 me-2"></i>
				<a href="{{ url('/post/comment/add/' . $post->id) }}">tambahkan komentar</a>
				</button>
			</div>
			<hr class="text-light border border-1 opacity-75 m-0">
            @foreach ($comments as $compost)    
			<div class="d-flex gap-2 mt-3">
				<img src="{{ Storage::url('public/posts/').$post->image }}" alt="ProfilePhoto" width="40px" height="40px" class="rounded rounded-5 rounded-cirle mt-1">
				<div class="bg-light rounded rounded-3 mt-1 p-2" style="max-width: 286px">
					<h6>{{ $compost->user->name }}</h6>
					<p>{{ $compost->comment }}</p>
				</div>
			</div>
            @endforeach
		</div>
		<div class="bg-dark w-75 position-relative">
			<div class="">
				<img src="{{ Storage::url('public/posts/').$post->image }}" class="position-absolute top-50 start-50 translate-middle" style="max-height: 800px; max-width: 800px; height: auto; width: auto;">
					<a href="{{ url('/dashboard') }}"><button class="bg-transparent border border-0 position-absolute end-0 m-3"><i class="fa-solid fa-x text-light fs-5"></i></button></a>
			</div>
		</div>
	</div>

@endsection