
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Resep</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input[type="text"], input[type="url"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .success {
            color: green;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
</head>
<body>
    <h1>Buat Resep Baru</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('resep-adm.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return setEditorData()">
        @csrf

        <div class="form-group">
            <label for="nama_masakan">Nama Masakan:</label>
            <input type="text" name="nama_masakan" id="nama_masakan" value="{{ old('nama_masakan') }}" required>
            @error('nama_masakan') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <!-- <div id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</div> -->
            <textarea name="deskripsi" id="deskripsi" style="display:none"></textarea>
            @error('deskripsi') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="kategori">Kategori:</label>
            <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}" required>
            @error('kategori') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="bahan">Bahan:</label>
            <!-- <div id="bahan" name="bahan">{{ old('bahan') }}</div> -->
            <textarea name="bahan" id="bahan" style="display:none"></textarea>
            @error('bahan') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="cara_pengolahan">Cara Pengolahan:</label>
            <!-- <div id="cara_pengolahan" name="cara_pengolahan">{{ old('cara_pengolahan') }}</div> -->
            <textarea name="cara_pengolahan" id="cara_pengolahan" style="display:none"></textarea>
            @error('cara_pengolahan') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="foto_masakan">Foto Masakan:</label>
            <input type="file" name="foto_masakan" id="foto_masakan">
            @error('foto_masakan') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="foto_langkah">Foto Langkah:</label>
            <input type="file" name="foto_langkah" id="foto_langkah">
            @error('foto_langkah') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="link_youtube">Link YouTube (Opsional):</label>
            <input type="url" name="link_youtube" id="link_youtube" value="{{ old('link_youtube') }}">
            @error('link_youtube') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Buat Resep</button>
    </form>

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

        function setEditorData() {
            // Set the content of CKEditor to the hidden textarea before form submission
            document.querySelector('#deskripsi').value = document.querySelector('#deskripsi').innerHTML;
            document.querySelector('#bahan').value = document.querySelector('#bahan').innerHTML;
            document.querySelector('#cara_pengolahan').value = document.querySelector('#cara_pengolahan').innerHTML;

            return true; // Form will be submitted
        }
    </script>
</body>
</html>
