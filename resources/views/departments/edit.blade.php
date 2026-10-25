@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Edit Department</h3>
                    <p class="text-muted small mb-0">Update department details and description</p>
                </div>
                <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('departments.update', $department) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Department Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $department->name) }}"
                                   placeholder="e.g. Information Technology"
                                   required
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Brief summary of this department's field of study...">{{ old('description', $department->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm">
                                <i class="bi bi-check-lg me-1"></i> Update Department
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
