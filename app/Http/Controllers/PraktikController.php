<?php

namespace App\Http\Controllers;

use App\Models\Praktik;
use Illuminate\Http\Request;

class PraktikController extends Controller
{
    public function store(Request $request)
    {
        // Debug: Lihat semua data yang diterima
        \Log::info('Semua request data:', $request->all());

        // Validasi dengan required untuk nama_praktik
        $validated = $request->validate([
            'nama_praktik' => 'required|string|max:255',  // Tetap required
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kota' => 'nullable|string',
        ]);

        // Debug: Lihat data yang sudah divalidasi
        \Log::info('Data yang divalidasi:', $validated);

        try {
            $praktik = Praktik::create($validated);
            \Log::info('Praktik berhasil dibuat:', $praktik->toArray());
            
            return response()->json([
                'message' => 'Praktik created successfully',
                'data' => $praktik
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saat membuat praktik:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Error creating praktik',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_praktik' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kota' => 'nullable|string',
        ]);

        $praktik = Praktik::findOrFail($id);
        $praktik->nama_praktik = $request->nama_praktik;
        $praktik->alamat = $request->alamat;
        $praktik->telepon = $request->telepon;
        $praktik->kota = $request->kota;
        $praktik->save();

        return response()->json(['message' => 'Praktik updated successfully']);
    }
} 