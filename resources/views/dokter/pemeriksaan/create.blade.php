<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Tambah Pemeriksaan Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dokter.pemeriksaan.store') }}">
                        @csrf
                        
                        <!-- Pilih Pasien -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Pasien <span class="text-red-500">*</span>
                            </label>
                            <select name="pasien_no_rekam_medis" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="">Pilih Pasien</option>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->no_rekam_medis }}" {{ old('pasien_no_rekam_medis') == $pasien->no_rekam_medis ? 'selected' : '' }}>
                                        {{ $pasien->nama }} - {{ $pasien->no_rekam_medis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal Kunjungan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Tanggal Kunjungan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}" 
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Berat Badan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Berat Badan (kg) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="berat_badan" value="{{ old('berat_badan') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Tinggi Badan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Tinggi Badan (cm) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="tinggi_badan" value="{{ old('tinggi_badan') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Tekanan Darah -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Tekanan Darah (systolic/diastolic) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="tekanan_darah" value="{{ old('tekanan_darah') }}"
                                placeholder="120/80" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Detak Jantung -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Detak Jantung (bpm) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="detak_jantung" value="{{ old('detak_jantung') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Suhu Tubuh -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Suhu Tubuh (°C) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.1" name="suhu_tubuh" value="{{ old('suhu_tubuh') }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                        </div>

                        <!-- Riwayat Penyakit -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Riwayat Penyakit
                            </label>
                            <textarea name="riwayat_penyakit" class="form-textarea rounded-md shadow-sm mt-1 block w-full" 
                                rows="3">{{ old('riwayat_penyakit') }}</textarea>
                        </div>

                        <!-- Keluhan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Keluhan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="keluhan" class="form-textarea rounded-md shadow-sm mt-1 block w-full" 
                                rows="3" required>{{ old('keluhan') }}</textarea>
                        </div>

                        <!-- Diagnosis -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Diagnosis <span class="text-red-500">*</span>
                            </label>
                            <textarea name="diagnosis" class="form-textarea rounded-md shadow-sm mt-1 block w-full" 
                                rows="3" required>{{ old('diagnosis') }}</textarea>
                        </div>

                        <!-- Resep Obat -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Resep Obat
                            </label>
                            <textarea name="resep_obat" class="form-textarea rounded-md shadow-sm mt-1 block w-full" 
                                rows="3">{{ old('resep_obat') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan Pemeriksaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>