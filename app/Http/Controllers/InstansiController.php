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
        $data = Instansi::where('kategori', $kategori)->paginate(10);
        return view('index', compact('data', 'kategori'));
    }

    public function data($kategori)
    {
        $data = Instansi::where('kategori', $kategori)->paginate(10);
        return response()->json($data);
    }

}

