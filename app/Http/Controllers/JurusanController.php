<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Http\Requests\JurusanRequest;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jurusan = Jurusan::withCount(['mahasiswa', 'matakuliah'])
            ->when($search, function ($query, $search) {
                $query->where('nama_jurusan', 'like', "%{$search}%")
                    ->orWhere('akreditasi', 'like', "%{$search}%");
            })
            ->orderBy('nama_jurusan')
            ->paginate(10)
            ->withQueryString();

        return view('jurusan.index', compact('jurusan', 'search'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(JurusanRequest $request)
    {
        Jurusan::create($request->validated());
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(JurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update($request->validated());
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}
