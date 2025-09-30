<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->judul_buku) {
            $query->where('judul_buku', 'like', '%' . $request->judul_buku . '%');
        }
        if ($request->penulis) {
            $query->where('penulis', $request->penulis);
        }
        if ($request->show_latest) {
            $query->orderByDesc('tanggal_terbit')->limit(5);
        }

        $data_buku = $query->orderByDesc('id')->get();
        $daftar_penulis = Buku::select('penulis')->distinct()->orderBy('penulis')->pluck('penulis');

        return view('toko_buku', compact('data_buku', 'daftar_penulis'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tanggal_terbit' => 'required|date',
            'harga' => 'required|numeric|min:0',
        ]);

        Buku::create([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'tanggal_terbit' => $request->tanggal_terbit,
            'harga' => $request->harga,
        ]);

        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id); 
        $buku->delete(); 
        return redirect('/buku')->with('success', 'Buku berhasil dihapus!');
    }

    public function edit($id) {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date'
        ]);

        $buku = Buku::find($id);
        $buku->judul_buku = $request->judul_buku;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->save();

        return redirect('/buku')->with('success', 'Buku berhasil diperbarui!');
    }
}
