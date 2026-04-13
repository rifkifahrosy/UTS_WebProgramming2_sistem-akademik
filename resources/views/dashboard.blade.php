@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data sistem akademik')

@section('content')

{{-- ─── Stat Cards ─── --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #4f46e5, #818cf8); box-shadow: 0 8px 25px rgba(79,70,229,0.3);">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-building"></i></div>
                <div class="text-end">
                    <div class="stat-number">{{ $totalJurusan }}</div>
                    <div class="stat-label">Total Jurusan</div>
                </div>
            </div>
            <a href="{{ route('jurusan.index') }}" class="text-white text-decoration-none" style="font-size:0.78rem; opacity:0.8;">
                Lihat semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #0ea5e9, #38bdf8); box-shadow: 0 8px 25px rgba(14,165,233,0.3);">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="text-end">
                    <div class="stat-number">{{ $totalMahasiswa }}</div>
                    <div class="stat-label">Total Mahasiswa</div>
                </div>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="text-white text-decoration-none" style="font-size:0.78rem; opacity:0.8;">
                Lihat semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #10b981, #34d399); box-shadow: 0 8px 25px rgba(16,185,129,0.3);">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stat-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                <div class="text-end">
                    <div class="stat-number">{{ $totalMatakuliah }}</div>
                    <div class="stat-label">Total Mata Kuliah</div>
                </div>
            </div>
            <a href="{{ route('matakuliah.index') }}" class="text-white text-decoration-none" style="font-size:0.78rem; opacity:0.8;">
                Lihat semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- ─── Jurusan Overview Table ─── --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h5 class="mb-0 fw-600" style="font-size:0.95rem; font-weight:600;">Ringkasan per Jurusan</h5>
            <small class="text-muted" style="font-size:0.78rem;">Jumlah mahasiswa dan matakuliah tiap jurusan</small>
        </div>
        <a href="{{ route('jurusan.create') }}" class="btn btn-sm" style="background:#4f46e5; color:#fff;">
            <i class="bi bi-plus-lg"></i> Tambah Jurusan
        </a>
    </div>
    <div class="card-body p-0">
        @if($jurusanList->isEmpty())
            <div class="empty-state">
                <i class="bi bi-building text-muted"></i>
                <p>Belum ada data jurusan. <a href="{{ route('jurusan.create') }}">Tambah sekarang</a></p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Jurusan</th>
                        <th>Akreditasi</th>
                        <th class="text-center">Mahasiswa</th>
                        <th class="text-center">Mata Kuliah</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurusanList as $index => $j)
                    <tr>
                        <td class="text-muted">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-500" style="font-weight:500;">{{ $j->nama_jurusan }}</div>
                        </td>
                        <td>
                            @php
                                $colors = [
                                    'Unggul'      => 'success',
                                    'A'           => 'primary',
                                    'Baik Sekali' => 'info',
                                    'B'           => 'warning',
                                    'Baik'        => 'secondary',
                                    'C'           => 'danger',
                                ];
                                $color = $colors[$j->akreditasi] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} badge-akreditasi">{{ $j->akreditasi }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill" style="background:#e0e7ff; color:#4f46e5; font-size:0.8rem; padding:4px 10px;">
                                {{ $j->mahasiswa_count }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill" style="background:#d1fae5; color:#059669; font-size:0.8rem; padding:4px 10px;">
                                {{ $j->matakuliah_count }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('jurusan.edit', $j->id_jurusan) }}"
                               class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
