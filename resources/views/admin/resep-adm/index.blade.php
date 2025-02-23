<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
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
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Admin Panel</h3>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.kelola-user') }}">Kelola Pengguna</a>
        <a href="{{ route('resep-adm.index') }}">Kelola Resep Admin</a>
        <a href="{{ route('admin.kelola-resep-user') }}">Kelola Resep Pengguna</a>
    </div>

    <!-- Konten -->
    <div class="content">
        <h2>Daftar Resep Admin</h2>
        <a href="{{ route('resep-adm.create') }}" class="btn btn-primary mb-3">Tambah Resep</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reseps as $resep)
                @if ($resep->user && $resep->user->role === 'admin')
                        <tr>
                            <td>{{ $resep->nama_masakan }}</td>
                            <td>{{ $resep->kategori }}</td>
                            <td>
                                @if ($resep->foto_masakan)
                                   <img src="{{ asset('storage/'.$resep->foto_masakan) }}" width="100">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('resep-adm.edit', $resep->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('resep-adm.destroy', $resep->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
