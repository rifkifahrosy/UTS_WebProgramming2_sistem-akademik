<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            ['nama_jurusan' => 'Teknik Informatika',      'akreditasi' => 'Unggul'],
            ['nama_jurusan' => 'Sistem Informasi',        'akreditasi' => 'A'],
            ['nama_jurusan' => 'Teknik Elektro',          'akreditasi' => 'Baik Sekali'],
            ['nama_jurusan' => 'Manajemen',               'akreditasi' => 'A'],
            ['nama_jurusan' => 'Akuntansi',               'akreditasi' => 'B'],
            ['nama_jurusan' => 'Ilmu Komunikasi',         'akreditasi' => 'Baik'],
            ['nama_jurusan' => 'Teknik Sipil',            'akreditasi' => 'B'],
            ['nama_jurusan' => 'Pendidikan Matematika',   'akreditasi' => 'A'],
        ];

        foreach ($jurusan as $j) {
            Jurusan::create($j);
        }
    }
}
