<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemeriksaan::with('pasien')->latest();
        
        // Filter berdasarkan pencarian nama pasien
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('pasien', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }
        
        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Statistik
        $totalPemeriksaan = Pemeriksaan::count();
        $pemeriksaanHariIni = Pemeriksaan::whereDate('created_at', today())->count();
        $totalPasien = Pasien::count();
        
        $pemeriksaans = $query->paginate(10);
        
        if($request->has('search') || $request->has('tanggal')) {
            $pemeriksaans->appends($request->all());
        }

        return view('dokter.pemeriksaan.index', compact(
            'pemeriksaans',
            'totalPemeriksaan',
            'pemeriksaanHariIni',
            'totalPasien'
        ));
    }

    public function create()
    {
        $dokters = Dokter::all();
        $pasiens = Pasien::all();
        
        return view('dokter.pemeriksaan.create', compact('dokters', 'pasiens'));
    }

    public function searchPasien(Request $request)
    {
        $search = $request->get('q');
        
        $pasiens = Pasien::where('nama', 'like', "%{$search}%")
            ->orWhere('no_rekam_medis', 'like', "%{$search}%")
            ->select('no_rekam_medis', 'nama', 'jenis_kelamin', 'tanggal_lahir')
            ->take(5)
            ->get();
            
        return response()->json($pasiens);
    }

    public function store(Request $request)
    {
        \Log::info('Data Request Pemeriksaan:', $request->all());

        try {
            $messages = [
                'suhu_tubuh.min' => 'Suhu tubuh minimal harus 35°C',
                'suhu_tubuh.max' => 'Suhu tubuh tidak boleh lebih dari 45.5°C',
                'suhu_tubuh.required' => 'Suhu tubuh wajib diisi',
                'suhu_tubuh.numeric' => 'Suhu tubuh harus berupa angka',
                'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi',
                'tanggal_kunjungan.date' => 'Format tanggal kunjungan tidak valid'
            ];

            $validated = $request->validate([
                'pasien_no_rekam_medis' => 'required|exists:pasiens,no_rekam_medis',
                'tanggal_kunjungan' => 'required|date',
                'berat_badan' => 'required|numeric',
                'tinggi_badan' => 'required|numeric',
                'tekanan_darah' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if (!$this->validateTekananDarah($value)) {
                            $fail('Format tekanan darah tidak valid. Gunakan format: 120/80');
                        }
                    },
                ],
                'detak_jantung' => 'required|integer',
                'suhu_tubuh' => 'required|numeric|min:35|max:45.5',
                'riwayat_penyakit' => 'nullable|string',
                'keluhan' => 'required|string',
                'diagnosis' => 'required|string',
                'resep_obat' => 'nullable|string'
            ], $messages);

            // Tambahkan dokter_id
            $validated['dokter_id'] = auth()->id();

            \Log::info('Data yang akan disimpan:', $validated);

            $pemeriksaan = Pemeriksaan::create($validated);
            
            \Log::info('Data yang tersimpan:', $pemeriksaan->toArray());

            return redirect()->route('dokter.pemeriksaan.index')
                ->with('success', 'Data pemeriksaan berhasil ditambahkan');
        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Pemeriksaan $pemeriksaan)
    {
        return view('dokter.pemeriksaan.show', compact('pemeriksaan'));
    }

    public function edit(Pemeriksaan $pemeriksaan)
    {
        $this->authorize('update', $pemeriksaan);
        $pasiens = Pasien::select('no_rekam_medis', 'nama')->get();
        return view('dokter.pemeriksaan.edit', compact('pemeriksaan', 'pasiens'));
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $this->authorize('update', $pemeriksaan);
        
        try {
            \Log::info('Request data:', $request->all());

            $messages = [
                'suhu_tubuh.min' => 'Suhu tubuh minimal harus 35°C',
                'suhu_tubuh.max' => 'Suhu tubuh tidak boleh lebih dari 45.5°C',
                'suhu_tubuh.required' => 'Suhu tubuh wajib diisi',
                'suhu_tubuh.numeric' => 'Suhu tubuh harus berupa angka'
            ];

            $validated = $request->validate([
                'tanggal_kunjungan' => 'required|date',
                'berat_badan' => 'required|numeric|min:0|max:500',
                'tinggi_badan' => 'required|numeric|min:0|max:300',
                'tekanan_darah' => 'required|string|regex:/^\d{2,3}\/\d{2,3}$/',
                'detak_jantung' => 'required|integer|min:0|max:300',
                'suhu_tubuh' => 'required|numeric|min:35|max:45.5',
                'riwayat_penyakit' => 'nullable|string',
                'keluhan' => 'required|string',
                'diagnosis' => 'required|string',
                'resep_obat' => 'nullable|string'
            ], $messages);

            \Log::info('Data yang akan diupdate:', $validated);

            $pemeriksaan->update($validated);

            \Log::info('Update berhasil untuk pemeriksaan ID: ' . $pemeriksaan->id);

            return redirect()->route('dokter.pemeriksaan.index')
                ->with('success', 'Data pemeriksaan berhasil diperbarui');
            
        } catch (\Exception $e) {
            \Log::error('Error saat update pemeriksaan: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->withInput()
                ->withErrors($e->getMessage())
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $this->authorize('delete', $pemeriksaan);
        $pemeriksaan->delete();
        return redirect()->route('dokter.pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus');
    }

    public function exportPDF(Pemeriksaan $pemeriksaan)
    {
        try {
            // Debug untuk melihat data
            \Log::info('Pemeriksaan Data:', $pemeriksaan->toArray());
            
            // Load relasi yang dibutuhkan
            $pemeriksaan->load(['pasien', 'dokter']);
            
            // Debug untuk melihat data setelah load
            \Log::info('Loaded Data:', $pemeriksaan->toArray());

            // Generate PDF dengan opsi minimal
            $pdf = PDF::loadView('dokter.pemeriksaan.pdf', [
                'pemeriksaan' => $pemeriksaan
            ]);

            // Set nama file
            $filename = 'rekam-medis-' . $pemeriksaan->id . '.pdf';

            // Download file
            return $pdf->download($filename);

        } catch (\Exception $e) {
            // Log error lengkap
            \Log::error('PDF Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Return error sebagai JSON untuk debugging
            if (request()->wantsJson()) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ], 500);
            }
            
            return back()->with('error', 'Gagal mengunduh PDF: ' . $e->getMessage());
        }
    }

    private function validateTekananDarah($value) 
    {
        if (!preg_match('/^\d{2,3}\/\d{2,3}$/', $value)) {
            return false;
        }
        list($systolic, $diastolic) = explode('/', $value);
        return $systolic >= 70 && $systolic <= 200 && 
               $diastolic >= 40 && $diastolic <= 130;
    }
}
