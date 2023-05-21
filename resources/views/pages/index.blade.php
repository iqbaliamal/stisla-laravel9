@extends('layouts.master')

@section('title', 'Admin - Dashboard')
@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Default Layout</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Layout</a></div>
          <div class="breadcrumb-item">Default Layout</div>
        </div>
      </div>

      <div class="section-body">
        <div class="col-12 mb-4">
          <div class="hero hero-bg-image hero-bg-parallax text-white"
            style="background-image: url('assets/img/unsplash/andre-benz-1214056-unsplash.jpg');">
            <div class="hero-inner">
              <h2>Welcome, {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}!</h2>
              <p class="lead">Selamat datang di halaman admin.</p>
              <div class="mt-4">
                <a class="btn btn-outline-white btn-lg btn-icon icon-left" href="#">
                  <i class="far fa-newspaper"></i>
                  Buat Artikel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
