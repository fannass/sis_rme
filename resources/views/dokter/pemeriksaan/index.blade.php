<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Pemeriksaan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-red-50 rounded-lg">
                            <i class="ri-stethoscope-line text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pemeriksaan</p>
                            <h4 class="mt-1 text-2xl font-bold text-gray-800">{{ $totalPemeriksaan ?? $pemeriksaans->total() }}</h4>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-green-50 rounded-lg">
                            <i class="ri-calendar-check-line text-2xl text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Pemeriksaan Hari Ini</p>
                            <h4 class="mt-1 text-2xl font-bold text-gray-800">{{ $pemeriksaanHariIni ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-blue-50 rounded-lg">
                            <i class="ri-user-heart-line text-2xl text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Pasien</p>
                            <h4 class="mt-1 text-2xl font-bold text-gray-800">{{ $totalPasien ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-6">
                    <!-- Search, Filter, and Add Button Section -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                        <form method="GET" action="{{ route('dokter.pemeriksaan.index') }}" class="flex flex-col sm:flex-row gap-4 flex-grow">
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           class="w-full pl-10 pr-4 py-2 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm text-sm" 
                                           placeholder="Cari berdasarkan nama pasien...">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="ri-search-line text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:w-48">
                                <input type="date" 
                                       name="tanggal" 
                                       value="{{ request('tanggal') }}"
                                       class="w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm text-sm">
                            </div>
                            <div class="sm:w-32">
                                <button type="submit" 
                                        class="w-full bg-red-100 text-red-600 px-4 py-2 rounded-lg font-medium text-sm hover:bg-red-200 transition-colors duration-300">
                                    <i class="ri-filter-3-line mr-2"></i>
                                    Filter
                                </button>
                            </div>
                        </form>
                        
                        <div class="w-full sm:w-auto">
                            <a href="{{ route('dokter.pemeriksaan.create') }}" 
                               class="flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-300 w-full sm:w-auto">
                                <i class="ri-add-line mr-2"></i>
                                Pemeriksaan Baru
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg relative animate__animated animate__fadeIn">
                            <div class="flex items-center">
                                <i class="ri-checkbox-circle-line mr-2 text-green-500 text-xl"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Table Section -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keluhan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pemeriksaans as $pemeriksaan)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($pemeriksaan->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <span class="text-red-600 font-medium">
                                                            {{ strtoupper(substr($pemeriksaan->pasien->nama, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $pemeriksaan->pasien->nama }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        {{ $pemeriksaan->pasien->no_rekam_medis }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $pemeriksaan->keluhan }}">
                                                {{ $pemeriksaan->keluhan }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $pemeriksaan->diagnosa }}">
                                                {{ $pemeriksaan->diagnosa }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $pemeriksaan->tindakan }}">
                                                {{ $pemeriksaan->tindakan }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('dokter.pemeriksaan.show', $pemeriksaan->id) }}" 
                                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                                   title="Lihat Detail">
                                                    <i class="ri-eye-line text-lg"></i>
                                                </a>
                                                
                                                <a href="{{ route('dokter.pemeriksaan.edit', $pemeriksaan->id) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200"
                                                   title="Edit">
                                                    <i class="ri-edit-line text-lg"></i>
                                                </a>

                                                <a href="{{ route('dokter.pemeriksaan.export-pdf', $pemeriksaan->id) }}" 
                                                   class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                                   onclick="downloadPDF(event, this.href)"
                                                   title="Download PDF">
                                                    <i class="ri-file-download-line text-lg"></i>
                                                </a>

                                                <form action="{{ route('dokter.pemeriksaan.destroy', $pemeriksaan->id) }}" 
                                                      method="POST" 
                                                      class="inline-block"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                            title="Hapus">
                                                        <i class="ri-delete-bin-line text-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center py-8">
                                                <i class="ri-stethoscope-line text-6xl text-gray-300 mb-4"></i>
                                                <p class="text-gray-500 mb-1">Tidak ada data pemeriksaan</p>
                                                <p class="text-sm text-gray-400">Silakan tambah pemeriksaan baru</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pemeriksaans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function downloadPDF(event, url) {
        event.preventDefault();
        
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'rekam-medis.pdf';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengunduh PDF. Silakan coba lagi.');
            });
    }
    </script>
    @endpush
</x-app-layout> 