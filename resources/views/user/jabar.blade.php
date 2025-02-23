<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Berdasarkan Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f4f6f9, #dee2e6);
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 1100px;
        }
        h3 {
            font-weight: 700;
            color:rgb(65, 172, 102);
            text-align: center;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
            color: white;
            transition: 0.3s ease-in-out;
            border-radius: 8px;
        }
        .btn-back:hover {
            background-color: #495057;
        }
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            background: white;
        }
        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .card-body {
            padding: 20px;
            text-align: center;
        }
        .card-title {
            font-size: 22px;
            font-weight: 600;
            color: #212529;
        }
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            transition: 0.3s ease-in-out;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003f80);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 >{{ $kategori }}</h3>
        
        <div class="d-flex justify-content-start mb-4">
            <a href="{{ route('user.landing') }}" class="btn btn-back px-4 py-2">← Kembali</a>
        </div>

        <div class="row">
            @foreach ($reseps as $resep)
                @if ($resep->kategori == 'Jawa Barat')
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ $resep->foto_masakan ? asset('storage/'.$resep->foto_masakan) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $resep->nama_masakan }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $resep->nama_masakan }}</h5>
                                <a href="{{ route('resep-adm.show', $resep->id) }}" class="btn btn-primary w-100">Lihat Resep</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</body>
</html>
