<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use App\Http\Requests\MahasiswaRequest;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'nama');
        $sortOrder = $request->input('order', 'asc');

        $mahasiswa = Mahasiswa::with('jurusan')
            ->when($search, function ($query, $search) {
                $query->where('nim', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhereHas('jurusan', function ($q) use ($search) {
                        $q->where('nama_jurusan', 'like', "%{$search}%");
                    });
            })
            ->when($sortBy === 'jurusan', function ($query) use ($sortOrder) {
                $query->join('jurusan', 'mahasiswa.id_jurusan', '=', 'jurusan.id_jurusan')
                    ->orderBy('jurusan.nama_jurusan', $sortOrder)
                    ->select('mahasiswa.*');
            }, function ($query) use ($sortBy, $sortOrder) {
                $query->orderBy($sortBy, $sortOrder);
            })
            ->paginate(10)
            ->withQueryString();

        return view('mahasiswa.index', compact('mahasiswa', 'search', 'sortBy', 'sortOrder'));
    }

    public function create()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('mahasiswa.create', compact('jurusan'));
    }

    public function store(MahasiswaRequest $request)
    {
        Mahasiswa::create($request->validated());
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusan'));
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validated());
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus.');
    }

    // PRINT CSV
    public function exportCsv()
    {
        $fileName = 'mahasiswa.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function () {

            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter UTF-8 terbaca baik di Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header kolom
            fputcsv($file, [
                'ID',
                'NIM',
                'Nama',
                'Jurusan'
            ], ';');

            $mahasiswa = Mahasiswa::with('jurusan')->orderBy('nim')->get();

            foreach ($mahasiswa as $item) {

                fputcsv($file, [
                    $item->id_mahasiswa,
                    $item->nim,
                    $item->nama,
                    $item->jurusan->nama_jurusan ?? '-',
                ], ';'); // delimiter titik koma
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // PRINT PDF
    public function print()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->orderBy('nim')->get();

        return view('mahasiswa.print', compact('mahasiswa'));
    }

    // PRINT EXCEL
    public function exportExcel()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->orderBy('nim')->get();

        return response()
            ->view('mahasiswa.excel', compact('mahasiswa'))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename=mahasiswa.xls');
    }

}
