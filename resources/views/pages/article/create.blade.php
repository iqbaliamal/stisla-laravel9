<div class="modal fade" id="AddArticle" aria-labelledby="AddArticleLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddArticleLabel">Tambah Article</h5>
        <button class="close" data-dismiss="modal" type="button" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="form-addArticle" method="POST">
          <div class="form-group">
            <label for="title">Title</label>
            <small class="text-danger">*</small>
            <input class="form-control" id="title" name="title" type="text"
              placeholder="Isi judul artikel disini..." required>
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <small class="text-danger">*</small>
            <textarea class="form-control" id="content" name="content" type="text" placeholder="Isi konten disini..." required></textarea>
          </div>
          <div class="form-group mb-2">
            <label for="image">Image</label>
            <input id="path" name="path" type="hidden">
            <input class="filepond" id="image" name="media" type="file" />
          </div>
          <div class="form-group">
            <button class="btn btn-primary" id="submit-addArticle" type="button">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
