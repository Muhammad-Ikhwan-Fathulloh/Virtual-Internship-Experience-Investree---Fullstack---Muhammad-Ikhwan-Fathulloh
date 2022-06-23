@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col">
              <div class="card-body">
                <h5 class="card-title text-primary">Hello, {{Auth::user()->name}}! 🎉</h5>
                <p class="mb-4">
                  Let's Management your galeri origami philosophy
                </p>

              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="../assets/img/illustrations/man-with-laptop-light.png"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  @endsection
