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
}
