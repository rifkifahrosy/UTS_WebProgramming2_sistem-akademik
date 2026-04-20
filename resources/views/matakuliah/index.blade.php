@extends('layouts.app')

@section('title', 'Data Mata Kuliah')
@section('page-title', 'Data Mata Kuliah')
@section('page-subtitle', 'Kelola data mata kuliah yang tersedia')

@section('content')

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
        <div>
            <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">Daftar Mata Kuliah</h5>
            <small class="text-muted" style="font-size:0.78rem;">Total: {{ $matakuliah->total() }} mata kuliah</small>
        </div>
        <a href="{{ route('matakuliah.create') }}" id="btn-tambah-matakuliah"
           class="btn btn-sm text-white" style="background:#10b981;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Mata Kuliah
        </a>
    </div>

    {{-- Search --}}
    <div class="card-body border-bottom py-3">
        <form action="{{ route('matakuliah.index') }}" method="GET" id="searchForm">
            <div class="input-group" style="max-width: 380px;">
                <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="search" name="search" class="form-control"
                       placeholder="Cari nama matakuliah, SKS, atau jurusan..."
                       value="{{ $search }}" style="border-color:#e2e8f0;">
                @if($search)
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        @if($matakuliah->isEmpty())
            <div class="empty-state">
                <i class="bi bi-journal-bookmark text-muted"></i>
                <p>{{ $search ? 'Tidak ada mata kuliah yang cocok dengan pencarian.' : 'Belum ada data mata kuliah.' }}</p>
                @if(!$search)
                    <a href="{{ route('matakuliah.create') }}" class="btn btn-sm mt-2" style="background:#10b981; color:#fff;">
                        <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
                    </a>
                @endif
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Nama Mata Kuliah</th>
                        <th class="text-center" style="width:80px;">SKS</th>
                        <th>Jurusan</th>
                        <th>Akreditasi</th>
                        <th class="text-end" style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matakuliah as $index => $mk)
                    <tr>
                        <td class="text-muted">{{ $matakuliah->firstItem() + $index }}</td>
                        <td style="font-weight:500;">{{ $mk->nama_matakuliah }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill"
                                  style="background:#f0fdf4; color:#15803d; font-size:0.8rem; padding:4px 10px; font-weight:600;">
                                {{ $mk->sks }} SKS
                            </span>
                        </td>
                        <td>
                            @if($mk->jurusan)
                                <div style="font-size:0.875rem;">{{ $mk->jurusan->nama_jurusan }}</div>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($mk->jurusan)
                                @php
                                    $colors = [
                                        'Unggul'      => ['bg'=>'#d1fae5','text'=>'#065f46'],
                                        'A'           => ['bg'=>'#ede9fe','text'=>'#5b21b6'],
                                        'Baik Sekali' => ['bg'=>'#e0f2fe','text'=>'#0369a1'],
                                        'B'           => ['bg'=>'#fef3c7','text'=>'#92400e'],
                                        'Baik'        => ['bg'=>'#f1f5f9','text'=>'#475569'],
                                        'C'           => ['bg'=>'#fee2e2','text'=>'#991b1b'],
                                    ];
                                    $c = $colors[$mk->jurusan->akreditasi] ?? ['bg'=>'#f1f5f9','text'=>'#475569'];
                                @endphp
                                <span class="badge-akreditasi"
                                      style="background:{{ $c['bg'] }}; color:{{ $c['text'] }};">
                                    {{ $mk->jurusan->akreditasi }}
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('matakuliah.edit', $mk->id_matakuliah) }}"
                                   id="btn-edit-matakuliah-{{ $mk->id_matakuliah }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" 
                                        id="btn-hapus-matakuliah-{{ $mk->id_matakuliah }}"
                                        class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" 
                                        data-action="{{ route('matakuliah.destroy', $mk->id_matakuliah) }}" 
                                        data-message="Hapus mata kuliah '{{ $mk->nama_matakuliah }}'?"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($matakuliah->hasPages())
        <div class="card-body border-top py-2">
            {{ $matakuliah->links() }}
        </div>
        @endif
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    let searchTimer;
    document.getElementById('search').addEventListener('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => document.getElementById('searchForm').submit(), 400);
    });
</script>
@endpush
