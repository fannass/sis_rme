<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Praktik;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')
            ->with(['dokter.praktik'])
            ->latest()
            ->paginate(10);
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $praktiks = Praktik::all();
        return view('admin.dokter.create', compact('praktiks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'praktik_id' => 'required|exists:praktiks,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_telpon' => 'required|string|max:20',
            'spesialis' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::beginTransaction();
            
            // Buat user terlebih dahulu
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'dokter',
            ]);

            // Buat data dokter yang terhubung dengan user
            Dokter::create([
                'user_id' => $user->id,
                'praktik_id' => $validated['praktik_id'],
                'nama' => $validated['name'],
                'no_telpon' => $validated['no_telpon'],
            ]);

            DB::commit();
            
            return redirect()
                ->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat membuat dokter:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menambah dokter: ' . $e->getMessage()]);
        }
    }

    public function edit(User $dokter)
    {
        $praktiks = Praktik::all();
        return view('admin.dokter.edit', compact('dokter', 'praktiks'));
    }

    public function update(Request $request, User $dokter)
    {
        $rules = [
            'praktik_id' => 'required|exists:praktiks,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $dokter->id,
            'no_telpon' => 'required|string|max:20',
            'spesialis' => 'nullable|string|max:255',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();
            
            // Update user
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $dokter->update($userData);

            // Update atau buat data dokter
            $dokter->dokter()->updateOrCreate(
                ['user_id' => $dokter->id],
                [
                    'praktik_id' => $validated['praktik_id'],
                    'nama' => $validated['name'],
                    'no_telpon' => $validated['no_telpon'],
                ]
            );

            DB::commit();
            
            return redirect()
                ->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil diperbarui');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat update dokter:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui dokter']);
        }
    }

    public function destroy(User $dokter)
    {
        try {
            DB::beginTransaction();
            
            $dokter->dokter()->delete();
            $dokter->delete();
            
            DB::commit();
            
            return redirect()
                ->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil dihapus');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat menghapus dokter:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus dokter']);
        }
    }
} 