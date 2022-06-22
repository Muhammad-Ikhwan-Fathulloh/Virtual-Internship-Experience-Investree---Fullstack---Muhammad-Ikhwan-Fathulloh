@extends('layouts.app')

@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <a href="/"><img src="https://investree.id/v3/1655374405983/img/inv_logo.55026ac7.png" class="pt-7 pt-md-0 img-fluid" alt=""></a>
          </div>
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

        <form class="p-4 p-md-5 border rounded-3" novalidate method="POST" action="{{ route('login') }}">
          @csrf
          {{-- <div class="text-center">
            <strong><img src="https://investree.id/v3/1655374405983/img/inv_logo.55026ac7.png" width="300" alt=""></strong>
          </div> --}}

          <div class="form-floating mb-3">
            <label for="floatingInput">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email" autofocus value="{{old('email')}}" required>

            @error('email')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <label for="floatingPassword">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" required>

            @error('password')
            <div class="invalid-feedback" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
          <hr class="my-4">
          <small class="text-muted">Klik Login untuk masuk ke halaman.</small> <br>
          <small> Belum Daftar ? <a href="/register">Daftar</a></small>
        </form>
      </div>
    </div>
  </div>
@endsection
