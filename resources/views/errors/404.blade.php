<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>404 &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link href="{{ asset('dist/assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/assets/css/components.css') }}" rel="stylesheet">

  <!-- Style 404 -->
  <style>
    .heading {
      text-align: center;
      font-size: 9em;
      line-height: 1.3em;
      margin: 2rem 0 0.5rem 0;
      padding: 0;
      color: #0069ff;
      text-shadow: 0 0 1rem rgb(170, 170, 170);
      font-size: 7em;
      line-height: 1.15 margin: 0;
    }

    .page-description {
      color: #ffffff;
    }
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container">
        <div class="page-error">
          <div class="page-inner">
            <h1 class="heading">404</h1>
            <div class="page-description">
              Maaf halaman yang Anda tuju tidak ditemukan, <br>
              Silahkan klik tombol dibawah untuk kembali ke halaman utama
            </div>
            <div class="page-search">
              <form>
                <div class="form-group floating-addon floating-addon-not-append">
                </div>
              </form>
              <div class="mt-3">
                <a href="/">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('dist/assets/js/stisla.js') }}"></script>
  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset('dist/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('dist/assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
</body>

</html>
