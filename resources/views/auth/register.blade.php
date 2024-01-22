@extends('layouts.header')
@section('content')
    

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url({{ asset('front/assets/img/illustrations/illustration-signup.jpg') }}); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Register</h4>
                  <p class="mb-0">Masukan Username email dan password</p>
                </div>
                <div class="card-body">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                  <form role="form" method="POST" action="{{ route('register') }}">
                  @csrf
                    <div class="input-group input-group-outline mb-3">
                      <x-label class="form-label" for="name" :value="__('name')">Nama</x-label>
                      <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <x-label class="form-label" for="name" :value="__('email')">Email</x-label>
                      <x-input id="name" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <x-label for="password" :value="__('Password')" class="form-label" />

                        <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <x-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />

                      <x-input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" required />
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        Saya Mengerti <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan ketentuan</a>
                      </label>
                    </div>
                    <div class="text-center">
                       <x-button class="btn bg-gradient-primary w-100 my-4 mb-2">
                            {{ __('Register') }}
                        </x-button>
                        <div class="flex">
                          <a href="/auth/google" class="btn btn-blue bg-gray-400">register google</a>
                          <a href="/auth/github" class="btn btn-blue bg-gray-800">register github</a>
                        </div>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Login</a>
                  </p>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  
@endsection