@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="nama" :value="__('Nama Lengkap')" />
        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $pasien->nama ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
    </div>

    <div>
        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
        <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', $pasien->tanggal_lahir?->format('Y-m-d') ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
    </div>

    <div>
        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
        <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-Laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
    </div>

    <div>
        <x-input-label for="no_telpon" :value="__('Nomor Telepon')" />
        <x-text-input id="no_telpon" name="no_telpon" type="text" class="mt-1 block w-full" :value="old('no_telpon', $pasien->no_telpon ?? '')" placeholder="Contoh: 08123456789" />
        <x-input-error class="mt-2" :messages="$errors->get('no_telpon')" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="alamat" :value="__('Alamat')" />
        <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
    </div>

    <div class="md:col-span-2 flex items-center gap-4">
        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
        <a href="{{ route('dokter.pasien.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            {{ __('Batal') }}
        </a>
    </div>
</div> 