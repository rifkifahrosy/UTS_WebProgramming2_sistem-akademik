@extends('layouts.app')

@section('title', 'Data Jurusan')
@section('page-title', 'Data Jurusan')
@section('page-subtitle', 'Kelola data jurusan yang tersedia')

@section('content')

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
        <div>
            <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">Daftar Jurusan</h5>
            <small class="text-muted" style="font-size:0.78rem;">Total: {{ $jurusan->total() }} jurusan</small>
        </div>
        <a href="{{ route('jurusan.create') }}" id="btn-tambah-jurusan"
           class="btn btn-sm text-white" style="background:#4f46e5;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Jurusan
        </a>
    </div>

    {{-- Search --}}
    <div class="card-body border-bottom py-3">
        <form action="{{ route('jurusan.index') }}" method="GET" id="searchForm">
            <div class="input-group" style="max-width: 380px;">
                <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="search" name="search" class="form-control"
                       placeholder="Cari nama jurusan atau akreditasi..."
                       value="{{ $search }}" style="border-color:#e2e8f0;">
                @if($search)
                    <a href="{{ route('jurusan.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        @if($jurusan->isEmpty())
            <div class="empty-state">
                <i class="bi bi-building text-muted"></i>
                <p>{{ $search ? 'Tidak ada jurusan yang cocok dengan pencarian.' : 'Belum ada data jurusan.' }}</p>
                @if(!$search)
                    <a href="{{ route('jurusan.create') }}" class="btn btn-sm mt-2" style="background:#4f46e5; color:#fff;">
                        <i class="bi bi-plus-lg"></i> Tambah Jurusan
                    </a>
                @endif
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Nama Jurusan</th>
                        <th>Akreditasi</th>
                        <th class="text-center">Mahasiswa</th>
                        <th class="text-center">Mata Kuliah</th>
                        <th class="text-end" style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jurusan as $index => $j)
                    <tr>
                        <td class="text-muted">{{ $jurusan->firstItem() + $index }}</td>
                        <td>
                            <div style="font-weight:500;">{{ $j->nama_jurusan }}</div>
                        </td>
                        <td>
                            @php
                                $colors = [
                                    'Unggul'      => ['bg'=>'#d1fae5','text'=>'#065f46'],
                                    'A'           => ['bg'=>'#ede9fe','text'=>'#5b21b6'],
                                    'Baik Sekali' => ['bg'=>'#e0f2fe','text'=>'#0369a1'],
                                    'B'           => ['bg'=>'#fef3c7','text'=>'#92400e'],
                                    'Baik'        => ['bg'=>'#f1f5f9','text'=>'#475569'],
                                    'C'           => ['bg'=>'#fee2e2','text'=>'#991b1b'],
                                ];
                                $c = $colors[$j->akreditasi] ?? ['bg'=>'#f1f5f9','text'=>'#475569'];
                            @endphp
                            <span class="badge-akreditasi"
                                  style="background:{{ $c['bg'] }}; color:{{ $c['text'] }};">
                                {{ $j->akreditasi }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill"
                                  style="background:#ede9fe; color:#5b21b6; font-size:0.8rem; padding:4px 10px;">
                                {{ $j->mahasiswa_count }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill"
                                  style="background:#d1fae5; color:#065f46; font-size:0.8rem; padding:4px 10px;">
                                {{ $j->matakuliah_count }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('jurusan.edit', $j->id_jurusan) }}"
                                   id="btn-edit-jurusan-{{ $j->id_jurusan }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('jurusan.destroy', $j->id_jurusan) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus jurusan \'{{ $j->nama_jurusan }}\'? Semua mahasiswa dan matakuliah terkait juga akan dihapus!')">
                                    @csrf @method('DELETE')
                                    <button type="submit" id="btn-hapus-jurusan-{{ $j->id_jurusan }}"
                                            class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($jurusan->hasPages())
        <div class="card-body border-top py-2">
            {{ $jurusan->links() }}
        </div>
        @endif
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Auto-submit on typing (debounced)
    let searchTimer;
    document.getElementById('search').addEventListener('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => document.getElementById('searchForm').submit(), 400);
    });
</script>
@endpush
