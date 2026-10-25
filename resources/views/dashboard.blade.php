@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">Dashboard</h2>
                <span class="badge rounded-pill px-2.5 py-1 text-xs fw-semibold" style="background-color: #e0e7ff; color: #4338ca; font-size: 0.75rem;">
                    Active Term
                </span>
            </div>
            <p class="text-muted mb-0 small">Overview of student enrollment, departmental statistics, and recent activity.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('students.create') }}" class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Add Student
            </a>
            <a href="{{ route('departments.create') }}" class="btn btn-outline-primary d-inline-flex align-items-center">
                <i class="bi bi-building-add me-2"></i> Add Department
            </a>
        </div>
    </div>

    <!-- Summary Metrics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 card-hover position-relative overflow-hidden" style="box-shadow: 0 4px 20px -2px rgba(99, 102, 241, 0.08); border: 1px solid rgba(224, 231, 255, 0.8) !important;">
                <div class="position-absolute top-0 end-0 p-4 pointer-events-none opacity-25" style="transform: translate(20px, -20px);">
                    <div style="width: 140px; height: 140px; border-radius: 50%; background: radial-gradient(circle, rgba(99, 102, 241, 0.4) 0%, rgba(255,255,255,0) 70%);"></div>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <span class="text-uppercase fw-bold small text-muted tracking-wider" style="font-size: 0.72rem; letter-spacing: 0.08em;">Total Students</span>
                            <h2 class="fw-bold mb-0 text-dark mt-1" style="font-size: 2.5rem; letter-spacing: -1px;">
                                {{ number_format($totalStudents) }}
                            </h2>
                        </div>
                        <div class="p-3 text-white rounded-4 shadow-sm" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); box-shadow: 0 8px 16px -2px rgba(79, 70, 229, 0.35);">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light-subtle">
                        <span class="badge bg-indigo-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 small fw-semibold" style="font-size: 0.75rem;">
                            Enrolled Records
                        </span>
                        <a href="{{ route('students.index') }}" class="text-decoration-none small fw-semibold text-primary d-inline-flex align-items-center gap-1">
                            View all students <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 card-hover position-relative overflow-hidden" style="box-shadow: 0 4px 20px -2px rgba(16, 185, 129, 0.08); border: 1px solid rgba(209, 250, 229, 0.8) !important;">
                <div class="position-absolute top-0 end-0 p-4 pointer-events-none opacity-25" style="transform: translate(20px, -20px);">
                    <div style="width: 140px; height: 140px; border-radius: 50%; background: radial-gradient(circle, rgba(16, 185, 129, 0.4) 0%, rgba(255,255,255,0) 70%);"></div>
                </div>
                <div class="card-body p-4 position-relative">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <span class="text-uppercase fw-bold small text-muted tracking-wider" style="font-size: 0.72rem; letter-spacing: 0.08em;">Total Departments</span>
                            <h2 class="fw-bold mb-0 text-dark mt-1" style="font-size: 2.5rem; letter-spacing: -1px;">
                                {{ number_format($totalDepartments) }}
                            </h2>
                        </div>
                        <div class="p-3 text-white rounded-4 shadow-sm" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); box-shadow: 0 8px 16px -2px rgba(5, 150, 105, 0.35);">
                            <i class="bi bi-building fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pt-2 border-top border-light-subtle">
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 small fw-semibold" style="font-size: 0.75rem;">
                            Academic Faculties
                        </span>
                        <a href="{{ route('departments.index') }}" class="text-decoration-none small fw-semibold text-success d-inline-flex align-items-center gap-1">
                            View all departments <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Students Table -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="p-2 rounded-3 text-primary" style="background-color: #eef2ff;">
                    <i class="bi bi-clock-history fs-5"></i>
                </div>
                <div>
                    <h5 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.05rem;">Recently Added Students</h5>
                    <div class="text-muted small" style="font-size: 0.78rem;">Latest registered students in the system</div>
                </div>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-medium">
                View All <i class="bi bi-arrow-up-right ms-1"></i>
            </a>
        </div>

        <div class="card-body p-0">
            @if ($recentStudents->isEmpty())
                <div class="text-center py-5 text-muted">
                    <div class="p-3 bg-light rounded-circle d-inline-flex mb-3">
                        <i class="bi bi-mortarboard fs-1 text-secondary opacity-50"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No students registered yet</h6>
                    <p class="small text-muted mb-3">Get started by creating your first student record.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Add First Student
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
                                <th>Department</th>
                                <th>Date of Birth</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentStudents as $student)
                                <tr>
                                    <td class="ps-4">
                                        <span class="code-pill">{{ $student->student_code }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($student->photo_url)
                                                <img src="{{ $student->photo_url }}"
                                                     alt="{{ $student->name }}"
                                                     class="rounded-circle object-fit-cover me-2.5 border"
                                                     style="width: 36px; height: 36px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);"
                                                     width="36"
                                                     height="36">
                                            @else
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-2.5 text-white fw-bold shadow-xs"
                                                     style="width: 36px; height: 36px; font-size: 0.85rem; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <a href="{{ route('students.show', $student) }}" class="ps-2 text-decoration-none fw-semibold text-dark hover-primary d-block">
                                                    {{ $student->name }}
                                                </a>
                                            </div>
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
                                        <span class="badge-department-pill">
                                            <i class="bi bi-building text-muted"></i>
                                            {{ $student->department->name ?? 'Unassigned' }}
                                        </span>
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
            @endif
        </div>
    </div>
@endsection
