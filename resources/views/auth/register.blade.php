@extends('layouts.app')

@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">

      <div class="col-md-10 mx-auto col-lg-5">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{session('success')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{session('loginError')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form class="p-4 p-md-5 border rounded-3"  novalidate method="POST" action="{{ route('register') }}">
          @csrf
          {{-- <div class="text-center">
            <strong><img src="https://investree.id/v3/1655374405983/img/inv_logo.55026ac7.png" alt=""></strong>
          </div> --}}
          <div class="form-floating mb-3">
            <label for="floatingInput">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Nama" autofocus value="{{old('name')}}" required>

            @error('email')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>
          {{-- <div class="form-floating mb-3">
            <label for="floatingInput">Username</label>
            <input type="text" class="form-control  @error('username') is-invalid @enderror " name="username" id="username" placeholder="Masukkan Username" value="{{old('username')}}" required>

            @error('username')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div> --}}
          <div class="form-floating mb-3">
            <label for="floatingInput">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email" value="{{old('email')}}" required>

            @error('email')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <label for="floatingInput">Password</label>
            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" value="{{old('password')}}" required>

            @error('password')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <label for="floatingInput">Konfirmasi Password</label>
            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password_confirmation" placeholder="Masukkan Password" value="{{old('password')}}" required>

            @error('password')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>

          <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
          <hr class="my-4">
          <small> Sudah Punya Akun ? <a href="/login">Masuk</a></small>
        </form>
      </div>
      <div class="col-lg-7 text-center text-lg-start">
        <a href="/"><img src="https://investree.id/v3/1655374405983/img/inv_logo.55026ac7.png" class="pt-7 pt-md-0 img-fluid" alt=""></a>
      </div>
    </div>
  </div>
@endsection
