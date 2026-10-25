@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
    <h4 class="fw-bold mb-3 text-center">Sign In</h4>
    <p class="text-muted text-center small mb-4">Enter your credentials to access the management portal</p>

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                <input type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="name@example.com"
                       required
                       autofocus>
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
                       placeholder="••••••••"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label text-muted small" for="remember">Remember me on this device</label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary py-2 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
            </button>
        </div>

        <div class="text-center text-muted small">
            Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Register here</a>
        </div>
    </form>

@endsection
