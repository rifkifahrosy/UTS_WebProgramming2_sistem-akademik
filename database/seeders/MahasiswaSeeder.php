<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Jurusan;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $jurusanIds = Jurusan::pluck('id_jurusan')->toArray();

        $mahasiswaData = [
            ['nim' => '2021001', 'nama' => 'Andi Pratama'],
            ['nim' => '2021002', 'nama' => 'Budi Santoso'],
            ['nim' => '2021003', 'nama' => 'Citra Dewi'],
            ['nim' => '2021004', 'nama' => 'Dian Rahayu'],
            ['nim' => '2021005', 'nama' => 'Eko Saputra'],
            ['nim' => '2021006', 'nama' => 'Fira Natasya'],
            ['nim' => '2021007', 'nama' => 'Gilang Ramadhan'],
            ['nim' => '2021008', 'nama' => 'Hana Pertiwi'],
            ['nim' => '2021009', 'nama' => 'Irfan Maulana'],
            ['nim' => '2021010', 'nama' => 'Juwita Sari'],
            ['nim' => '2021011', 'nama' => 'Kevin Wijaya'],
            ['nim' => '2021012', 'nama' => 'Lina Marlina'],
            ['nim' => '2021013', 'nama' => 'Muhamad Rizki'],
            ['nim' => '2021014', 'nama' => 'Nadia Putri'],
            ['nim' => '2021015', 'nama' => 'Oscar Fernanda'],
        ];

        foreach ($mahasiswaData as $index => $m) {
            Mahasiswa::create([
                'nim'        => $m['nim'],
                'nama'       => $m['nama'],
                'id_jurusan' => $jurusanIds[$index % count($jurusanIds)],
            ]);
        }
    }
}
