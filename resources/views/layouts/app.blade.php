<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Akademik - Manajemen Data Mahasiswa, Jurusan, dan Matakuliah">
    <title>@yield('title', 'Dashboard') — Sistem Akademik</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #818cf8;
            --secondary: #0ea5e9;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --sidebar-width: 260px;
            --sidebar-bg: #1e1b4b;
            --sidebar-hover: rgba(255,255,255,0.08);
            --sidebar-active: rgba(79, 70, 229, 0.4);
            --body-bg: #f1f5f9;
            --card-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 10px 40px rgba(0,0,0,0.04);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: #334155;
        }

        /* ─── Sidebar ─── */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            margin: 0;
            line-height: 1.3;
        }

        .sidebar-brand span {
            font-size: 0.72rem;
            color: var(--primary-light);
            font-weight: 400;
        }

        .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .sidebar-nav .nav-section-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.3);
            padding: 12px 8px 6px;
            font-weight: 600;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.65);
            padding: 10px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
            transform: translateX(2px);
        }

        .sidebar-nav .nav-link.active {
            background: var(--sidebar-active);
            color: var(--primary-light);
            border-left: 3px solid var(--primary-light);
        }

        .sidebar-nav .nav-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        /* ─── Main Content ─── */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── Topbar ─── */
        #topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .topbar-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
        }

        .topbar-title small {
            display: block;
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 400;
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.85rem;
        }

        /* ─── Page Content ─── */
        .page-content {
            flex: 1;
            padding: 24px;
        }

        /* ─── Cards ─── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            border-radius: 12px 12px 0 0 !important;
            padding: 16px 20px;
        }

        .card-body { padding: 20px; }

        /* ─── Stat Cards ─── */
        .stat-card {
            border-radius: 14px;
            padding: 22px;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
        }

        .stat-card .stat-icon {
            width: 48px; height: 48px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: 0.8rem;
            opacity: 0.85;
            font-weight: 500;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
        }

        /* ─── Tables ─── */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            font-weight: 600;
            padding: 12px 16px;
        }

        .table-modern tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
            color: #334155;
        }

        .table-modern tbody tr:last-child td { border-bottom: none; }

        .table-modern tbody tr:hover { background: #f8fafc; }

        /* ─── Badges ─── */
        .badge-akreditasi {
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* ─── Buttons ─── */
        .btn { border-radius: 8px; font-weight: 500; font-size: 0.875rem; }
        .btn-sm { font-size: 0.78rem; padding: 4px 10px; }

        /* ─── Forms ─── */
        .form-control, .form-select {
            border-radius: 8px;
            border-color: #e2e8f0;
            padding: 10px 14px;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
        }

        /* ─── Alerts ─── */
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
        }

        /* ─── Pagination ─── */
        .pagination .page-link {
            border-radius: 6px;
            margin: 0 2px;
            border-color: #e2e8f0;
            color: var(--primary);
            font-size: 0.85rem;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #ffffff;
        }

        .pagination .page-link:hover {
            color: var(--primary-dark);
            background-color: #e0e7ff;
        }

        /* ─── Empty State ─── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }
        .empty-state i { font-size: 3.5rem; margin-bottom: 12px; display: block; }
        .empty-state p { font-size: 0.9rem; margin: 0; }

        /* ─── Responsive ─── */
        @media (max-width: 768px) {
            #sidebar { width: 0; }
            #main-content { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- ─── Sidebar ─── -->
<nav id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-3">
        <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
        <div>
            <h4>Sistem Akademik</h4>
            <span>Manajemen Kampus</span>
        </div>
    </div>

    <div class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section-label mt-2">Data Master</div>
        <a href="{{ route('jurusan.index') }}"
           class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Jurusan
        </a>
        <a href="{{ route('mahasiswa.index') }}"
           class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Mahasiswa
        </a>
        <a href="{{ route('matakuliah.index') }}"
           class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark"></i> Mata Kuliah
        </a>
    </div>

    {{-- <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link border-0 w-100 text-start"
                    style="background:none; cursor:pointer; color:rgba(255,255,255,0.55);">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div> --}}
</nav>

<!-- ─── Main Content ─── -->
<div id="main-content">
    <!-- Topbar -->
    <div id="topbar">
        <div class="topbar-title">
            @yield('page-title', 'Dashboard')
            <small>@yield('page-subtitle', 'Sistem Informasi Akademik')</small>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <div class="d-flex align-items-center gap-2" style="cursor: pointer;" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div class="d-none d-sm-block">
                        <div style="font-size:0.82rem; font-weight:600; color:#1e293b;">{{ Auth::user()->name }}</div>
                        <div style="font-size:0.72rem; color:#94a3b8;">Administrator <i class="bi bi-chevron-down ms-1" style="font-size: 0.6rem;"></i></div>
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2" style="border-radius: 12px; min-width: 180px;">
                    <li><h6 class="dropdown-header">Akun Saya</h6></li>
                    <li><a class="dropdown-item py-2" href="{{ route('profile.password') }}">
                        <i class="bi bi-shield-lock me-2 text-primary"></i> Ubah Password
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="bi bi-box-arrow-left me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="page-content">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<!-- Global Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title" id="deleteModalLabel" style="font-weight: 600;">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-exclamation-circle text-danger mb-3" style="font-size: 3.5rem;"></i>
                <p class="mb-0" id="deleteModalMessage" style="font-size: 0.95rem; color: #475569;">Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer border-top-0 pt-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-action');
                const message = button.getAttribute('data-message');
                
                const form = document.getElementById('deleteForm');
                form.action = url;
                
                if (message) {
                    document.getElementById('deleteModalMessage').textContent = message;
                } else {
                    document.getElementById('deleteModalMessage').textContent = "Apakah Anda yakin ingin menghapus data ini?";
                }
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>
