<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePraktikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string']
        ];
    }
} 