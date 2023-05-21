<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Uji Kompetensi - Iqbal Ikhlasul Amal</title>

  <link href="https://getbootstrap.com/docs/5.0/examples/jumbotron/" rel="canonical">

  <link href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}" rel="stylesheet">
  <!-- Template CSS -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

</head>

<body>

  <main>
    <div class="container py-4">
      <header class="border-bottom mb-4 pb-3">
        <a class="d-flex align-items-center text-dark text-decoration-none" href="/">
          <img
            data-src="https://polije.ac.id/wp-content/uploads/elementor/thumbs/LOGO-POLITEKNIK-NEGERI-JEMBER-200x200-p501e8qsx93hro564g7wmlj5f1d6bn1idluqt46f2o.png"
            src="https://polije.ac.id/wp-content/uploads/elementor/thumbs/LOGO-POLITEKNIK-NEGERI-JEMBER-200x200-p501e8qsx93hro564g7wmlj5f1d6bn1idluqt46f2o.png"
            alt="logo gabung putih" height="50">
          <img class="ml-3" src="https://lsp.polije.ac.id/frontend/img/LOGO LSP POLIJE.png" alt=""
            height="50">
        </a>
      </header>

      <div class="bg-light rounded-3 mb-4 p-5">
        <div class="container-fluid py-2">
          <h1 class="display-5 fw-bold">Berita Polije</h1>
        </div>
      </div>

      <div class="row align-items-md-stretch">
        @foreach ($articles as $item)
          <div class="col-12 col-md-4 col-lg-4">
            <article class="article article-style-c">
              <div class="article-header">
                <div class="article-image" data-background="{{ $item->image }}"
                  style="background-image: url(&quot;{{ $item->image }}&quot;);">
                </div>
              </div>
              <div class="article-details">
                <div class="article-category">
                  <a href="#">{{ $item->created_at->diffForHumans() }}</a>
                </div>
                <div class="article-title">
                  <h2><a href="{{ route('artikel.detail', $item->id) }}">{{ $item->title }}</a></h2>
                </div>
                <p>{{ Str::limit($item->content, 100) }}</p>
                <div class="article-user">
                  <img src="{{ $item->user->avatar ?? asset('assets/img/avatar/avatar-2.png') }}" alt="image">
                  <div class="article-user-details">
                    <div class="user-detail-name">
                      <a href="#">{{ $item->user->first_name . ' ' . $item->user->last_name }}</a>
                    </div>
                    <div class="text-job">{{ $item->user->role }}</div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>

      <footer class="text-muted border-top mt-4 pt-3">
        © 2021
      </footer>
    </div>
  </main>

</body>

</html>
