<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJurusan    = Jurusan::count();
        $totalMahasiswa  = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();

        $jurusanList = Jurusan::withCount(['mahasiswa', 'matakuliah'])
            ->orderBy('nama_jurusan')
            ->get();

        return view('dashboard', compact(
            'totalJurusan',
            'totalMahasiswa',
            'totalMatakuliah',
            'jurusanList'
        ));
    }
}
