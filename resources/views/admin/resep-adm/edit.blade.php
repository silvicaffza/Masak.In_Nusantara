<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

</head>
<body class="container mt-4">

    <h2>Edit Resep</h2>
    <form action="{{ route('resep-adm.update', $resep->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Masakan</label>
            <input type="text" name="nama_masakan" class="form-control" value="{{ $resep->nama_masakan }}">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $resep->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $resep->kategori }}">
        </div>
        <div class="mb-3">
            <label>Foto Masakan</label>
            <input type="file" name="foto_masakan" class="form-control">
            @if ($resep->foto_masakan)
                <img src="{{ asset('storage/'.$resep->foto_masakan) }}" width="100">
            @endif
        </div>
        <div class="mb-3">
            <label>Bahan</label>
            <textarea name="bahan" id="bahan" class="form-control">{{ $resep->bahan }}</textarea>
        </div>
        <div class="mb-3">
            <label>Cara Pengolahan</label>
            <textarea name="cara_pengolahan" id="cara_pengolahan" class="form-control">{{ $resep->cara_pengolahan }}</textarea>
        </div>
        <div class="mb-3">
            <label>Foto Langkah Pengolahan</label>
            <input type="file" name="foto_langkah" class="form-control">
            @if ($resep->foto_langkah)
                <img src="{{ asset('storage/'.$resep->foto_langkah) }}" width="100">
            @endif
        </div>
        <div class="mb-3">
            <label>Link YouTube</label>
            <input type="text" name="link_youtube" class="form-control" value="{{ $resep->link_youtube }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => console.error(error));

        ClassicEditor
            .create(document.querySelector('#bahan'))
            .catch(error => console.error(error));

        ClassicEditor
            .create(document.querySelector('#cara_pengolahan'))
            .catch(error => console.error(error));
    </script>

</body>
</html>
