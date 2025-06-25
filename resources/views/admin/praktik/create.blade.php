<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Praktik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.praktik.store') }}" class="space-y-4">
                        @csrf
                        
                        <div class="mb-4">
                            <x-input-label for="nama_praktik" :value="__('Nama Praktik')" />
                            <x-text-input id="nama_praktik" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="nama_praktik" 
                                         :value="old('nama_praktik')" 
                                         required />
                            <x-input-error :messages="$errors->get('nama_praktik')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <textarea id="alamat" 
                                      name="alamat" 
                                      rows="3" 
                                      class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="telepon" :value="__('Telepon')" />
                            <x-text-input id="telepon" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="telepon" 
                                         :value="old('telepon')" />
                            <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="kota" :value="__('Kota')" />
                            <x-text-input id="kota" 
                                         class="block mt-1 w-full" 
                                         type="text" 
                                         name="kota" 
                                         :value="old('kota')" />
                            <x-input-error :messages="$errors->get('kota')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('admin.praktik.index') }}" 
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

@push('scripts')
<script>
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
@endpush 