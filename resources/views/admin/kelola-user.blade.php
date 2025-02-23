<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
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
            margin-left: 260px;
            padding: 30px;
        }
        .content h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #343a40;
        }
        .table {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
            font-size: 1rem;
        }
        .table thead {
            background-color: #8B4513;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }
        .btn-custom {
            background-color: #8B4513;
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .btn-custom:hover {
            background-color: #A0522D;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.kelola-user') }}">Kelola Pengguna</a>
        <a href="{{ route('resep-adm.index') }}">Kelola Resep Admin</a>
        <a href="{{ route('admin.kelola-resep-user') }}">Kelola Resep Pengguna</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Daftar User Terdaftar</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-bordered mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Registrasi</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
