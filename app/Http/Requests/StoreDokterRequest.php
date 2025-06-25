<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'praktik_id' => ['required', 'exists:praktiks,id'],
            'nama' => ['required', 'string', 'max:255'],
            'no_telpon' => ['required', 'string', 'max:15'],
            'email' => ['required', 'email', 'unique:dokters,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }

    public function messages(): array
    {
        return [
            'praktik_id.required' => 'Tempat praktik harus dipilih',
            'praktik_id.exists' => 'Tempat praktik tidak valid',
            'nama.required' => 'Nama dokter harus diisi',
            'no_telpon.required' => 'Nomor telepon harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ];
    }
} 