<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Pasien::query();
        
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_telpon', 'like', "%{$search}%");
            });
        }
        
        // Filter berdasarkan jenis kelamin
        if ($request->has('jenis_kelamin') && $request->jenis_kelamin != '') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Hitung total berdasarkan jenis kelamin
        $totalLaki = Pasien::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Pasien::where('jenis_kelamin', 'Perempuan')->count();
        $totalPasien = Pasien::count();

        // Ambil data dengan pagination
        $pasiens = $query->latest()->paginate(10);
        
        // Jika ada filter, pertahankan query string di pagination
        if($request->has('search') || $request->has('jenis_kelamin')) {
            $pasiens->appends($request->all());
        }

        return view('dokter.pasien.index', compact('pasiens', 'totalLaki', 'totalPerempuan', 'totalPasien'));
    }

    public function create()
    {
        return view('dokter.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $age = Carbon::parse($value)->age;
                    if ($age < 0) {
                        $fail('Tanggal lahir tidak boleh lebih dari hari ini');
                    }
                    if ($age > 150) {
                        $fail('Umur terlalu tua (maksimal 150 tahun)');
                    }
                },
            ],
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'no_telpon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.max' => 'Nama lengkap maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-Laki atau Perempuan',
            'no_telpon.max' => 'Nomor telepon maksimal 15 karakter',
            'alamat.max' => 'Alamat maksimal 500 karakter'
        ]);

        DB::transaction(function() use ($request) {
            $pasien = new Pasien();
            $pasien->no_rekam_medis = Pasien::generateNoRekamMedis();
            $pasien->nama = $request->nama;
            $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->umur = now()->diffInYears($request->tanggal_lahir);
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->no_telpon = $request->no_telpon;
            $pasien->alamat = $request->alamat;
            $pasien->save();
        });

        return redirect()->route('dokter.pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan');
    }

    public function show(Pasien $pasien)
    {
        return view('dokter.pasien.show', compact('pasien'));
    }

    public function edit(Pasien $pasien)
    {
        return view('dokter.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'no_telpon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.max' => 'Nama lengkap maksimal 255 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-Laki atau Perempuan',
            'no_telpon.max' => 'Nomor telepon maksimal 15 karakter',
            'alamat.max' => 'Alamat maksimal 500 karakter'
        ]);

        DB::transaction(function() use ($request, $pasien) {
            $pasien->nama = $request->nama;
            $pasien->tanggal_lahir = $request->tanggal_lahir;
            $pasien->umur = now()->diffInYears($request->tanggal_lahir);
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->no_telpon = $request->no_telpon;
            $pasien->alamat = $request->alamat;
            $pasien->save();
        });

        return redirect()->route('dokter.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('dokter.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }
}
