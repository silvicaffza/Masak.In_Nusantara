<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background:rgb(194, 188, 122); /* Coklat tua */
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h3 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 30px;
            color:rgb(46, 27, 3);
        }
        .sidebar a {
            color: rgb(80, 74, 4);
            text-decoration: none;
            padding: 12px;
            display: block;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background:rgba(75, 122, 53, 0.28); /* Warna coklat lebih terang */
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .navbar-top {
            width: calc(100% - 250px);
            height: 60px;
            background:rgb(212, 203, 97);
            color: white;
            position: fixed;
            top: 0;
            left: 250px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
        }
        .navbar-top .btn {
            margin-left: 10px;
        }
        .container-fluid {
            margin-top: 80px;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card img {
            max-width: 100%;
            border-radius: 5px;
        }
        .card-body {
            padding: 15px;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1rem;
            margin-bottom: 15px;
        }
        .btn-view {
            background-color: #8B4513;
            color: white;
            border-radius: 5px;
        }
        .btn-view:hover {
            background-color: #A0522D;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 class="text-center">Admin Panel</h3>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.kelola-user') }}">Kelola Pengguna</a>
        <a href="{{ route('resep-adm.index') }}">Kelola Resep Admin</a>
        <a href="{{ route('admin.kelola-resep-user') }}">Kelola Resep Pengguna</a>
    </div>

    <div class="navbar-top">
        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editAccountModal">My Akun</button>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="content">
        <h2>Daftar Resep Admin</h2>
        <div class="row">
            @foreach ($reseps as $resep)
                @if ($resep->user && $resep->user->role === 'admin')
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $resep->foto_masakan ? asset('storage/'.$resep->foto_masakan) : 'https://via.placeholder.com/300' }}" class="card-img-top" alt="Foto Resep">
                            <div class="card-body">
                                <h5 class="card-title">{{ $resep->nama_masakan }}</h5>
                                <p class="card-text">Kategori: {{ $resep->kategori }}</p>
                                <a href="{{ url('admin/resep-adm/detail/'.$resep->id) }}" class="btn btn-view">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Modal Edit Akun -->
    <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountModalLabel">Edit Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.update') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label for="adminName" class="form-label">Nama Admin</label>
                            <input type="text" class="form-control" id="adminName" name="admin_name" value="{{ auth()->user()->name }}" required>
                        </div> 
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Email Admin</label>
                            <input type="email" class="form-control" id="adminEmail" name="admin_email" value="{{ auth()->user()->email }}" required>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
