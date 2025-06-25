<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.dokter.update', $dokter) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-input-label for="praktik_id" :value="__('Tempat Praktik')" />
                            <select id="praktik_id" 
                                    name="praktik_id" 
                                    class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                <option value="">Pilih Tempat Praktik</option>
                                @foreach($praktiks as $praktik)
                                    <option value="{{ $praktik->id }}" {{ old('praktik_id', $dokter->praktik_id) == $praktik->id ? 'selected' : '' }}>
                                        {{ $praktik->nama_praktik }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('praktik_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Dokter')" />
                            <x-text-input id="name" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="name" 
                                         :value="old('name', $dokter->name)" 
                                         required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_telpon" :value="__('Nomor Telepon')" />
                            <x-text-input id="no_telpon" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="no_telpon" 
                                         :value="old('no_telpon', $dokter->no_telpon)" 
                                         required />
                            <x-input-error :messages="$errors->get('no_telpon')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="spesialis" :value="__('Spesialis')" />
                            <x-text-input id="spesialis" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="spesialis" 
                                         :value="old('spesialis', $dokter->spesialis)" />
                            <x-input-error :messages="$errors->get('spesialis')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" 
                                         class="block mt-1 w-full" 
                                         type="email" 
                                         name="email" 
                                         :value="old('email', $dokter->email)" 
                                         required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password Baru (opsional)')" />
                            <x-text-input id="password" 
                                         class="block mt-1 w-full"
                                         type="password"
                                         name="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="password_confirmation" 
                                         class="block mt-1 w-full"
                                         type="password"
                                         name="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('admin.dokter.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 