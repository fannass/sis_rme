<x-guest-layout>
    <div class="text-center mb-6">
        <!-- Logo dari CDN Lordicon - Animasi Modern -->
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
        <lord-icon
            src="https://cdn.lordicon.com/dxjqoygy.json"
            trigger="loop"
            delay="2000"
            colors="primary:#e53e3e,secondary:#f56565"
            style="width:64px;height:64px" class="mx-auto">
        </lord-icon>

        <h1 class="text-xl font-semibold text-gray-800 mt-3">Selamat Datang</h1>
        <p class="text-gray-500 text-xs mt-1">Silahkan masuk ke akun anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <div class="relative">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <i class="ri-mail-line text-gray-400"></i>
                </div>
                <x-text-input id="email" 
                    class="input-field block w-full pl-10 pr-4 py-2 rounded-lg text-gray-600 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    placeholder="Email"
                    required 
                    autofocus />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <div class="relative">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <i class="ri-lock-line text-gray-400"></i>
                </div>
                <x-text-input id="password" 
                    class="input-field block w-full pl-10 pr-4 py-2 rounded-lg text-gray-600 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs pt-1">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-red-500 shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                    name="remember">
                <span class="ml-2 text-gray-600">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-red-500 hover:text-red-600" 
                   href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" 
                class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Masuk ke Akun
            </button>
        </div>
    </form>
</x-guest-layout>
