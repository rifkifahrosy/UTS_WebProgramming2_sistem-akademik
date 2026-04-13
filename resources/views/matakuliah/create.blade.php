@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')
@section('page-title', 'Tambah Mata Kuliah')
@section('page-subtitle', 'Isi form untuk menambah mata kuliah baru')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">
                    <i class="bi bi-journal-plus me-2" style="color:#10b981;"></i>Form Tambah Mata Kuliah
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('matakuliah.store') }}" method="POST" id="formTambahMatakuliah">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_matakuliah" class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" id="nama_matakuliah" name="nama_matakuliah"
                               class="form-control @error('nama_matakuliah') is-invalid @enderror"
                               value="{{ old('nama_matakuliah') }}"
                               placeholder="Contoh: Algoritma & Pemrograman" required>
                        @error('nama_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="sks" class="form-label">SKS <span class="text-danger">*</span></label>
                        <select id="sks" name="sks"
                                class="form-select @error('sks') is-invalid @enderror" required>
                            <option value="">— Pilih SKS —</option>
                            @foreach([1, 2, 3, 4, 5, 6] as $s)
                                <option value="{{ $s }}" {{ old('sks') == $s ? 'selected' : '' }}>
                                    {{ $s }} SKS
                                </option>
                            @endforeach
                        </select>
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="id_jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
                        <select id="id_jurusan" name="id_jurusan"
                                class="form-select @error('id_jurusan') is-invalid @enderror" required>
                            <option value="">— Pilih Jurusan —</option>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id_jurusan }}"
                                    {{ old('id_jurusan') == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }} ({{ $j->akreditasi }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" id="btn-simpan-matakuliah"
                                class="btn text-white" style="background:#10b981;">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
