@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Add Student</h3>
                    <p class="text-muted small mb-0">Enroll a new student and assign their academic department</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    @if ($departments->isEmpty())
                        <div class="alert alert-warning rounded-3 border-0 bg-warning-subtle p-3">
                            <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i>
                            <strong>No departments available!</strong> You must create at least one department before enrolling students.
                            <div class="mt-2">
                                <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary">Create Department</a>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="student_code" class="form-label fw-semibold text-dark">Student Code <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control font-monospace @error('student_code') is-invalid @enderror"
                                           id="student_code"
                                           name="student_code"
                                           value="{{ old('student_code') }}"
                                           placeholder="e.g. STU-2026-001"
                                           required
                                           autofocus>
                                    @error('student_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted small">Unique student identifier code.</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="department_id" class="form-label fw-semibold text-dark">Department <span class="text-danger">*</span></label>
                                    <select class="form-select @error('department_id') is-invalid @enderror"
                                            id="department_id"
                                            name="department_id"
                                            required>
                                        <option value="">-- Select Department --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ (string)old('department_id') === (string)$department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold text-dark">Full Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="e.g. Sokha Chan"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-dark d-block">Gender <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-4 pt-1">
                                        <div class="form-check">
                                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                                   type="radio"
                                                   name="gender"
                                                   id="genderMale"
                                                   value="Male"
                                                   {{ old('gender', 'Male') === 'Male' ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="genderMale">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                                   type="radio"
                                                   name="gender"
                                                   id="genderFemale"
                                                   value="Female"
                                                   {{ old('gender') === 'Female' ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="genderFemale">Female</label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="dob" class="form-label fw-semibold text-dark">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date"
                                           class="form-control @error('dob') is-invalid @enderror"
                                           id="dob"
                                           name="dob"
                                           value="{{ old('dob') }}"
                                           max="{{ date('Y-m-d') }}"
                                           required>
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted small">Cannot be in the future.</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold text-dark">Phone Number</label>
                                <input type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="e.g. +855 12 345 678"
                                       maxlength="30">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted small">Optional. Maximum 30 characters.</div>
                            </div>

                            <div class="mb-4">
                                <label for="photo" class="form-label fw-semibold text-dark">Profile Photo</label>
                                <input type="file"
                                       class="form-control @error('photo') is-invalid @enderror"
                                       id="photo"
                                       name="photo"
                                       accept="image/jpeg,image/png,image/jpg,image/webp">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted small">Optional. Accepted formats: JPG, PNG, WEBP (Max: 2MB).</div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">
                                    <i class="bi bi-check-lg me-1"></i> Save Student
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
