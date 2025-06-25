<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePraktikRequest;
use App\Http\Requests\UpdatePraktikRequest;
use App\Models\Praktik;
use Illuminate\Http\Request;

class PraktikController extends Controller
{
    public function index()
    {
        $praktiks = Praktik::latest()->paginate(10);
        return view('admin.praktik.index', compact('praktiks'));
    }

    public function create()
    {
        return view('admin.praktik.create');
    }

    public function store(Request $request)
    {
        // Debug: Lihat semua data yang diterima
        \Log::info('Semua request data:', $request->all());

        // Validasi dengan required untuk nama_praktik
        $validated = $request->validate([
            'nama_praktik' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'kota' => 'nullable|string',
        ]);

        try {
            $praktik = Praktik::create($validated);
            
            return redirect()
                ->route('admin.praktik.index')
                ->with('success', 'Praktik berhasil ditambahkan');
        } catch (\Exception $e) {
            \Log::error('Error saat membuat praktik:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambah praktik');
        }
    }

    public function edit(Praktik $praktik)
    {
        return view('admin.praktik.edit', compact('praktik'));
    }

    public function update(UpdatePraktikRequest $request, Praktik $praktik)
    {
        $praktik->update($request->validated());

        return redirect()
            ->route('admin.praktik.index')
            ->with('success', 'Data praktik berhasil diperbarui');
    }

    public function destroy(Praktik $praktik)
    {
        $praktik->delete();

        return redirect()
            ->route('admin.praktik.index')
            ->with('success', 'Data praktik berhasil dihapus');
    }
}
