<?php

namespace App\Http\Controllers;

use App\Models\Arsitektur;
use Illuminate\Http\Request;

class ArsitekturController extends Controller
{
    public function index()
    {
        $data = Arsitektur::all();
        return view('dashboard.tables', compact('data'));
    }

    public function refreshAll()
    {
        try {
            // Refresh logic here - could be updating from external API or recalculating
            $data = Arsitektur::all();
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function refreshRow($id)
    {
        try {
            $row = Arsitektur::findOrFail($id);
            // Refresh logic for single row here
            return response()->json([
                'success' => true,
                'data' => $row
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
