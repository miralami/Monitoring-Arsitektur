<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Instansi;
use App\Models\KategoriInstansi;
use App\Exports\InstansiExport;
use Maatwebsite\Excel\Facades\Excel; 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class InstansiController extends Controller
{
    /**
     * Menampilkan daftar semua Instansi.
     */
    public function index()
    {
        // Ambil data Instansi, sertakan relasi kategori dan daerah untuk menghindari N+1 query problem
        $instansis = Instansi::with(['kategori', 'daerah'])->latest()->get();

        return view('instansi.index', compact('instansis'));
    }

    /**
     * Menampilkan form untuk membuat Instansi baru.
     */
    public function create()
    {
        $kategoris = KategoriInstansi::all();
        $daerahs = Daerah::all();

        return view('instansi.create', compact('kategoris', 'daerahs'));
    }

    /**
     * Menyimpan Instansi baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instansi' => 'required|string|max:255',
            'id_kategori_instansi' => 'required|exists:kategori_instansi,id',
            'id_daerah' => 'required|exists:daerah,id',
            // ... tambahkan aturan validasi untuk kolom lainnya sesuai kebutuhan ...
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Instansi::create($request->all());

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail Instansi tertentu.
     */
    public function show(Instansi $instansi)
    {
        // Muat relasi kategori dan daerah
        $instansi->load('kategori', 'daerah');

        return view('instansi.show', compact('instansi'));
    }

    /**
     * Menampilkan form untuk mengedit Instansi tertentu.
     */
    public function edit(Instansi $instansi)
    {
        $kategoris = KategoriInstansi::all();
        $daerahs = Daerah::all();

        return view('instansi.edit', compact('instansi', 'kategoris', 'daerahs'));
    }

    /**
     * Memperbarui Instansi tertentu di database.
     */
    public function update(Request $request, Instansi $instansi)
    {
        $validator = Validator::make($request->all(), [
            'instansi' => 'required|string|max:255',
            'id_kategori_instansi' => 'required|exists:kategori_instansi,id',
            'id_daerah' => 'required|exists:daerah,id',
            // ... tambahkan aturan validasi untuk kolom lainnya sesuai kebutuhan ...
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $instansi->update($request->all());

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil diperbarui!');
    }

    /**
     * Menghapus Instansi tertentu dari database.
     */
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil dihapus!');
    }

    // app/Http/Controllers/InstansiController.php
    public function apiData()
    {
        // Ambil SEMUA kolom yang dibutuhkan di DataTables
        $instansis = Instansi::with(['kategori', 'daerah'])
            ->select([
                'id', // PENTING: ID dibutuhkan untuk Aksi dan DataTables
                'instansi',
                
                // Kolom As-Is
                'proses_bisnis_as_is', 'layanan_as_is', 'data_info_as_is',
                'aplikasi_as_is', 'infra_as_is', 'keamanan_as_is',
                
                // Kolom To-Be
                'proses_bisnis_to_be', 'layanan_to_be', 'data_info_to_be',
                'aplikasi_to_be', 'infra_to_be', 'keamanan_to_be',
                
                // Kolom Status Baru (Boolean)
                'peta_rencana', 'clearance', 'reviueval', 'tingkat_kematangan',
            ])
            ->get();

        // Pastikan response menggunakan format DataTables standar: {'data': [...]}
        return response()->json([
            'data' => $instansis
        ]);
    }
    
    public function getInstansiByKategoriId($kategoriId)
    {
        // PENTING: Lakukan validasi input kategoriId di lingkungan produksi
        if (!is_numeric($kategoriId)) {
            return response()->json(['error' => 'Invalid category ID'], 400);
        }

        // Ambil data Instansi, difilter menggunakan where clause
        $instansis = Instansi::with(['kategori', 'daerah'])
            ->where('id_kategori_instansi', $kategoriId) // <<< FILTER UTAMA DITAMBAHKAN DI SINI
            ->select([
                'id',
                'instansi',
                'proses_bisnis_as_is', 'layanan_as_is', 'data_info_as_is',
                'aplikasi_as_is', 'infra_as_is', 'keamanan_as_is',
                'proses_bisnis_to_be', 'layanan_to_be', 'data_info_to_be',
                'aplikasi_to_be', 'infra_to_be', 'keamanan_to_be',
                'peta_rencana', 'clearance', 'reviueval', 'tingkat_kematangan',
            ])
            ->get();

        // Mengembalikan data dalam format DataTables standar: {'data': [...]}
        return response()->json([
            'data' => $instansis
        ]);
    }

    public function exportExcel(int $kategoriId)
    {
        $kategoriNama = ['Kementerian', 'LPNK', 'LNS', 'Instansi Lainnya', 'Provinsi', 'KabupatenKota'];
        
        $namaFile = 'rekap_instansi_' . ($kategoriNama[$kategoriId - 1] ?? 'lainnya') . '_' . now()->format('Ymd_His') . '.xlsx';
        
        // Sekarang, 'Excel' akan merujuk ke Maatwebsite\Excel\Facades\Excel dan tidak akan error.
        return Excel::download(new InstansiExport($kategoriId), $namaFile);
    }
}