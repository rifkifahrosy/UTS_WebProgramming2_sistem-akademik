<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mahasiswa = $this->route('mahasiswa');
        $mahasiswaId = $mahasiswa ? $mahasiswa->id_mahasiswa : null;

        return [
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $mahasiswaId . ',id_mahasiswa',
            'nama' => 'required|string|max:100',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
        ];
    }

    public function messages(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah terdaftar, gunakan NIM yang lain.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'nama.max' => 'Nama mahasiswa maksimal 100 karakter.',
            'id_jurusan.required' => 'Jurusan wajib dipilih.',
            'id_jurusan.exists' => 'Jurusan yang dipilih tidak valid.',
        ];
    }
}
