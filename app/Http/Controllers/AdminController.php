<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Resep;


class AdminController extends Controller
{
     public function tampilLogin()
    {
        return view('admin.login');
    }

    public function submitLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && $user->role == 'user') {
            return back()->with('gagal', 'Akun user tidak bisa login di sini!');
        }
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
    
        return back()->with('gagal', 'Email atau password salah!');
    }
    
    
    function dashboard() {
        $reseps = Resep::with('user')->get(); 
        return view('admin.dashboard', compact('reseps'));
    }
    

    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('success', 'Logout berhasil!');
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $request->admin_name;
        $user->email = $request->admin_email;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil diperbarui');
    }
    
    public function kelolaUser()
    {
        $users = User::all();
        return view('admin.kelola-user', compact('users'));
    }
    public function kelolaResepUser()
    {
        $reseps = Resep::whereHas('user', function ($query) {
            $query->where('role', 'user'); 
        })->get();

        return view('admin.kelola-resep-user', compact('reseps'));
    }

    public function detail($id)
    {
        $resep = Resep::findOrFail($id);
        return view('admin.resep-adm.detail', compact('resep'));
    }

}

 