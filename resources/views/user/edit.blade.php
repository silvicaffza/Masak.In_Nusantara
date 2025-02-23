<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }
        h2 {
            font-weight: 500;
            color: #4e4e4e;
        }
        label {
            font-weight: 500;
            color: #333;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .btn {
            border-radius: 5px;
            font-weight: 500;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .mb-3 img {
            border-radius: 5px;
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Resep</h2>
    <form action="{{ route('resep.ganti', $resep->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
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
                <img src="{{ asset('storage/'.$resep->foto_masakan) }}" alt="Foto Masakan">
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
                <img src="{{ asset('storage/'.$resep->foto_langkah) }}" alt="Foto Langkah Pengolahan">
            @endif
        </div>
        <div class="mb-3">
            <label>Link YouTube</label>
            <input type="text" name="link_youtube" class="form-control" value="{{ $resep->link_youtube }}">
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('user.akun') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#bahan'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#cara_pengolahan'))
        .catch(error => {
            console.error(error);
        });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
