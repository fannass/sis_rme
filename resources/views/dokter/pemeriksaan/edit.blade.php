<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pemeriksaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dokter.pemeriksaan.update', $pemeriksaan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tanggal Kunjungan -->
                            <div>
                                <x-input-label for="tanggal_kunjungan" value="Tanggal Kunjungan" />
                                <x-text-input id="tanggal_kunjungan" type="datetime-local" name="tanggal_kunjungan" 
                                    value="{{ old('tanggal_kunjungan', $pemeriksaan->tanggal_kunjungan->format('Y-m-d\TH:i')) }}"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('tanggal_kunjungan')" class="mt-2" />
                            </div>

                            <!-- Berat Badan -->
                            <div>
                                <x-input-label for="berat_badan" value="Berat Badan (kg)" />
                                <x-text-input id="berat_badan" type="number" step="0.1" name="berat_badan" 
                                    value="{{ old('berat_badan', $pemeriksaan->berat_badan) }}"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('berat_badan')" class="mt-2" />
                            </div>

                            <!-- Tinggi Badan -->
                            <div>
                                <x-input-label for="tinggi_badan" value="Tinggi Badan (cm)" />
                                <x-text-input id="tinggi_badan" type="number" step="0.1" name="tinggi_badan" 
                                    value="{{ old('tinggi_badan', $pemeriksaan->tinggi_badan) }}"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('tinggi_badan')" class="mt-2" />
                            </div>

                            <!-- Tekanan Darah -->
                            <div>
                                <x-input-label for="tekanan_darah" value="Tekanan Darah (mmHg)" />
                                <x-text-input id="tekanan_darah" type="text" name="tekanan_darah" 
                                    value="{{ old('tekanan_darah', $pemeriksaan->tekanan_darah) }}"
                                    placeholder="120/80"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('tekanan_darah')" class="mt-2" />
                            </div>

                            <!-- Detak Jantung -->
                            <div>
                                <x-input-label for="detak_jantung" value="Detak Jantung (bpm)" />
                                <x-text-input id="detak_jantung" type="number" name="detak_jantung" 
                                    value="{{ old('detak_jantung', $pemeriksaan->detak_jantung) }}"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('detak_jantung')" class="mt-2" />
                            </div>

                            <!-- Suhu Tubuh -->
                            <div>
                                <x-input-label for="suhu_tubuh" value="Suhu Tubuh (°C)" />
                                <x-text-input id="suhu_tubuh" type="number" step="0.1" name="suhu_tubuh" 
                                    value="{{ old('suhu_tubuh', $pemeriksaan->suhu_tubuh) }}"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('suhu_tubuh')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Riwayat Penyakit -->
                        <div class="mt-6">
                            <x-input-label for="riwayat_penyakit" value="Riwayat Penyakit" />
                            <textarea id="riwayat_penyakit" name="riwayat_penyakit" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('riwayat_penyakit', $pemeriksaan->riwayat_penyakit) }}</textarea>
                            <x-input-error :messages="$errors->get('riwayat_penyakit')" class="mt-2" />
                        </div>

                        <!-- Keluhan -->
                        <div class="mt-6">
                            <x-input-label for="keluhan" value="Keluhan" />
                            <textarea id="keluhan" name="keluhan" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('keluhan', $pemeriksaan->keluhan) }}</textarea>
                            <x-input-error :messages="$errors->get('keluhan')" class="mt-2" />
                        </div>

                        <!-- Diagnosis -->
                        <div class="mt-6">
                            <x-input-label for="diagnosis" value="Diagnosis" />
                            <textarea id="diagnosis" name="diagnosis" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('diagnosis', $pemeriksaan->diagnosis) }}</textarea>
                            <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                        </div>

                        <!-- Resep Obat -->
                        <div class="mt-6">
                            <x-input-label for="resep_obat" value="Resep Obat" />
                            <textarea id="resep_obat" name="resep_obat" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('resep_obat', $pemeriksaan->resep_obat) }}</textarea>
                            <x-input-error :messages="$errors->get('resep_obat')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button onclick="window.history.back()" type="button" class="mr-3">
                                Batal
                            </x-secondary-button>
                            <x-primary-button>
                                Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 