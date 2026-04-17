<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            ['nama_jurusan' => 'Teknik Informatika', 'akreditasi' => 'Unggul'],
            ['nama_jurusan' => 'Teknik Industri', 'akreditasi' => 'Baik'],
            ['nama_jurusan' => 'Teknik Elektro', 'akreditasi' => 'Baik Sekali'],
            ['nama_jurusan' => 'DKV', 'akreditasi' => 'Baik Sekali'],
            ['nama_jurusan' => 'Bisnis Digital', 'akreditasi' => 'Baik'],
            ['nama_jurusan' => 'Ilmu Komunikasi', 'akreditasi' => 'Baik'],
            ['nama_jurusan' => 'Teknik Sipil', 'akreditasi' => 'Unggul'],

        ];

        foreach ($jurusan as $j) {
            Jurusan::create($j);
        }
    }
}
