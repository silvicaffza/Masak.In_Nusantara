<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Resep; 
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function tampilRegistrasi() {
        return view('registrasi');
    }//untuk menampilkan registrasi

    function submitRegistrasi(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;    
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login.tampil')->with('success', 'Registrasi berhasil! Silakan login.');
        //setelah masukin data registrasi, jika berhasil akan diarahkan ke login.tampil
    }

    function tampilLogin() {
        return view('login'); 
    }   //menampilkan login
    
    public function submitLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->role == 'admin') {
            return back()->with('gagal', 'Akun admin tidak bisa login di sini!');
        }//admin tidak boleh login disini
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.landing');
        }//user akan diarahkan ke user.landing
    
        return back()->with('gagal', 'Email atau password salah!');
    }//untuk route setelah login berhasil, 
    
    function landing() {
        return view('user.landing'); // Pastikan file ini ada di resources/views/user/landing.blade.php
    }
    
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login.tampil')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('resep-adm.index')->with('success', 'Resep berhasil ditambahkan!');
        } else {
            return redirect()->route('user.landing')->with('success', 'Resep berhasil ditambahkan!');
        }
        
    }


    function tambah() {
        return view('user.tambah'); // Pastikan file ini ada di resources/views/user/landing.blade.php
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_masakan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'bahan' => 'required|string',
            'cara_pengolahan' => 'required|string',
            'foto_masakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
            'foto_langkah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',  // Maksimal 5MB
            'link_youtube' => 'nullable|url',
        ]);

        $resep = new Resep();
        $resep->nama_masakan = $request->nama_masakan;
        $resep->deskripsi = $request->deskripsi;
        $resep->kategori = $request->kategori;
        $resep->bahan = $request->bahan;
        $resep->cara_pengolahan = $request->cara_pengolahan;
        $resep->link_youtube = $request->link_youtube;
        $resep->user_id = auth()->id(); // Menyimpan user_id yang sedang login

        // Mengupload foto masakan jika ada
        if ($request->hasFile('foto_masakan')) {
            $foto_masakan = $request->file('foto_masakan')->store('foto_masakan');
            $resep->foto_masakan = $foto_masakan;
        }

        // Mengupload foto langkah jika ada
        if ($request->hasFile('foto_langkah')) {
            $foto_langkah = $request->file('foto_langkah')->store('foto_langkah');
            $resep->foto_langkah = $foto_langkah;
        }

        $resep->save(); // Menyimpan data ke database

        return redirect()->route('user.akun')->with('success', 'Resep berhasil dibuat!');
    }
    function jabar() {
        $kategori = 'Jawa Barat'; 
        $reseps = Resep::all(); // Ambil semua data resep dari database

        return view('user.jabar', compact('kategori', 'reseps'));
    }function jateng() {
        $kategori = 'Jawa Tengah'; 
        $reseps = Resep::all(); // Ambil semua data resep dari database

        return view('user.jateng', compact('kategori', 'reseps'));
    }function jatim() {
        $kategori = 'Jawa Timur'; 
        $reseps = Resep::all(); // Ambil semua data resep dari database

        return view('user.jatim', compact('kategori', 'reseps'));
    }
    
    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.akun')->with('success', 'Akun berhasil diperbarui!');
    }

    public function akun() {
        $user = Auth::user(); // Ambil user yang sedang login
        $reseps = Resep::where('user_id', $user->id)->get(); // Ambil resep yang dibuat user ini
    
        return view('user.akun', compact('user', 'reseps')); // Kirim data ke view
    }
    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        return view('user.detail', compact('resep'));
    }
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        return view('user.edit', compact('resep'));
    }

    public function ganti(Request $request, $id)
    {
        $request->validate([
            'nama_masakan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'bahan' => 'required|string',
            'cara_pengolahan' => 'required|string',
            'foto_masakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
            'foto_langkah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',  // Maksimal 5MB
            'link_youtube' => 'nullable|url',
        ]);

        $resep = Resep::findOrFail($id);
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('foto_masakan')) {
            Storage::delete('public/' . $resep->foto_masakan);
            $data['foto_masakan'] = $request->file('foto_masakan')->store('foto_masakan', 'public');
        }

        if ($request->hasFile('foto_langkah')) {
            Storage::delete('public/' . $resep->foto_langkah);
            $data['foto_langkah'] = $request->file('foto_langkah')->store('foto_langkah', 'public');
        }

        $resep->update($data);
        return redirect()->route('user.akun')->with('success', 'Resep berhasil diperbarui!');
    }

}