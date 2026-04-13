@extends('layouts.app')

@section('title', 'Tambah Jurusan')
@section('page-title', 'Tambah Jurusan')
@section('page-subtitle', 'Isi form untuk menambah jurusan baru')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">
                    <i class="bi bi-building me-2" style="color:#4f46e5;"></i>Form Tambah Jurusan
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jurusan.store') }}" method="POST" id="formTambahJurusan">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                        <input type="text" id="nama_jurusan" name="nama_jurusan"
                               class="form-control @error('nama_jurusan') is-invalid @enderror"
                               value="{{ old('nama_jurusan') }}"
                               placeholder="Contoh: Teknik Informatika" required>
                        @error('nama_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="akreditasi" class="form-label">Akreditasi <span class="text-danger">*</span></label>
                        <select id="akreditasi" name="akreditasi"
                                class="form-select @error('akreditasi') is-invalid @enderror" required>
                            <option value="">— Pilih Akreditasi —</option>
                            @foreach(['Unggul', 'Baik Sekali', 'Baik', 'A', 'B', 'C'] as $ak)
                                <option value="{{ $ak }}" {{ old('akreditasi') == $ak ? 'selected' : '' }}>
                                    {{ $ak }}
                                </option>
                            @endforeach
                        </select>
                        @error('akreditasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" id="btn-simpan-jurusan"
                                class="btn text-white" style="background:#4f46e5;">
                            <i class="bi bi-check-lg me-1"></i> Simpan
                        </button>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
