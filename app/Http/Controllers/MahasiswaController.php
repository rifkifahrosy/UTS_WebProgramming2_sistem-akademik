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
}
