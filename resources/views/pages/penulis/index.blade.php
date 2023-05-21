@extends('layouts.master')

@section('title', $title)

@section('content')
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">User</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">User</h2>
        <p class="section-lead">This page is just an example for you to create your own page.</p>
        <div class="card">
          <div class="card-header">
            <button class="btn btn-primary" onclick="createUser()"><i class="fa fa-plus"></i> Tambah</button>
          </div>
          <div class="card-body">
            <div class="table-responsive" id="table">
              <table class="table-striped table" id="tbl-user">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $item)
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
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="deleteUserModal" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true"
    tabindex="-1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h4 class="mt-4">Anda yakin akan menghapus data pengguna ini?</h4>
          <input id="deleteId" type="hidden">
          <div class="d-flex justify-content-center mt-4">
            <button class="btn btn-sm btn-danger deleteUserConfirmBtn" type="button">Hapus</button>
            <button class="btn btn-sm btn-secondary ms-2" data-bs-dismiss="modal" type="button">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('pages.user.create')
  @include('pages.user.edit')
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
    function createUser() {
      $('#AddUser').modal('show');
    }
    $('#submit-adduser').click(function(e) {
      e.preventDefault();
      loadBtn($(this));

      let form = $('#form-adduser');
      let formData = new FormData(form[0]);

      $.ajax({
        url: "{{ route('admin.users.store') }}",
        type: "POST",
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        processData: false,
        contentType: false,
        success: function(data) {
          $('#AddUser').modal('hide');

          $('#submit-adduser').html(
              `Simpan`
            )
            .removeClass('disabled');

          $('#form-adduser')[0].reset();
          $('#table').load(location.href + ' #tbl-user', function() {
            dataTableInit('#tbl-user');
          });

          let filepond = FilePond.find(document.getElementById('avatar-pond'));
          filepond.removeFile();

          toastSuccess(data.message);


        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $("#submit-adduser").html('Simpan').removeClass('disabled');
        }
      });
    });

    function editUser(id) {
      $.ajax({
        url: `{{ route('admin.users.edit', ':id') }}`.replace(':id', id),
        type: 'GET',
        success: (response) => {
          let data = response.data
          if (response) {
            $('#edit-first_name').val(data.first_name)
            $('#edit-last_name').val(data.first_name)
            $('#edit-email').val(data.email)
            // filepond edit
            let filepond = FilePond.find(document.getElementById('edit-avatar-pond'));
            filepond.addFile(data.avatar);
            $('#editId').val(data.id)
          }
        },
        error: (error) => {
          $('#editUserModal').modal('dispose')
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
        }
      })
      $('#EditUser').modal('show');
    }

    $('#submit-edituser').click(function(e) {
      e.preventDefault();
      loadBtn($(this));

      let first_name = $('#edit-first_name').val()
      let last_name = $('#edit-last_name').val()
      let email = $('#edit-email').val()
      let path = $('#edit-path').val()

      $.ajax({
        url: "{{ route('admin.users.update', ':id') }}".replace(':id', $('#editId').val()),
        type: "PUT",
        data: {
          first_name: first_name,
          last_name: last_name,
          email: email,
          path: path,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
          $('#EditUser').modal('hide');

          $('#submit-edituser').html(
              `Simpan`
            )
            .removeClass('disabled');

          $('#form-edituser')[0].reset();
          $('#table').load(location.href + ' #tbl-user', function() {
            dataTableInit('#tbl-user');
          });

          let filepond = FilePond.find(document.getElementById('edit-avatar-pond'));
          filepond.removeFile();

          toastSuccess(data.message);
        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $("#submit-edituser").html('Simpan').removeClass('disabled');
        }
      });
    });

    function deleteUser(id) {
      $('#deleteId').val(id);
      $('#deleteUserModal').modal('show');
    }

    $('.deleteUserConfirmBtn').on('click', function(e) {
      loadBtn($(this));
      const id = $('#deleteId').val();
      $.ajax({
        type: "DELETE",
        url: `{{ route('admin.users.destroy', ':id') }}`.replace(':id', id),
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
          if (response) {
            toastSuccess(response.message);
            $('#deleteUserModal').modal('hide');
            $('#deleteId').val('');
            $('.deleteUserConfirmBtn').html(
                `<i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete`
              )
              .removeClass('disabled');

            $('#table').load(location.href + ' #tbl-user', function() {
              dataTableInit('#tbl-user');
            });
          }
        },
        error: function(error) {
          if (error.responseJSON.message) {
            toastWarning(error.responseJSON.message);
          } else {
            toastError(error.message);
          }
          $('.deleteUserConfirmBtn').html(
              `<i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete`
            )
            .removeClass('disabled');
        }
      });
    });
  </script>

  <script>
    $('#tbl-user').DataTable();
    filepond('avatar-pond');
    filepondEdit('edit-avatar-pond');
  </script>
@endsection
