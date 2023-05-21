@extends('layouts.master')

{{-- @section('title', $title) --}}

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.articles.index') }}">Artikel</a></div>
          <div class="breadcrumb-item">Detail</div>
        </div>
      </div>

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
                    <div class="article-title">
                      <h2><a href="#">{{ $article->title }}</a></h2>
                    </div>
                    <p>{{ $article->content }}</p>
                    <div class="article-user">
                      <img src="{{ $article->user->avatar ?? asset('assets/img/avatar/avatar-2.png') }}" alt="image">
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
                  @foreach ($comments as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->comment }}</td>
                      </td>
                      <td>
                        <button class="btn btn-danger" onclick="deleteComment('{{ $item->id }}')"><i
                            class="fa fa-trash"></i></button>
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

  <div class="modal fade" id="deleteCommentModal" role="dialog" aria-labelledby="deleteCommentModalLabel"
    aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h4 class="mt-4">Anda yakin akan menghapus Komentar ini?</h4>
          <input id="deleteId" type="hidden">
          <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-sm btn-danger deleteCommentConfirmBtn" type="button">Hapus</button>
            <button class="btn btn-sm btn-secondary ml-2" data-dismiss="modal" type="button">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom_js')
  <script src="{{ asset('js/script.js') }}"></script>

  <script>
    function deleteComment(id) {
      $('#deleteId').val(id);
      $('#deleteCommentModal').modal('show');
    }

    $('.deleteCommentConfirmBtn').on('click', function(e) {
      loadBtn($(this));
      const id = $('#deleteId').val();
      $.ajax({
        type: "DELETE",
        url: `{{ route('admin.comments.destroy', ':id') }}`.replace(':id', id),
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
          if (response) {
            toastSuccess(response.message);
            $('#deleteArticleModal').modal('hide');
            $('#deleteId').val('');
            $('.deleteCommentConfirmBtn').html(
                `<i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete`
              )
              .removeClass('disabled');

            setTimeout(() => {
              window.location.reload();
            }, 1000);
          }
        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $('.deleteCommentConfirmBtn').html(
              `<i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete`
            )
            .removeClass('disabled');
        }
      });
    });
  </script>
@endsection
