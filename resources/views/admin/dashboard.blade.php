<x-app-layout>
    <!-- Include CDN Resources -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="mb-6 animate__animated animate__fadeIn">
                <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-xl p-6 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-lg sm:text-xl font-semibold mb-2">Selamat Datang di Dashboard Admin</h3>
                        <p class="text-red-100 text-sm sm:text-base">
                            Anda dapat mengelola data praktik dan dokter melalui menu di atas.
                        </p>
                    </div>
                    <div class="absolute right-0 top-0 h-full w-1/3 transform translate-x-1/3">
                        <svg class="h-full opacity-10" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50C100 77.6142 77.6142 100 50 100C22.3858 100 0 77.6142 0 50C0 22.3858 22.3858 0 50 0C77.6142 0 100 22.3858 100 50Z" fill="white"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
                <!-- Total Praktik Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-red-50 rounded-lg">
                            <i class="ri-hospital-line text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Praktik</p>
                            <h4 class="mt-1 text-2xl font-bold text-gray-800">{{ $totalPraktik ?? 0 }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Total Dokter Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-red-50 rounded-lg">
                            <i class="ri-user-heart-line text-2xl text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Dokter</p>
                            <h4 class="mt-1 text-2xl font-bold text-gray-800">{{ $totalDokter ?? 0 }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="sm:col-span-2 bg-white rounded-xl border border-gray-200 p-6 animate__animated animate__fadeInUp animate__delay-3s">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('admin.praktik.create') }}" 
                            class="flex items-center justify-center p-3 bg-red-50 rounded-lg text-red-600 hover:bg-red-100 transition-all group">
                            <i class="ri-add-line mr-2 group-hover:rotate-90 transition-transform"></i>
                            <span class="text-sm font-medium">Tambah Praktik</span>
                        </a>
                        <a href="{{ route('admin.dokter.create') }}" 
                            class="flex items-center justify-center p-3 bg-red-50 rounded-lg text-red-600 hover:bg-red-100 transition-all group">
                            <i class="ri-user-add-line mr-2 group-hover:scale-110 transition-transform"></i>
                            <span class="text-sm font-medium">Tambah Dokter</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 animate__animated animate__fadeInUp animate__delay-4s">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-lg font-semibold text-gray-800">Aktivitas Terkini</h4>
                    <span class="px-3 py-1 text-xs font-medium text-red-600 bg-red-100 rounded-full">Hari Ini</span>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center text-sm text-gray-600 hover:bg-gray-50 p-3 rounded-lg transition-colors">
                        <i class="ri-time-line mr-3 text-lg text-gray-400"></i>
                        <div>
                            <p class="font-medium text-gray-700">Sistem siap digunakan</p>
                            <p class="text-xs text-gray-500 mt-1">Beberapa saat yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Add custom script for interactions -->
    <script>
        // Add any custom JavaScript here if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Example: Add hover effect to cards
            const cards = document.querySelectorAll('.hover\\:shadow-lg');
            cards.forEach(card => {
                card.addEventListener('mouseover', () => {
                    card.classList.add('transform', 'scale-105');
                });
                card.addEventListener('mouseout', () => {
                    card.classList.remove('transform', 'scale-105');
                });
            });
        });
    </script>
</x-app-layout> 