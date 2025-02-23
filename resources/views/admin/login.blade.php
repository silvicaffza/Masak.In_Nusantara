<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url("{{ asset('assets/loginadmin.png') }}") no-repeat center center;
            background-size: cover;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.19); /* Warna putih dengan transparansi 70% */
            padding: 50px;
            width: 500px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="login-container">
        <h2 class="text-center mb-4">Form Login Admin</h2>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        @if (session('gagal'))
            <p class="text-danger text-center mt-3">{{ session('gagal') }}</p>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

        