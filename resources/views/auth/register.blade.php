@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h4 class="fw-bold mb-3 text-center">Create Account</h4>
    <p class="text-muted text-center small mb-4">Register as a staff member or administrator</p>

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Full Name</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                <input type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Sokha Chan"
                       required
                       autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="sokha@example.com"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                <input type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       id="password"
                       name="password"
                       placeholder="At least 8 characters"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-shield-lock"></i></span>
                <input type="password"
                       class="form-control"
                       id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Repeat password"
                       required>
            </div>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary py-2 fw-semibold">
                <i class="bi bi-person-plus me-1"></i> Register Account
            </button>
        </div>

        <div class="text-center text-muted small">
            Already registered? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Sign in here</a>
        </div>
    </form>
@endsection
