<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-custom {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .card-custom:hover {
            transform: scale(1.02);
        }
        .card-light {
            background-color: #fff;
        }
        .card-grey {
            background-color: #f1f1f1;
        }
        .btn-custom {
            border-radius: 8px;
            transition: 0.3s;
            font-weight: bold;
            background-color: rgb(112, 160, 93);
        }
        .btn-custom:hover {
            transform: scale(1.05);
            background-color: rgb(92, 158, 65);
        }
        .table-custom th {
            background-color:rgb(146, 221, 116);
            color: white;
            text-align: center;
        }
        .table-custom td {
            vertical-align: middle;
            text-align: center;
        }
        #edit-form {
            display: none;
            transition: all 0.3s ease-in-out;
        }

        /* Styling for the Navbar */
        .navbar-custom {
            background-color:hsl(51, 45.90%, 61.60%); /* Indigo color */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #FFD700 !important;
        }

        .navbar-custom .navbar-toggler-icon {
            background-color: white;
        }

        /* Custom styles for buttons */
        .btn-back, .btn-logout {
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 50px;
            transition: 0.3s;
        }

        .btn-back {
            background-color: #28a745;
            color: white;
        }

        .btn-back:hover {
            background-color: #218838;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        function toggleEditForm() {
            let form = document.getElementById("edit-form");
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">Akun Ku Masak.In</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('user.landing') }}" class="btn btn-back btn-custom">Kembali ke Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-logout btn-custom me-2" href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Container Akun -->
<div class="container mt-5">
    
    @auth
    <div class="row">
        <!-- Card Informasi Pengguna -->
        <div class="col-lg-6">
            <div class="card card-custom card-light p-4">
                <div class="card-body">
                    <h5 class="card-title text-center">Informasi Pengguna</h5>
                    <hr>
                    <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

                    <button class="btn  btn-custom w-100 mt-3" onclick="toggleEditForm()">Edit Akun</button>
                    
                    <!-- Form Edit -->
                    <div id="edit-form" class="mt-3">
                        <form action="{{ route('akun.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <button type="submit" class="btn btn-success btn-custom w-100">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary btn-custom w-100 mt-2" onclick="toggleEditForm()">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Daftar Resep -->
        <div class="col-lg-6">
            <div class="card card-custom card-grey p-4">
                <div class="card-body">
                    <h3 class="text-center fw-bold">Daftar Resep Pengguna</h3>
                    <div class="text-end mb-3">
                        <a href="{{ route('user.tambah') }}" class="btn btn-secondary btn-custom">Tambah Resep</a>
                    </div>
                    <table class="table table-bordered table-striped table-custom mt-3">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($reseps) && count($reseps) > 0)
                                @foreach ($reseps as $resep)
                                    @if (isset($resep->user) && $resep->user->role === 'user')
                                        <tr>
                                            <td>{{ $resep->nama_masakan }}</td>
                                            <td>{{ $resep->kategori }}</td>
                                            <td>
                                                @if ($resep->foto_masakan)
                                                    <img src="{{ asset('storage/'.$resep->foto_masakan) }}" width="100" class="rounded">
                                                @else
                                                    <span class="text-muted">Tidak ada foto</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('resep.detail', $resep->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Belum ada resep.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endauth

    @guest
    <div class="alert alert-warning mt-4 text-center">
        Anda belum login. Silakan <a href="{{ route('login') }}" class="alert-link">login</a> terlebih dahulu.
    </div>
    @endguest

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
