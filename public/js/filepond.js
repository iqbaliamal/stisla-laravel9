const filepond = (id) => {
  FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

  const selectorID = document.querySelector(`#${id}`);
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  const Pond = FilePond.create(selectorID, {
    acceptedFileTypes: 'image/*',
    allowImagePreview: true,
    imagePreviewHeight: 300,
    acceptedFileTypes: ['image/*'],
    server: {
      process: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': csrf,
        },
      },
      revert: {
        url: '/admin/revert',
        headers: {
          'X-CSRF-TOKEN': csrf,
        },
      },
    },
  });

  Pond.on('processfile', (error, file) => {
    if (error) {
      console.log('Oh no');
      return;
    }

    const data = JSON.parse(file.serverId);
    document.getElementById('path').value = data.path;
  });

  Pond.on('removefile', (error, file) => {
    if (error) {
      console.log('Oh no');
      return;
    }

    const data = JSON.parse(file.serverId);
    console.log(data);
    document.getElementById('path').value = '';
  });
};

const filepondEdit = (id) => {
  FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

  const selectorID = document.querySelector(`#${id}`);
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  const Pond = FilePond.create(selectorID, {
    acceptedFileTypes: 'image/*',
    allowImagePreview: true,
    imagePreviewHeight: 300,
    acceptedFileTypes: ['image/*'],
    server: {
      process: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': csrf,
        },
      },
      revert: {
        url: '/admin/revert',
        headers: {
          'X-CSRF-TOKEN': csrf,
        },
      },
    },
  });

  Pond.on('processfile', (error, file) => {
    if (error) {
      console.log('Oh no');
      return;
    }

    const data = JSON.parse(file.serverId);
    document.getElementById('edit-path').value = data.path;
  });

  Pond.on('removefile', (error, file) => {
    if (error) {
      console.log('Oh no');
      return;
    }

    const data = JSON.parse(file.serverId);
    console.log(data);
    document.getElementById('edit-path').value = '';
  });
};
