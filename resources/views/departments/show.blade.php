@extends('layouts.app')

@section('title', 'Department: ' . $department->name)

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('departments.index') }}" class="text-decoration-none">Departments</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">{{ $department->name }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">{{ $department->name }}</h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-pencil me-2"></i> Edit Department
            </a>
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center">
                <i class="bi bi-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 px-4">
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">
                        <i class="bi bi-building text-primary me-2"></i> Department Info
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Department Name</div>
                        <div class="fs-5 fw-bold text-dark">{{ $department->name }}</div>
                    </div>
                    <div class="mb-4 p-3 rounded-3" style="background-color: #eef2ff; border: 1px solid #c7d2fe;">
                        <div class="text-primary small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Total Enrolled Students</div>
                        <div class="d-flex align-items-baseline gap-2">
                            <span class="fs-2 fw-bold text-dark" style="letter-spacing: -1px;">{{ $department->students_count }}</span>
                            <span class="text-muted small">students</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.05em;">Description</div>
                        <div class="text-secondary small lh-base">{{ $department->description ?: 'No description provided.' }}</div>
                    </div>
                    <div class="text-muted small border-top pt-3" style="font-size: 0.8rem;">
                        <div>Created: {{ $department->created_at?->format('d M Y, h:i A') }}</div>
                        <div>Last Updated: {{ $department->updated_at?->format('d M Y, h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">
                        <i class="bi bi-people text-primary me-2"></i> Students in this Department
                    </h5>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg me-2"></i> Add Student
                    </a>
                </div>
                <div class="card-body p-0">
                    @if ($students->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <div class="p-3 bg-light rounded-circle d-inline-flex mb-3">
                                <i class="bi bi-people-slash fs-1 text-secondary opacity-50"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">No students enrolled yet</h6>
                            <p class="small text-muted mb-3">There are no students currently assigned to this department.</p>
                            <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-lg me-2"></i> Enroll Student
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Code</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="code-pill">{{ $student->student_code }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($student->photo_url)
                                                        <img src="{{ $student->photo_url }}"
                                                             alt="{{ $student->name }}"
                                                             class="rounded-circle object-fit-cover me-2 border"
                                                             style="width: 32px; height: 32px;"
                                                             width="32"
                                                             height="32">
                                                    @else
                                                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-2 text-white fw-bold shadow-xs"
                                                             style="width: 32px; height: 32px; font-size: 0.8rem; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                    <a href="{{ route('students.show', $student) }}" class="text-decoration-none fw-semibold text-dark hover-primary">
                                                        {{ $student->name }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($student->gender === 'Male')
                                                    <span class="badge-gender-male">
                                                        <span class="p-1 bg-primary rounded-circle" style="width: 5px; height: 5px;"></span> Male
                                                    </span>
                                                @else
                                                    <span class="badge-gender-female">
                                                        <span class="p-1 bg-danger rounded-circle" style="width: 5px; height: 5px;"></span> Female
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-secondary small d-inline-flex align-items-center">
                                                    <i class="bi bi-calendar3 text-muted me-2" style="font-size: 0.85rem;"></i>
                                                    {{ $student->dob?->format('d M Y') ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('students.show', $student) }}" class="action-btn-circle" title="View Profile">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($students->hasPages())
                            <div class="p-3 px-4 border-top">
                                {{ $students->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
