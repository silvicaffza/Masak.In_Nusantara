 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResepController;
use Illuminate\Support\Facades\Auth;

// ====================== LANDING PAGE ======================
Route::get('/', function () {
    return view('dashboard');
});

// ====================== USER ======================
    Route::get('/registrasi', [UserController::class, 'tampilRegistrasi'])->name('registrasi');
    Route::post('/registrasi/submit', [UserController::class, 'submitRegistrasi'])->name('registrasi.submit');
    Route::get('/login', [UserController::class, 'tampilLogin'])->name('login.tampil');
    Route::post('/login/submit', [UserController::class, 'submitLogin'])->name('login.submit');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('user')->group(function () {
    // Resep User (dengan auth)
    Route::middleware(['auth'])->group(function () {
        Route::get('/landing', [UserController::class, 'landing'])->name('user.landing');
        Route::get('/akun', [UserController::class, 'akun'])->name('user.akun');
        Route::put('/akun', [UserController::class, 'update'])->name('akun.update');

        Route::get('/reseps/tambah', [UserController::class, 'tambah'])->name('reseps.tambah');
        Route::post('/reseps', [UserController::class, 'store'])->name('reseps.store');
        Route::get('/resep/{id}', [UserController::class, 'show'])->name('resep.detail');
        Route::get('/resep/{id}/edit', [UserController::class, 'edit'])->name('resep.edit');
        Route::put('/resep/{id}', [UserController::class, 'ganti'])->name('resep.update');
        Route::get('/tambah', [UserController::class, 'tambah'])->name('user.tambah');
        Route::post('/tambah', [UserController::class, 'store'])->name('tambah.store');
    });

    // Kategori Resep
    Route::get('/jabar', [UserController::class, 'jabar'])->name('user.jabar');
    Route::get('/jatim', [UserController::class, 'jatim'])->name('user.jatim');
    Route::get('/jateng', [UserController::class, 'jateng'])->name('user.jateng');
});

// ====================== ADMIN ======================
Route::prefix('admin')->group(function () {
    // Auth Admin
    Route::get('/login', [AdminController::class, 'tampilLogin'])->name('admin.login');
    Route::post('/login/submit', [AdminController::class, 'submitLogin'])->name('admin.login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Admin Authenticated Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::put('/update', [AdminController::class, 'update'])->name('admin.update');
        Route::get('/kelola-user', [AdminController::class, 'kelolaUser'])->name('admin.kelola-user');
        Route::get('/kelola-resep-user', [AdminController::class, 'kelolaResepUser'])->name('admin.kelola-resep-user');

        // Resep Admin
        Route::resource('resep-adm', ResepController::class);
        Route::get('resep-adm/detail/{id}', [AdminController::class, 'detail'])->name('admin.resep.detail');
    });
});

// ====================== RESEP UMUM ======================
Route::get('/resep/{id}', [ResepController::class, 'show'])->name('resep.detail');
Route::get('/resep-admin/{id}', [ResepController::class, 'detail'])->name('resep-admin.detail');
