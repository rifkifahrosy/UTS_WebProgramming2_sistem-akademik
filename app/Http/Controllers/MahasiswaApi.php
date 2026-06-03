<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaApi extends Controller
{
    // GET LIST DATA
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil',
            'result' => $mahasiswa
        ], 200);
    }

    // GET DATA BY ID
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('jurusan')->find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Detail data mahasiswa',
            'result' => $mahasiswa
        ], 200);
    }

    // CREATE DATA
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'nim' => 'required|string|unique:mahasiswa,nim',
        //     'nama' => 'required|string',
        //     'id_jurusan' => 'required|integer|exists:jurusan,id_jurusan'
        // ]);

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'status' => 201,
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'result' => $mahasiswa
        ], 201);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        // $validated = $request->validate([
        //     'nim' => 'required|string|unique:mahasiswa,nim,' . $id . ',id_mahasiswa',
        //     'nama' => 'required|string',
        //     'id_jurusan' => 'required|integer|exists:jurusan,id_jurusan'
        // ]);

        $mahasiswa->update($request->all());

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil diupdate',
            'result' => $mahasiswa
        ], 200);
    }

    // DELETE DATA
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ], 200);
    }
}
