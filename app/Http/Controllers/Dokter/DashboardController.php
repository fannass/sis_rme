<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $dokter = Auth::user();
        
        // Debug untuk melihat timezone dan tanggal yang digunakan
        \Log::info('Current timezone: ' . config('app.timezone'));
        \Log::info('Current date: ' . Carbon::today()->toDateString());
        
        // Pemeriksaan hari ini - gunakan whereDate dengan created_at dan tanggal_kunjungan
        $pemeriksaanHariIni = Pemeriksaan::where('dokter_id', Auth::id())
            ->where(function($query) {
                $query->whereDate('tanggal_kunjungan', Carbon::today())
                      ->orWhereDate('created_at', Carbon::today());
            })
            ->get();
        
        \Log::info('Pemeriksaan hari ini:', [
            'count' => $pemeriksaanHariIni->count(),
            'data' => $pemeriksaanHariIni->toArray()
        ]);

        // Total pasien unik
        $totalPasien = Pemeriksaan::where('dokter_id', Auth::id())
            ->distinct('pasien_no_rekam_medis')
            ->count('pasien_no_rekam_medis');

        // Total pemeriksaan keseluruhan
        $totalPemeriksaan = Pemeriksaan::where('dokter_id', Auth::id())->count();
        
        // Pemeriksaan hari ini
        $pemeriksaanHariIni = $pemeriksaanHariIni->count();

        // Pasien hari ini
        $pasienHariIni = Pemeriksaan::where('dokter_id', Auth::id())
            ->where(function($query) {
                $query->whereDate('tanggal_kunjungan', Carbon::today())
                      ->orWhereDate('created_at', Carbon::today());
            })
            ->distinct('pasien_no_rekam_medis')
            ->count('pasien_no_rekam_medis');

        // Aktivitas terkini - tampilkan semua aktivitas terbaru
        $recentActivities = Pemeriksaan::with('pasien')
            ->where('dokter_id', Auth::id())
            ->latest('tanggal_kunjungan')
            ->take(5)
            ->get()
            ->map(function ($pemeriksaan) {
                return [
                    'description' => "Pemeriksaan pasien {$pemeriksaan->pasien->nama}",
                    'created_at' => $pemeriksaan->tanggal_kunjungan,
                    'type' => 'pemeriksaan'
                ];
            });

        // Mengambil aktivitas hari ini
        $aktivitasHariIni = Pemeriksaan::with('pasien')
            ->whereDate('tanggal_kunjungan', Carbon::today())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        return view('dokter.dashboard', compact(
            'dokter',
            'totalPasien',
            'totalPemeriksaan',
            'pemeriksaanHariIni',
            'pasienHariIni',
            'recentActivities',
            'aktivitasHariIni'
        ));
    }
}
