<div class="modal fade" id="EditArticle" aria-labelledby="EditArticleLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditArticleLabel">Edit Artikel</h5>
        <button class="close" data-dismiss="modal" type="button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="form-editArticle" method="POST">
          <input id="editId" name="editId" type="hidden">
          <div class="form-group">
            <label for="edit-title">Title</label>
            <small class="text-danger">*</small>
            <input class="form-control" id="edit-title" name="edit-title" type="text"
              placeholder="Isi judul artikel disini..." required>
          </div>
          <div class="form-group">
            <label for="edit-content">Content</label>
            <small class="text-danger">*</small>
            <textarea class="form-control" id="edit-content" name="edit-content" type="text" placeholder="Isi konten disini..."
              required></textarea>
          </div>
          <div class="form-group mb-2">
            <label for="edit-image">Image</label>
            <input id="path" name="path" type="hidden">
            <input class="filepond" id="edit-image" name="media" type="file" />
          </div>
          <div class="form-group">
            <button class="btn btn-primary" id="submit-editArticle" type="button">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
