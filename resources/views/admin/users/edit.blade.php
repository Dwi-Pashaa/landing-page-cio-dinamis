@extends('admin.layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="mb-4">
    <a href="{{ url('/cms/users') }}" class="text-decoration-none text-muted small">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
    <h4 class="mb-1 fw-bold mt-2">Edit User</h4>
    <p class="text-muted mb-0 small">Edit pengguna: {{ $user->name }}</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ url('/cms/users/' . $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold small">Level</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="">-- Pilih Level --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role', $userRole) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>
                <a href="{{ url('/cms/users') }}" class="btn btn-secondary px-4 ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
