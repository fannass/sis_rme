<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pemeriksaan') }}
            </h2>
            <a href="{{ route('dokter.pemeriksaan.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-300">
                <i class="ri-arrow-left-line mr-2"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <!-- Data Pasien -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Pasien</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Nama Pasien</p>
                                <p class="font-medium">{{ $pemeriksaan->pasien->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">No. Rekam Medis</p>
                                <p class="font-medium">{{ $pemeriksaan->pasien->no_rekam_medis }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Jenis Kelamin</p>
                                <p class="font-medium">{{ $pemeriksaan->pasien->jenis_kelamin }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Lahir</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($pemeriksaan->pasien->tanggal_lahir)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pemeriksaan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Pemeriksaan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tanggal Pemeriksaan</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($pemeriksaan->tanggal_kunjungan)->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Berat Badan</p>
                                <p class="font-medium">{{ $pemeriksaan->berat_badan }} kg</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tinggi Badan</p>
                                <p class="font-medium">{{ $pemeriksaan->tinggi_badan }} cm</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tekanan Darah</p>
                                <p class="font-medium">{{ $pemeriksaan->tekanan_darah }} mmHg</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Detak Jantung</p>
                                <p class="font-medium">{{ $pemeriksaan->detak_jantung }} bpm</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Suhu Tubuh</p>
                                <p class="font-medium">{{ $pemeriksaan->suhu_tubuh }}°C</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Pemeriksaan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Hasil Pemeriksaan</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Keluhan</p>
                                <p class="font-medium">{{ $pemeriksaan->keluhan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Diagnosis</p>
                                <p class="font-medium">{{ $pemeriksaan->diagnosis }}</p>
                            </div>
                            @if($pemeriksaan->riwayat_penyakit)
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Riwayat Penyakit</p>
                                <p class="font-medium">{{ $pemeriksaan->riwayat_penyakit }}</p>
                            </div>
                            @endif
                            @if($pemeriksaan->resep_obat)
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Resep Obat</p>
                                <p class="font-medium">{{ $pemeriksaan->resep_obat }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('dokter.pemeriksaan.edit', $pemeriksaan->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-300">
                            <i class="ri-edit-line mr-2"></i>
                            Edit
                        </a>
                        <a href="{{ route('dokter.pemeriksaan.export-pdf', $pemeriksaan->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-300"
                           target="_blank">
                            <i class="ri-download-line mr-2"></i>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 