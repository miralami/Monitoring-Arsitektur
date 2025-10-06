<?php

// app/Http/Controllers/InstansiController.php
namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'default'); // bisa ambil dari query/nav
        $kategori = $kategori=='default' ? 'Kementerian' : $kategori;
        $data = Instansi::where('kategori', $kategori)->paginate(10);
        return view('index', compact('data', 'kategori'));
    }

    // InstansiController
    public function data($kategori)
    {
        $map = [
            'Kementerian' => 'Kementerian',
            'LPNK' => 'LPNK',
            'LNS' => 'LNS',
            'InstansiLain' => 'Instansi Lain',
            'Provinsi' => 'Provinsi',
            'KabKota' => 'Kab/Kota',
        ];

        $kategoriAsli = $map[$kategori] ?? $kategori;

        $data = Instansi::where('kategori', $kategoriAsli)->paginate(10);
        return response()->json($data);
    }

}

