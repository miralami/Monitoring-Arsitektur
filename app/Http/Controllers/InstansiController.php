<?php

// app/Http/Controllers/InstansiController.php
namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    protected $kategoriMap = [
        'Kementerian' => 'Kementerian',
        'LPNK' => 'LPNK',
        'LNS' => 'LNS',
        'InstansiLain' => 'Instansi Lain',
        'Provinsi' => 'Provinsi',
        'KabKota' => 'Kab/Kota',
    ];

    public function index(Request $request)
    {
        $kategori = $request->get('kategori', 'Kementerian');
        return view('index', compact('kategori'));
    }

    public function data(Request $request)
    {
        $kategori = $request->get('kategori', 'Kementerian');
        $kategoriAsli = $this->kategoriMap[$kategori] ?? $kategori;

        try {
            $query = Instansi::query()->where('kategori', $kategoriAsli);

            return datatables()
                ->eloquent($query)
                ->addColumn('action', function ($row) {
                    return '<button data-id="'.$row->id.'"
                        class="refresh-btn bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        <i class="fas fa-sync-alt"></i>
                    </button>';
                })
                ->addColumn('peta_rencana_icon', function ($row) {
                    return $row->peta_rencana ? '✓' : '-';
                })
                ->addColumn('clearance_icon', function ($row) {
                    return $row->clearance ? '✓' : '-';
                })
                ->addColumn('reviueval_icon', function ($row) {
                    return $row->reviueval ? '✓' : '-';
                })
                ->addColumn('tingkat_kematangan_display', function ($row) {
                    return $row->tingkat_kematangan ? number_format($row->tingkat_kematangan, 1) : '-';
                })
                ->rawColumns(['action'])
                ->toJson();
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

