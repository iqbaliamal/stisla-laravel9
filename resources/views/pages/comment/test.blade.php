@extends('layouts.master')

{{-- @section('title', $title) --}}

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Detail</div>
        </div>
      </div>

      <div class="section-body">
        <div class="card">
          <div class="card-body">
            <section>
              <div class="col-12">
                <article class="article article-style-c">
                  <div class="article-header">
                    <div class="article-image" data-background="{{ asset('assets/img/news/img01.jpg') }}"
                      style="background-image: url(&quot;{{ asset('assets/img/news/img01.jpg') }}&quot;);">
                    </div>
                  </div>
                  <div class="article-details">
                    <div class="article-category">
                      <a href="#">5 Days</a>
                    </div>
                    <div class="article-title">
                      <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                    </div>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. </p>
                    <div class="article-user">
                      <img src="{{ asset('assets/img/avatar/avatar-2.png') }}" alt="image">
                      <div class="article-user-details">
                        <div class="user-detail-name">
                          <a href="#">Irwansyah Saputra</a>
                        </div>
                        <div class="text-job">Penulis</div>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </section>
            <hr class="my-5">
            <h3>Komentar</h3>
            <div class="table-responsive" id="table">
              <table class="table-striped table" id="tbl-user">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Isi Komentar</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>alksdj</td>
                    <td>alksdj</td>
                    <td>alksdj</td>
                    <td>alksdj</td>
                  </tr>
                  {{-- @foreach ($users as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->first_name }}</td>
                      <td>{{ $item->last_name }}</td>
                      <td>{{ $item->email }}</td>
                      <td><img src="{{ $item->avatar }}" alt="{{ $item->first_name }}" width="50px">
                      </td>
                      <td>
                        <button class="btn btn-warning" onclick="editUser('{{ $item->id }}')"><i
                            class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteUser('{{ $item->id }}')"><i
                            class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  @endforeach --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
