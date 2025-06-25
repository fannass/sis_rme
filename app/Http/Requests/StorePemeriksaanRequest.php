<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemeriksaanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pasien_id' => ['required', 'exists:pasiens,id'],
            'keluhan' => ['required', 'string'],
            'diagnosis' => ['required', 'string'],
            'tindakan' => ['required', 'string'],
            'resep' => ['nullable', 'string'],
            'catatan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'pasien_id.required' => 'Pasien harus dipilih',
            'pasien_id.exists' => 'Pasien tidak ditemukan',
            'keluhan.required' => 'Keluhan harus diisi',
            'diagnosis.required' => 'Diagnosis harus diisi',
            'tindakan.required' => 'Tindakan harus diisi',
        ];
    }
} 