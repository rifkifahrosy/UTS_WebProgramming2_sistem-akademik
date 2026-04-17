<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JurusanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_jurusan' => 'required|string|max:100',
            'akreditasi'   => 'required|string|in:Unggul,Baik Sekali,Baik',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.max'      => 'Nama jurusan maksimal 100 karakter.',
            'akreditasi.required'   => 'Akreditasi wajib dipilih.',
            'akreditasi.in'         => 'Akreditasi harus salah satu dari: Unggul, Baik Sekali, Baik.',
        ];
    }
}
