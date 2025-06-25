<x-app-layout>
    <!-- Include CDN Resources -->
    <link href="https://cdn.lordicon.com/lordicon.js" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="mb-6 animate__animated animate__fadeIn">
                <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-2xl p-8 text-white relative overflow-hidden shadow-xl">
                    <div class="relative z-10">
                        <div class="flex items-center mb-4">
                            <lord-icon
                                src="https://cdn.lordicon.com/xqgancly.json"
                                trigger="loop"
                                delay="2000"
                                colors="primary:#ffffff,secondary:#ffffff"
                                style="width:48px;height:48px;">
                            </lord-icon>
                            <h3 class="text-2xl sm:text-3xl font-bold ml-3">Selamat Datang, Dr. {{ Auth::user()->name }}</h3>
                        </div>
                        <p class="text-red-100 text-base sm:text-lg max-w-2xl">
                            Selamat datang di sistem manajemen praktik dokter. Kelola data pasien dan pemeriksaan Anda dengan mudah melalui dashboard ini.
                        </p>
                    </div>
                    <div class="absolute right-0 top-0 h-full w-1/3 transform translate-x-1/3">
                        <svg class="h-full w-full opacity-10" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Pasien Card -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 animate__animated animate__fadeInUp animate__delay-1s group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-4 bg-red-50 rounded-lg group-hover:bg-red-100 transition-colors">
                            <i class="ri-user-heart-line text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-5">
                            <h4 class="mt-1 text-3xl font-bold text-gray-800">{{ $totalPasien ?? 0 }}</h4>
                            <p class="text-sm font-medium text-gray-600">Total Pasien</p>
                        </div>
                    </div>
                </div>

                <!-- Pemeriksaan Hari Ini Card -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 animate__animated animate__fadeInUp animate__delay-2s group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-4 bg-red-50 rounded-lg group-hover:bg-red-100 transition-colors">
                            <i class="ri-stethoscope-line text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-5">
                            <h4 class="mt-1 text-3xl font-bold text-gray-800">{{ $pemeriksaanHariIni ?? 0 }}</h4>
                            <p class="text-sm font-medium text-gray-600">Pemeriksaan Hari Ini</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pemeriksaan Card -->
                <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 animate__animated animate__fadeInUp animate__delay-3s group">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-4 bg-red-50 rounded-lg group-hover:bg-red-100 transition-colors">
                            <i class="ri-file-list-3-line text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-5">
                            <h4 class="mt-1 text-3xl font-bold text-gray-800">{{ $totalPemeriksaan ?? 0 }}</h4>
                            <p class="text-sm font-medium text-gray-600">Total Pemeriksaan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Pemeriksaan Terbaru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <i class="ri-stethoscope-line text-xl text-red-500 mr-2"></i>
                                <h3 class="text-lg font-semibold text-gray-800">Pemeriksaan Terbaru</h3>
                            </div>
                            <a href="{{ route('dokter.pemeriksaan.index') }}" class="text-red-500 hover:text-red-600 text-sm font-medium">
                                Lihat Semua <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>

                        @if(isset($pemeriksaanTerbaru) && $pemeriksaanTerbaru instanceof \Illuminate\Support\Collection && $pemeriksaanTerbaru->count() > 0)
                            <div class="space-y-4">
                                @foreach($pemeriksaanTerbaru as $pemeriksaan)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $pemeriksaan->pasien->nama }}</h4>
                                            <p class="text-sm text-gray-500">{{ $pemeriksaan->tanggal_kunjungan->format('d/m/Y') }}</p>
                                        </div>
                                        <a href="{{ route('dokter.pemeriksaan.show', $pemeriksaan) }}" 
                                           class="text-blue-500 hover:text-blue-600">
                                            <i class="ri-eye-line text-lg"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="ri-file-list-3-line text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Belum ada pemeriksaan terbaru</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pasien Terbaru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <i class="ri-user-heart-line text-xl text-red-500 mr-2"></i>
                                <h3 class="text-lg font-semibold text-gray-800">Pasien Terbaru</h3>
                            </div>
                            <a href="{{ route('dokter.pasien.index') }}" class="text-red-500 hover:text-red-600 text-sm font-medium">
                                Lihat Semua <i class="ri-arrow-right-line ml-1"></i>
                            </a>
                        </div>

                        @if(isset($pasienTerbaru) && $pasienTerbaru instanceof \Illuminate\Support\Collection && $pasienTerbaru->count() > 0)
                            <div class="space-y-4">
                                @foreach($pasienTerbaru as $pasien)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                                <span class="text-red-600 font-medium">
                                                    {{ strtoupper(substr($pasien->nama, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $pasien->nama }}</h4>
                                                <p class="text-sm text-gray-500">
                                                    @php
                                                        $umur = $pasien->tanggal_lahir ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->age : 0;
                                                        $umur = $umur < 0 ? 0 : $umur;
                                                    @endphp
                                                    {{ $umur }} tahun
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ route('dokter.pasien.show', $pasien) }}" 
                                           class="text-blue-500 hover:text-blue-600">
                                            <i class="ri-eye-line text-lg"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="ri-user-search-line text-5xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Belum ada pasien terbaru</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-2 gap-6 animate__animated animate__fadeInUp animate__delay-6s">
                <a href="{{ route('dokter.pemeriksaan.create') }}" 
                   class="group bg-white rounded-xl border border-gray-100 p-6 hover:shadow-xl hover:border-red-100 transition-all duration-300">
                    <div class="flex flex-col items-center text-center">
                        <span class="p-4 bg-red-50 rounded-full text-red-600 group-hover:bg-red-100 transition-colors mb-4">
                            <i class="ri-add-line text-2xl"></i>
                        </span>
                        <span class="text-base font-semibold text-gray-800 group-hover:text-red-600 transition-colors">Pemeriksaan Baru</span>
                        <p class="mt-2 text-sm text-gray-500">Buat pemeriksaan baru untuk pasien</p>
                    </div>
                </a>

                <a href="{{ route('dokter.pasien.create') }}"
                   class="group bg-white rounded-xl border border-gray-100 p-6 hover:shadow-xl hover:border-red-100 transition-all duration-300">
                    <div class="flex flex-col items-center text-center">
                        <span class="p-4 bg-red-50 rounded-full text-red-600 group-hover:bg-red-100 transition-colors mb-4">
                            <i class="ri-user-add-line text-2xl"></i>
                        </span>
                        <span class="text-base font-semibold text-gray-800 group-hover:text-red-600 transition-colors">Tambah Pasien</span>
                        <p class="mt-2 text-sm text-gray-500">Daftarkan pasien baru ke sistem</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi hover untuk cards
            const cards = document.querySelectorAll('.hover\\:shadow-xl');
            cards.forEach(card => {
                card.addEventListener('mouseover', () => {
                    card.classList.add('transform', 'scale-[1.02]');
                });
                card.addEventListener('mouseout', () => {
                    card.classList.remove('transform', 'scale-[1.02]');
                });
            });
        });
    </script>
    @endpush
</x-app-layout>