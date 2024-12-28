@extends('layouts.admin')

@section('title', 'Carausel Page')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Thay đổi mật khẩu</h2>
        @if (session('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card shadow-lg p-4">
            <form action="{{ route('admin.changePass') }}" method="POST">
                @csrf
                <!-- Mật khẩu cũ -->
                <div class="mb-3">
                    <label for="old_password" class="form-label">Mật khẩu cũ</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                        id="old_password" name="old_password">
                    @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" name="new_password">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Xác nhận mật khẩu mới -->
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror"
                        id="new_password_confirmation" name="new_password_confirmation">
                        @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Lưu thay đổi</button>
            </form>
        </div>
    </div>
@endsection
