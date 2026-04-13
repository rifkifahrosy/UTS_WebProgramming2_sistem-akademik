<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;
use App\Models\Jurusan;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = Jurusan::all();

        $matakuliahData = [
            ['nama_matakuliah' => 'Algoritma & Pemrograman',   'sks' => 3],
            ['nama_matakuliah' => 'Basis Data',                'sks' => 3],
            ['nama_matakuliah' => 'Jaringan Komputer',         'sks' => 3],
            ['nama_matakuliah' => 'Pemrograman Web',           'sks' => 3],
            ['nama_matakuliah' => 'Kecerdasan Buatan',         'sks' => 3],
            ['nama_matakuliah' => 'Sistem Operasi',            'sks' => 2],
            ['nama_matakuliah' => 'Rekayasa Perangkat Lunak',  'sks' => 3],
            ['nama_matakuliah' => 'Matematika Diskrit',        'sks' => 3],
            ['nama_matakuliah' => 'Manajemen Proyek IT',       'sks' => 2],
            ['nama_matakuliah' => 'Keamanan Informasi',        'sks' => 3],
            ['nama_matakuliah' => 'Akuntansi Dasar',           'sks' => 3],
            ['nama_matakuliah' => 'Manajemen Keuangan',        'sks' => 3],
            ['nama_matakuliah' => 'Statistika Bisnis',         'sks' => 3],
            ['nama_matakuliah' => 'Teknik Tegangan Tinggi',    'sks' => 3],
            ['nama_matakuliah' => 'Mekanika Teknik',           'sks' => 3],
        ];

        foreach ($matakuliahData as $index => $mk) {
            Matakuliah::create([
                'nama_matakuliah' => $mk['nama_matakuliah'],
                'sks'             => $mk['sks'],
                'id_jurusan'      => $jurusan[$index % $jurusan->count()]->id_jurusan,
            ]);
        }
    }
}
