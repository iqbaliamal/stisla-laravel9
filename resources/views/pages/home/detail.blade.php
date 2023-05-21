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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

      <section class="section">

        <div class="section-body">
          <div class="card">
            <div class="card-body">
              <section>
                <div class="col-12">
                  <article class="article article-style-c">
                    <div class="article-header" style="height: 400px;">
                      <div class="article-image" data-background="{{ $article->image }}"
                        style="background-image: url(&quot;{{ $article->image }}&quot;);">
                      </div>
                    </div>
                    <div class="article-details">
                      <div class="article-category">
                        <a href="#">{{ $article->created_at->diffForHumans() }}</a>
                      </div>
                      <h2>{{ $article->title }}</h2>
                      <p>{{ $article->content }}</p>
                      <div class="article-user">
                        <img src="{{ asset('assets/img/avatar/avatar-2.png') }}" alt="image">
                        <div class="article-user-details">
                          <div class="user-detail-name">
                            <a href="#">{{ $article->user->first_name . ' ' . $article->user->last_name }}</a>
                          </div>
                          <div class="text-job">{{ $article->user->role }}</div>
                        </div>
                      </div>
                    </div>
                  </article>
                </div>
              </section>
              <hr class="my-5">
              <h3>Komentar</h3>

              {{-- comment box --}}
              <div class="card">
                <form action="{{ route('comment.store', $article->id) }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input class="form-control" id="name" name="name" type="text"
                      placeholder="Masukkan nama">
                  </div>
                  <div class="form-group">
                    <label for="comment">Komentar</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Masukkan komentar"></textarea>
                  </div>

                  <div class="d-flex justify-content-center">
                    <button class="btn btn-primary w-100 text-center" type="submit">Kirim</button>
                  </div>

                </form>
              </div>

              @foreach ($comments as $item)
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <img class="img img-rounded" src="https://image.ibb.co/jw55Ex/def_face.jpg" height="100" />
                      </div>
                      <div class="col-md-10">
                        <p class="mb-0">
                          <strong>{{ $item->name }}</strong>
                        </p>
                        <p class="text-secondary">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                        <div class="clearfix"></div>
                        <p>{{ $item->comment }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
          </div>
        </div>
      </section>
    </div>

    <footer class="text-muted border-top mt-4 pt-3">
      © 2021
    </footer>
    </div>
  </main>

</body>

<script>
  @if ('success' == session('status'))
    Swal.fire(
      'Berhasil!',
      'Komentar berhasil ditambahkan.',
      'success'
    )
  @endif
</script>

</html>
