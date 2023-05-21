@extends('layouts.master')

@section('title', $title)

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Article</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Artikel</h2>
        <p class="section-lead">Beirkut adalah daftar artikel anda</p>
        <div class="card">
          <div class="card-header">
            <button class="btn btn-primary" onclick="createArticle()"><i class="fa fa-plus"></i> Tambah</button>
          </div>
          <div class="card-body">
            <div class="table-responsive" id="table">
              <table class="table-striped table" id="tbl-article">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Judul Artikel</th>
                    <th>Isi Artikel</th>
                    <th>Penulis</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($articles as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->content }}</td>
                      <td>{{ $item->user->first_name }}</td>
                      <td>
                        <button class="btn btn-warning" onclick="editArticle('{{ $item->id }}')"><i
                            class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteArticle('{{ $item->id }}')"><i
                            class="fa fa-trash"></i></button>
                        <a class="btn btn-info" href="{{ route('admin.articles.show', $item->id) }}"><i
                            class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="deleteArticleModal" role="dialog" aria-labelledby="deleteArticleModalLabel"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h4 class="mt-4">Anda yakin akan menghapus Artikel ini?</h4>
          <input id="deleteId" type="hidden">
          <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-sm btn-danger deleteArticleConfirmBtn" type="button">Hapus</button>
            <button class="btn btn-sm btn-secondary ms-2" data-bs-dismiss="modal" type="button">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('pages.article.create')
  @include('pages.article.edit')
@endsection

@section('css_lib')
  <link href="{{ asset('assets/modules/datatables/datatables.min.css') }}" rel="stylesheet">
  <!-- include FilePond library -->
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
  <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css"
    rel="stylesheet" />
@endsection

@section('js_lib')
  <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
  <!-- include FilePond library -->
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
  </script>
  <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

  <script src="{{ asset('js/filepond.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>

@endsection

@section('custom_js')
  <script>
    function createArticle() {
      $('#AddArticle').modal('show');
    }
    $('#submit-addArticle').click(function(e) {
      e.preventDefault();
      loadBtn($(this));

      let form = $('#form-addArticle');
      let formData = new FormData(form[0]);

      $.ajax({
        url: "{{ route('admin.articles.store') }}",
        type: "POST",
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        contentType: false,
        success: function(data) {
          $('#AddArticle').modal('hide');

          $('#submit-addArticle').html(
              `Simpan`
            )
            .removeClass('disabled');

          $('#form-addArticle')[0].reset();
          $('#table').load(location.href + ' #tbl-article', function() {
            dataTableInit('#tbl-article');
          });

          let filepond = FilePond.find(document.getElementById('image'));
          filepond.removeFile();

          toastSuccess(data.message);


        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $("#submit-addArticle").html('Simpan').removeClass('disabled');
        }
      });
    });

    function editArticle(id) {
      $.ajax({
        url: `{{ route('admin.articles.edit', ':id') }}`.replace(':id', id),
        type: 'GET',
        success: (response) => {
          let data = response.data
          if (response) {
            $('#edit-title').val(data.title)
            $('#edit-content').val(data.content)
            let filepond = FilePond.find(document.getElementById('edit-image'));
            filepond.addFile(data.image);
            $('#editId').val(data.id)
          }
        },
        error: (error) => {
          $('#editArticleModal').modal('dispose')
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
        }
      })
      $('#EditArticle').modal('show');
    }

    $('#submit-editArticle').click(function(e) {
      e.preventDefault();
      loadBtn($(this));

      let title = $('#edit-title').val()
      let content = $('#edit-content').val()
      let path = $('#edit-path').val()

      $.ajax({
        url: "{{ route('admin.articles.update', ':id') }}".replace(':id', $('#editId').val()),
        type: "PUT",
        data: {
          title: title,
          content: content,
          path: path,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          $('#EditArticle').modal('hide');

          $('#submit-editArticle').html(
              `Simpan`
            )
            .removeClass('disabled');

          $('#form-editArticle')[0].reset();
          $('#table').load(location.href + ' #tbl-article', function() {
            dataTableInit('#tbl-article');
          });

          let filepond = FilePond.find(document.getElementById('edit-image'));
          filepond.removeFile();

          toastSuccess(data.message);
        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $("#submit-editArticle").html('Simpan').removeClass('disabled');
        }
      });
    });

    function deleteArticle(id) {
      $('#deleteId').val(id);
      $('#deleteArticleModal').modal('show');
    }

    $('.deleteArticleConfirmBtn').on('click', function(e) {
      loadBtn($(this));
      const id = $('#deleteId').val();
      $.ajax({
        type: "DELETE",
        url: `{{ route('admin.articles.destroy', ':id') }}`.replace(':id', id),
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
          if (response) {
            toastSuccess(response.message);
            $('#deleteArticleModal').modal('hide');
            $('#deleteId').val('');
            $('.deleteArticleConfirmBtn').html(
                `<i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete`
              )
              .removeClass('disabled');

            $('#table').load(location.href + ' #tbl-article', function() {
              dataTableInit('#tbl-article');
            });
          }
        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $('.deleteArticleConfirmBtn').html(
              `<i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete`
            )
            .removeClass('disabled');
        }
      });
    });
  </script>

  <script>
    $('#tbl-article').DataTable();
    filepond('image');
    filepondEdit('edit-image');
  </script>
@endsection
