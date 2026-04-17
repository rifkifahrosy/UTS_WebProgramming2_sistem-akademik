@extends('layouts.app')

@section('title', 'Ubah Password')
@section('page-title', 'Keamanan Akun')
@section('page-subtitle', 'Perbarui password untuk menjaga keamanan akun Anda')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0" style="font-size:0.95rem; font-weight:600;">Ganti Password</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4" style="opacity: 0.1;">

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted" style="font-size: 0.75rem;">Minimal 8 karakter.</small>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn text-white" style="background:#4f46e5;">
                            <i class="bi bi-check2-circle me-1"></i> Perbarui Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card bg-light border-0">
            <div class="card-body p-4">
                <h6 style="font-weight: 700; color: #1e1b4b;"><i class="bi bi-info-circle me-2"></i>Tips Keamanan</h6>
                <ul class="mt-3 text-muted" style="font-size: 0.85rem; line-height: 1.6;">
                    <li>Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol.</li>
                    <li>Hindari menggunakan tanggal lahir atau nama sebagai password.</li>
                    <li>Jangan beritahukan password Anda kepada siapapun.</li>
                    <li>Sistem akan otomatis melakukan logout setelah password berhasil diubah demi keamanan.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
