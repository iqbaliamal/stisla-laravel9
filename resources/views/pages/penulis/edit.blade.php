<div class="modal fade" id="EditUser" aria-labelledby="EditUserLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditUserLabel">Edit User</h5>
        <button class="close" data-dismiss="modal" type="button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-edituser" method="POST">
          <input id="editId" name="editId" type="hidden">
          <div class="form-group">
            <label for="edit-first_name">First Name</label>
            <small class="text-danger">*</small>
            <input class="form-control" id="edit-first_name" name="edit-first_name" type="text"
              placeholder="contoh: Iqbal" required>
          </div>
          <div class="form-group">
            <label for="edit-last_name">Last Name</label>
            <small class="text-danger">*</small>
            <input class="form-control" id="edit-last_name" name="edit-last_name" type="text"
              placeholder="contoh: Iqbal" required>
          </div>
          <div class="form-group mb-2">
            <label for="edit-email">Email</label>
            <small class="text-danger">* (default password : <b>password</b>)</small>
            <input class="form-control" id="edit-email" name="edit-email" type="edit-email"
              placeholder="contoh: iqbal@gmail.com" required>
          </div>
          <div class="form-group mb-2">
            <label for="edit-avatar">Avatar</label>
            <input id="edit-path" name="edit-path" type="hidden">
            <input class="filepond" id="edit-avatar-pond" name="media" type="file" />
          </div>
          <div class="form-group">
            <button class="btn btn-primary" id="submit-edituser" type="button">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
