<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pemeriksaan;

class DokterController extends Controller
{
    public function dashboard()
    {
        try {
            // Mengambil data untuk hari ini
            $today = now()->format('Y-m-d');
            
            // Menghitung total
            $totalPasien = Pasien::count();
            $totalPemeriksaan = Pemeriksaan::count();
            
            // Menghitung data hari ini
            $pemeriksaanHariIni = Pemeriksaan::whereDate('tanggal_kunjungan', $today)->count();
            
            // Mengambil 5 pemeriksaan terbaru dengan eager loading
            $pemeriksaanTerbaru = Pemeriksaan::with(['pasien', 'dokter'])
                ->where('dokter_id', auth()->id()) // Hanya pemeriksaan dari dokter yang login
                ->whereHas('pasien')
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at
                ->take(5)
                ->get();
            
            // Mengambil 5 pasien terbaru yang diperiksa oleh dokter yang login
            $pasienTerbaru = Pasien::whereHas('pemeriksaans', function($query) {
                $query->where('dokter_id', auth()->id());
            })
            ->withCount(['pemeriksaans' => function($query) {
                $query->where('dokter_id', auth()->id());
            }])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

            // Menghitung total pasien yang diperiksa oleh dokter ini
            $totalPasien = Pemeriksaan::where('dokter_id', auth()->id())
                ->distinct('pasien_no_rekam_medis')
                ->count('pasien_no_rekam_medis');

            // Menghitung total pemeriksaan oleh dokter ini
            $totalPemeriksaan = Pemeriksaan::where('dokter_id', auth()->id())->count();

            // Menghitung pemeriksaan hari ini oleh dokter ini
            $pemeriksaanHariIni = Pemeriksaan::where('dokter_id', auth()->id())
                ->whereDate('tanggal_kunjungan', $today)
                ->count();

            // Debug
            \Log::info('Data Dashboard:', [
                'pemeriksaanTerbaru' => $pemeriksaanTerbaru,
                'pasienTerbaru' => $pasienTerbaru,
                'dokter_id' => auth()->id()
            ]);

            return view('dokter.dashboard', compact(
                'totalPasien',
                'totalPemeriksaan',
                'pemeriksaanHariIni',
                'pemeriksaanTerbaru',
                'pasienTerbaru'
            ));

        } catch (\Exception $e) {
            \Log::error('Error di Dashboard:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return view('dokter.dashboard', [
                'totalPasien' => 0,
                'totalPemeriksaan' => 0,
                'pemeriksaanHariIni' => 0,
                'pemeriksaanTerbaru' => collect([]),
                'pasienTerbaru' => collect([])
            ]);
        }
    }
} 