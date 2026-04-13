@extends('layouts.app')

@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')
@section('page-subtitle', 'Perbarui data mahasiswa')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">
                    <i class="bi bi-pencil-square me-2" style="color:#0ea5e9;"></i>Edit Mahasiswa
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST" id="formEditMahasiswa">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                        <input type="text" id="nim" name="nim"
                               class="form-control @error('nim') is-invalid @enderror"
                               value="{{ old('nim', $mahasiswa->nim) }}"
                               placeholder="Contoh: 2021001" required>
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" id="nama" name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $mahasiswa->nama) }}"
                               placeholder="Nama lengkap mahasiswa" required>
                        @error('nama')
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
                                    {{ old('id_jurusan', $mahasiswa->id_jurusan) == $j->id_jurusan ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }} ({{ $j->akreditasi }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" id="btn-update-mahasiswa"
                                class="btn text-white" style="background:#0ea5e9;">
                            <i class="bi bi-check-lg me-1"></i> Perbarui
                        </button>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
