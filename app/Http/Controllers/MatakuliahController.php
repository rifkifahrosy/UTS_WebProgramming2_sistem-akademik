<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Jurusan;
use App\Http\Requests\MatakuliahRequest;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'nama_matakuliah');
        $sortOrder = $request->input('order', 'asc');

        $matakuliah = Matakuliah::with('jurusan')
            ->when($search, function ($query, $search) {
                $query->where('nama_matakuliah', 'like', "%{$search}%")
                    ->orWhere('sks', 'like', "%{$search}%")
                    ->orWhereHas('jurusan', function ($q) use ($search) {
                        $q->where('nama_jurusan', 'like', "%{$search}%");
                    });
            })
            ->when($sortBy === 'jurusan', function ($query) use ($sortOrder) {
                $query->join('jurusan', 'matakuliah.id_jurusan', '=', 'jurusan.id_jurusan')
                    ->orderBy('jurusan.nama_jurusan', $sortOrder)
                    ->select('matakuliah.*');
            }, function ($query) use ($sortBy, $sortOrder) {
                $query->orderBy($sortBy, $sortOrder);
            })
            ->paginate(10)
            ->withQueryString();

        return view('matakuliah.index', compact('matakuliah', 'search', 'sortBy', 'sortOrder'));
    }

    public function create()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('matakuliah.create', compact('jurusan'));
    }

    public function store(MatakuliahRequest $request)
    {
        Matakuliah::create($request->validated());
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(Matakuliah $matakuliah)
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('matakuliah.edit', compact('matakuliah', 'jurusan'));
    }

    public function update(MatakuliahRequest $request, Matakuliah $matakuliah)
    {
        $matakuliah->update($request->validated());
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
