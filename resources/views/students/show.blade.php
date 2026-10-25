@extends('layouts.app')

@section('title', 'Student Profile: ' . $student->name)

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Students</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">{{ $student->student_code }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">{{ $student->name }}</h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-pencil me-2"></i> Edit Profile
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4 position-relative overflow-hidden">
                <div class="position-absolute top-0 start-0 w-100" style="height: 90px; background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);"></div>
                <div class="position-relative mt-4 mb-3">
                    @if ($student->photo_url)
                        <img src="{{ $student->photo_url }}"
                             alt="{{ $student->name }}"
                             class="rounded-circle shadow object-fit-cover border border-4 border-white"
                             width="120"
                             height="120">
                    @else
                        <div class="mx-auto rounded-circle d-inline-flex align-items-center justify-content-center text-white fw-bold shadow border border-4 border-white"
                             style="width: 120px; height: 120px; font-size: 2.75rem; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h4 class="fw-bold mb-1 text-dark">{{ $student->name }}</h4>
                <div class="mb-3">
                    <span class="code-pill">{{ $student->student_code }}</span>
                </div>
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-2">
                    @if ($student->gender === 'Male')
                        <span class="badge-gender-male">
                            <span class="p-1 bg-primary rounded-circle" style="width: 5px; height: 5px;"></span> Male
                        </span>
                    @else
                        <span class="badge-gender-female">
                            <span class="p-1 bg-danger rounded-circle" style="width: 5px; height: 5px;"></span> Female
                        </span>
                    @endif
                    <span class="badge-department-pill">
                        <i class="bi bi-building text-muted"></i>
                        {{ $student->department->name ?? 'Unassigned' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i> Student Details
                    </h5>
                    <span class="badge rounded-pill bg-light text-secondary border px-2.5 py-1 small">
                        Active Student
                    </span>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Student Code</div>
                                <div class="fs-6 fw-bold text-dark font-monospace">{{ $student->student_code }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Department</div>
                                <div class="fs-6 fw-semibold">
                                    @if ($student->department)
                                        <a href="{{ route('departments.show', $student->department) }}" class="text-decoration-none text-primary">
                                            {{ $student->department->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">Unassigned</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Gender</div>
                                <div class="fs-6 fw-medium text-dark">{{ $student->gender }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Date of Birth</div>
                                <div class="fs-6 fw-medium text-dark">
                                    {{ $student->dob?->format('F d, Y') ?? 'N/A' }}
                                    @if ($student->dob)
                                        <span class="text-muted small">({{ $student->dob->age }} yrs)</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Phone Number</div>
                                <div class="fs-6 fw-medium text-dark">{{ $student->phone ?: 'Not provided' }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #eef2f6;">
                                <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Registration Date</div>
                                <div class="fs-6 fw-medium text-dark">{{ $student->created_at?->format('F d, Y h:i A') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top mt-4 pt-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                        <span class="text-muted small">Last updated: {{ $student->updated_at?->diffForHumans() }}</span>
                        <button type="button" class="btn btn-outline-danger btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#deleteProfileModal">
                            <i class="bi bi-trash me-1"></i> Delete Student
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Confirm Student Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <p class="text-muted mb-0">Are you sure you want to permanently delete student <strong class="text-dark">{{ $student->name }}</strong> (<span class="code-pill">{{ $student->student_code }}</span>)?</p>
                    <div class="text-muted small mt-2">This action cannot be undone.</div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('students.destroy', $student) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-3 fw-semibold">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
