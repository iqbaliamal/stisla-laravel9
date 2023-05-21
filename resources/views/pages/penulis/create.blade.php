<div class="modal fade" id="AddUser" aria-labelledby="AddUserLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddUserLabel">Tambah User</h5>
        <button class="close" data-dismiss="modal" type="button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="form-adduser" method="POST">
          <div class="form-group">
            <label for="first_name">First Name</label>
            <small class="text-danger">*</small>
            <input class="form-control" id="first_name" name="first_name" type="text" placeholder="contoh: Iqbal"
              required>
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <small class="text-danger">*</small>
            <input class="form-control" id="last_name" name="last_name" type="text" placeholder="contoh: Iqbal"
              required>
          </div>
          <div class="form-group mb-2">
            <label for="email">Email</label>
            <small class="text-danger">* (default password : <b>password</b>)</small>
            <input class="form-control" id="email" name="email" type="email"
              placeholder="contoh: iqbal@gmail.com" required>
          </div>
          <div class="form-group mb-2">
            <label for="avatar">Avatar</label>
            <input id="path" name="path" type="hidden">
            <input class="filepond" id="avatar-pond" name="media" type="file" />
          </div>
          <div class="form-group">
            <button class="btn btn-primary" id="submit-adduser" type="button">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
