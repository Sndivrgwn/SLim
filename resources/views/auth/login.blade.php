@extends('layouts.header')
@section('content')
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Login</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center px-1 ms-auto">
                      <a class="btn btn-link px-3" href="auth/github">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="auth/google">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('login') }}" role="form" class="text-start">
                @csrf
                  <div class="input-group input-group-outline my-3">
                    <x-label for="email" :value="__('Email')" class="form-label" />
                    <x-input type="email" class="form-control" id="email" name="email" :value="old('email')" required autofocus/>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <x-label class="form-label" for="password" :value="__('Password')" />
                    <x-input class="form-control" id="password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="remember_me" checked>
                    <label class="form-check-label mb-0 ms-3" for="remember_me">
                        <span class="mt-1 color-dark">{{ __('Ingat saya') }}</span>
                    </label>
                  </div>
                  <div class="text-center">
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                        @endif
                    <x-button class="btn bg-gradient-primary w-100 my-4 mb-2">
                    {{ __('Log in') }}
                    </x-button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Tidak punya akun?
                    <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Register</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
@endsection