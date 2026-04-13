<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatakuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_matakuliah' => 'required|string|max:100',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusan,id_jurusan',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'nama_matakuliah.max'      => 'Nama mata kuliah maksimal 100 karakter.',
            'sks.required'             => 'SKS wajib diisi.',
            'sks.integer'              => 'SKS harus berupa angka.',
            'sks.min'                  => 'SKS minimal 1.',
            'sks.max'                  => 'SKS maksimal 6.',
            'id_jurusan.required'      => 'Jurusan wajib dipilih.',
            'id_jurusan.exists'        => 'Jurusan yang dipilih tidak valid.',
        ];
    }
}
