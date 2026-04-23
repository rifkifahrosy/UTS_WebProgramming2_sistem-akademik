@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')
@section('page-subtitle', 'Kelola data mahasiswa terdaftar')

@section('content')

@php
    $sortOptions = [
        'nama' => ['label' => 'Name', 'icon' => 'bi-alphabet'],
        'nim' => ['label' => 'NIM', 'icon' => 'bi-hash'],
        'jurusan' => ['label' => 'Jurusan', 'icon' => 'bi-building'],
        'created_at' => ['label' => 'Last added', 'icon' => 'bi-clock-history'],
    ];
    $currentSort = $sortOptions[$sortBy] ?? $sortOptions['nama'];
@endphp

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
        <div>
            <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">Daftar Mahasiswa</h5>
            <small id="total-count" class="text-muted" style="font-size:0.78rem;">Total: {{ $mahasiswa->total() }} mahasiswa</small>
        </div>
        <a href="{{ route('mahasiswa.create') }}" id="btn-tambah-mahasiswa"
           class="btn btn-sm text-white" style="background:#0ea5e9;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Mahasiswa
        </a>
    </div>

    {{-- Search --}}
    <div class="card-body border-bottom py-3">
        <div class="d-flex flex-wrap gap-3 align-items-center">
            <form action="{{ route('mahasiswa.index') }}" method="GET" id="searchForm" class="flex-grow-1" style="max-width: 380px;">
                <div class="input-group">
                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="search" name="search" class="form-control"
                           placeholder="Cari NIM, nama, atau jurusan..."
                           value="{{ $search }}" style="border-color:#e2e8f0;">
                </div>
            </form>

            <div class="d-flex align-items-center gap-2 ms-auto">
            <div class="d-flex align-items-center gap-2 ms-auto">
                <div id="sort-dropdown-wrapper" class="dropdown sort-dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <i class="bi {{ $sortOrder == 'asc' ? 'bi-sort-down-alt' : 'bi-sort-up' }}"></i>
                        <span>Sort: {{ $currentSort['label'] }}</span>
                        <i class="bi bi-caret-down-fill" style="font-size: 0.6rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="px-3 py-1 border-bottom mb-1">
                            <span class="text-muted fw-bold" style="font-size: 0.7rem; text-transform: uppercase;">Sort by</span>
                        </li>
                        @foreach($sortOptions as $key => $opt)
                            <li>
                                <a class="dropdown-item sort-option {{ $sortBy == $key ? 'active' : '' }}" 
                                   data-value="{{ $key }}">
                                    <i class="bi bi-check check-icon"></i>
                                    <i class="bi {{ $opt['icon'] }}"></i>
                                    {{ $opt['label'] }}
                                </a>
                            </li>
                        @endforeach
                        <li class="border-top mt-1 pt-1">
                            <a class="dropdown-item order-option {{ $sortOrder == 'asc' ? 'active' : '' }}" data-value="asc">
                                <i class="bi bi-check check-icon"></i>
                                <i class="bi bi-sort-numeric-down"></i> Ascending
                            </a>
                            <a class="dropdown-item order-option {{ $sortOrder == 'desc' ? 'active' : '' }}" data-value="desc">
                                <i class="bi bi-check check-icon"></i>
                                <i class="bi bi-sort-numeric-up-alt"></i> Descending
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- Hidden inputs to store state --}}
                <input type="hidden" id="sort_by" value="{{ $sortBy }}">
                <input type="hidden" id="order" value="{{ $sortOrder }}">
            </div>
        </div>
    </div>

    <div id="search-results" class="card-body p-0">
        @if($mahasiswa->isEmpty())
            <div class="empty-state">
                <i class="bi bi-people text-muted"></i>
                <p>{{ $search ? 'Tidak ada mahasiswa yang cocok dengan pencarian.' : 'Belum ada data mahasiswa.' }}</p>
                @if(!$search)
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm mt-2" style="background:#0ea5e9; color:#fff;">
                        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
                    </a>
                @endif
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
                        <th>Akreditasi</th>
                        <th class="text-end" style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswa as $index => $m)
                    <tr>
                        <td class="text-muted">{{ $mahasiswa->firstItem() + $index }}</td>
                        <td>
                            <span class="badge" style="background:#f0f9ff; color:#0369a1; font-size:0.8rem; padding:4px 10px; font-weight:600;">
                                {{ $m->nim }}
                            </span>
                        </td>
                        <td style="font-weight:500;">{{ $m->nama }}</td>
                        <td>
                            @if($m->jurusan)
                                <div style="fontSize:0.875rem;">{{ $m->jurusan->nama_jurusan }}</div>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($m->jurusan)
                                @php
                                    $colors = [
                                        'Unggul'      => ['bg'=>'#d1fae5','text'=>'#065f46'],
                                        'A'           => ['bg'=>'#ede9fe','text'=>'#5b21b6'],
                                        'Baik Sekali' => ['bg'=>'#e0f2fe','text'=>'#0369a1'],
                                        'B'           => ['bg'=>'#fef3c7','text'=>'#92400e'],
                                        'Baik'        => ['bg'=>'#f1f5f9','text'=>'#475569'],
                                        'C'           => ['bg'=>'#fee2e2','text'=>'#991b1b'],
                                    ];
                                    $c = $colors[$m->jurusan->akreditasi] ?? ['bg'=>'#f1f5f9','text'=>'#475569'];
                                @endphp
                                <span class="badge-akreditasi"
                                      style="background:{{ $c['bg'] }}; color:{{ $c['text'] }};">
                                    {{ $m->jurusan->akreditasi }}
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('mahasiswa.edit', $m->id_mahasiswa) }}"
                                   id="btn-edit-mahasiswa-{{ $m->id_mahasiswa }}"
                                   class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" 
                                        id="btn-hapus-mahasiswa-{{ $m->id_mahasiswa }}"
                                        class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" 
                                        data-action="{{ route('mahasiswa.destroy', $m->id_mahasiswa) }}" 
                                        data-message="Hapus mahasiswa '{{ $m->nama }}'?"
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
        @if($mahasiswa->hasPages())
        <div class="card-body border-top py-2">
            {{ $mahasiswa->links() }}
        </div>
        @endif
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    let searchTimer;
    const searchInput = document.getElementById('search');
    const sortByInput = document.getElementById('sort_by');
    const orderInput = document.getElementById('order');
    const resultsContainer = document.getElementById('search-results');
    const totalCount = document.getElementById('total-count');
    const sortWrapper = document.getElementById('sort-dropdown-wrapper');

    function performSearch() {
        const url = new URL(window.location.href);
        url.searchParams.set('search', searchInput.value);
        url.searchParams.set('sort_by', sortByInput.value);
        url.searchParams.set('order', orderInput.value);
        
        resultsContainer.style.opacity = '0.5';

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Update tabel
                resultsContainer.innerHTML = doc.getElementById('search-results').innerHTML;
                
                // Update total count
                if (totalCount && doc.getElementById('total-count')) {
                    totalCount.innerHTML = doc.getElementById('total-count').innerHTML;
                }

                // Update dropdown button & menu
                if (sortWrapper && doc.getElementById('sort-dropdown-wrapper')) {
                    sortWrapper.innerHTML = doc.getElementById('sort-dropdown-wrapper').innerHTML;
                }

                resultsContainer.style.opacity = '1';
                window.history.pushState({}, '', url);
            })
            .catch(err => {
                console.error('Search error:', err);
                resultsContainer.style.opacity = '1';
            });
    }

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(performSearch, 300);
    });

    // Event Delegation untuk dropdown kustom
    document.addEventListener('click', function(e) {
        const sortOption = e.target.closest('.sort-option');
        if (sortOption) {
            e.preventDefault();
            sortByInput.value = sortOption.dataset.value;
            performSearch();
        }
        
        const orderOption = e.target.closest('.order-option');
        if (orderOption) {
            e.preventDefault();
            orderInput.value = orderOption.dataset.value;
            performSearch();
        }
    });
</script>
@endpush
