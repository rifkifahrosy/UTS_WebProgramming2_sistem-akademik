@extends('layouts.app')

@section('title', 'Data Mata Kuliah')
@section('page-title', 'Data Mata Kuliah')
@section('page-subtitle', 'Kelola data mata kuliah yang tersedia')

@section('content')

@php
    $sortOptions = [
        'nama_matakuliah' => ['label' => 'Name', 'icon' => 'bi-alphabet'],
        'sks' => ['label' => 'SKS', 'icon' => 'bi-hash'],
        'jurusan' => ['label' => 'Jurusan', 'icon' => 'bi-building'],
        'created_at' => ['label' => 'Last added', 'icon' => 'bi-clock-history'],
    ];
    $currentSort = $sortOptions[$sortBy] ?? $sortOptions['nama_matakuliah'];
@endphp

<div class="card">
    <div class="card-header d-flex flex-wrap gap-2 align-items-center justify-content-between">
        <div>
            <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">Daftar Mata Kuliah</h5>
            <small id="total-count" class="text-muted" style="font-size:0.78rem;">Total: {{ $matakuliah->total() }} mata kuliah</small>
        </div>
        <a href="{{ route('matakuliah.create') }}" id="btn-tambah-matakuliah"
           class="btn btn-sm text-white" style="background:#10b981;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Mata Kuliah
        </a>
    </div>

    {{-- Search --}}
    <div class="card-body border-bottom py-3">
        <div class="d-flex flex-wrap gap-3 align-items-center">
            <form action="{{ route('matakuliah.index') }}" method="GET" id="searchForm" class="flex-grow-1" style="max-width: 380px;">
                <div class="input-group">
                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="search" name="search" class="form-control"
                           placeholder="Cari nama matakuliah, SKS, atau jurusan..."
                           value="{{ $search }}" style="border-color:#e2e8f0;">
                </div>
            </form>

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
                                        'Baik Sekali' => ['bg'=>'#e0f2fe','text'=>'#0369a1'],
                                        'Baik'        => ['bg'=>'#f1f5f9','text'=>'#475569'],
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
