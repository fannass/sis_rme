<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Remix Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

        <!-- Alpine.js CDN -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div x-data="{ isOpen: true }" class="min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <aside :class="{ 'collapsed': !isOpen }" class="sidebar">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-lg">
                            <span class="text-xl font-bold text-white">R</span>
                        </div>
                        <div x-show="isOpen" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100">
                            <span class="text-xl font-bold text-gray-900">ekamMedis</span>
                        </div>
                    </div>
                    <!-- Toggle Button -->
                    <button @click="isOpen = !isOpen" 
                            class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition-transform duration-300"
                            :class="{ 'rotate-180': !isOpen }">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="px-4 py-6">
                    <ul class="space-y-2">
                        @if(auth()->user()->isAdmin())
                            <!-- Menu Admin -->
                            <li>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="ri-dashboard-line text-xl"></i>
                                    <span x-show="isOpen" class="nav-text">Dashboard</span>
                                </a>
                            </li>
                            <!-- Data Praktik -->
                            <li>
                                <a href="{{ route('admin.praktik.index') }}" 
                                   class="nav-item {{ request()->routeIs('admin.praktik.*') ? 'active' : '' }}">
                                    <i class="ri-hospital-line text-xl"></i>
                                    <span x-show="isOpen" class="nav-text">Data Praktik</span>
                                </a>
                            </li>
                            <!-- Data Dokter -->
                            <li>
                                <a href="{{ route('admin.dokter.index') }}" 
                                   class="nav-item {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                                    <i class="ri-user-heart-line text-xl"></i>
                                    <span x-show="isOpen" class="nav-text">Data Dokter</span>
                                </a>
                            </li>
                        @else
                            <!-- Menu Dokter -->
                            <li>
                                <a href="{{ route('dokter.dashboard') }}" 
                                   class="nav-item {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                                    <i class="ri-dashboard-line text-xl"></i>
                                    <span x-show="isOpen" class="nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dokter.pasien.index') }}" 
                                   class="nav-item {{ request()->routeIs('dokter.pasien.*') ? 'active' : '' }}">
                                    <i class="ri-group-line text-xl"></i>
                                    <span x-show="isOpen" class="nav-text">Data Pasien</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dokter.pemeriksaan.index') }}" 
                                   class="nav-item {{ request()->routeIs('dokter.pemeriksaan.*') ? 'active' : '' }}">
                                    <i class="ri-stethoscope-line text-xl"></i>
                                    <span x-show="isOpen" class="nav-text">Pemeriksaan</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </aside>

            <!-- Main Content -->
            <main :class="{ 'collapsed': !isOpen }" class="main-content">
                <!-- Navbar -->
                <nav class="main-navbar">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
                        <div class="flex justify-between items-center h-full">
                            <!-- Left Side - Only Title -->
                            <div class="flex items-center">
                                <h2 class="text-lg font-semibold text-gray-700">
                                    {{ $header ?? 'Dashboard' }}
                                </h2>
                            </div>

                            <!-- Right Side - Profile Dropdown -->
                            <div class="flex items-center">
                                <!-- Profile Dropdown -->
                                <div class="ml-3 relative">
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center text-white">
                                                        {{ substr(Auth::user()->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Dokter' }}</p>
                                                    </div>
                                                </div>
                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                                                <i class="ri-user-settings-line"></i>
                                                <span>{{ __('Profile') }}</span>
                                            </x-dropdown-link>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();" 
                                                    class="flex items-center space-x-2 text-red-600 hover:text-red-700">
                                                    <i class="ri-logout-box-line"></i>
                                                    <span>{{ __('Log Out') }}</span>
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Content Wrapper -->
                <div class="content-wrapper">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
