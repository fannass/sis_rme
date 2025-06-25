<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PemeriksaanController extends Controller
{
    public function index()
    {
        $pemeriksaans = Pemeriksaan::with(['pasien', 'dokter'])->latest()->get();
        return view('pemeriksaan.index', compact('pemeriksaans'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        
        return view('pemeriksaan.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        // Tambahkan logging untuk debugging
        \Log::info('Data yang diterima:', $request->all());

        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_pemeriksaan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'resep' => 'nullable|string'
        ]);

        try {
            Pemeriksaan::create($validated);
            return redirect()->route('pemeriksaan.index')
                ->with('success', 'Data pemeriksaan berhasil ditambahkan');
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan pemeriksaan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
} 