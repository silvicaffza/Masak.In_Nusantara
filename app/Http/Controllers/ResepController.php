<?php

namespace App\Http\Controllers;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::all();
        return view('admin.resep-adm.index', compact('reseps'));
    }

    public function create()
    {
        return view('admin.resep-adm.create'); // Path sesuai dengan lokasi file view
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

        return redirect()->route('resep-adm.index')->with('success', 'Resep berhasil dibuat!');
    }
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        return view('admin.resep-adm.edit', compact('resep'));
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_masakan')) {
            Storage::delete('public/' . $resep->foto_masakan);
            $data['foto_masakan'] = $request->file('foto_masakan')->store('foto_masakan', 'public');
        }

        if ($request->hasFile('foto_langkah')) {
            Storage::delete('public/' . $resep->foto_langkah);
            $data['foto_langkah'] = $request->file('foto_langkah')->store('foto_langkah', 'public');
        }

        $resep->update($data);
        return redirect()->route('resep-adm.index')->with('success', 'Resep berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        Storage::delete('public/' . $resep->foto_masakan);
        Storage::delete('public/' . $resep->foto_langkah);
        $resep->delete();
        return redirect()->route('resep-adm.index')->with('success', 'Resep berhasil dihapus!');
    }
    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        return view('resep', compact('resep'));
    }
    public function detail($id)
    {
        $resep = Resep::findOrFail($id);
        return view('admin.resep-adm.detail', compact('resep'));
    }
    

}
