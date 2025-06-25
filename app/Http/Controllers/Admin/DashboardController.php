<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Praktik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'dokter') {
            $dokter = $user->dokter()->with('praktik')->first();
            // ... kode lainnya
        }
        
        $totalDokter = Dokter::count();
        $totalPraktik = Praktik::count();
        
        return view('admin.dashboard', compact('totalDokter', 'totalPraktik'));
    }
}
