@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Students</h2>
            <p class="text-muted mb-0 small">Manage registered students, personal details, and departmental enrollment</p>
        </div>
        <div>
            <a href="{{ route('students.create') }}" class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Add Student
            </a>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('students.index') }}" class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text"
                               class="form-control border-start-0"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Search by student name or code...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="department_id" class="form-select">
                        <option value="">-- All Departments --</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" {{ (string)$departmentId === (string)$dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        Filter
                    </button>
                    @if ($search || $departmentId)
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Students Table Card -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-body p-0">
            @if ($students->isEmpty())
                <div class="text-center py-5 text-muted">
                    <div class="p-3 bg-light rounded-circle d-inline-flex mb-3">
                        <i class="bi bi-people-slash fs-1 text-secondary opacity-50"></i>
                    </div>
                    @if ($search || $departmentId)
                        <h6 class="fw-bold text-dark mb-1">No matching students</h6>
                        <p class="small text-muted mb-3">No students found matching your search and filter criteria.</p>
                        <div>
                            <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary">Reset Filters</a>
                        </div>
                    @else
                        <h6 class="fw-bold text-dark mb-1">No students registered yet</h6>
                        <p class="small text-muted mb-3">Get started by enrolling your first student.</p>
                        <div>
                            <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">Add Student</a>
                        </div>
                    @endif
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 70px;">#</th>
                                <th>Code</th>
                                <th>Student Name</th>
                                <th>Gender</th>
                                <th>Department</th>
                                <th>Date of Birth</th>
                                <th>Phone</th>
                                <th class="text-end pe-4" style="width: 170px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="ps-4 text-muted small fw-medium">
                                        {{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}
                                    </td>
                                    <td>
                                        <span class="code-pill">{{ $student->student_code }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($student->photo_url)
                                                <img src="{{ $student->photo_url }}"
                                                     alt="{{ $student->name }}"
                                                     class="rounded-circle object-fit-cover me-2 border"
                                                     style="width: 36px; height: 36px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);"
                                                     width="36"
                                                     height="36">
                                            @else
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-2 text-white fw-bold shadow-xs"
                                                     style="width: 36px; height: 36px; font-size: 0.85rem; background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <a href="{{ route('students.show', $student) }}" class="text-decoration-none fw-semibold text-dark hover-primary d-block">
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
                                    <td>
                                        @if ($student->phone)
                                            <span class="text-secondary small d-inline-flex align-items-center gap-1">
                                                <i class="bi bi-telephone text-muted" style="font-size: 0.78rem;"></i>
                                                {{ $student->phone }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('students.show', $student) }}" class="action-btn-circle" title="View Profile">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('students.edit', $student) }}" class="action-btn-circle" title="Edit Student">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button"
                                                    class="action-btn-circle text-danger border-danger-subtle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteStudentModal-{{ $student->id }}"
                                                    title="Delete Student">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade text-start" id="deleteStudentModal-{{ $student->id }}" tabindex="-1" aria-labelledby="studentModalLabel-{{ $student->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content rounded-4 border-0 shadow-lg">
                                                    <div class="modal-header border-0 pb-0">
                                                        <h5 class="modal-title fw-bold" id="studentModalLabel-{{ $student->id }}">Confirm Student Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body py-3">
                                                        <p class="mb-0 text-muted">Are you sure you want to delete student <strong class="text-dark">{{ $student->name }}</strong> (<span class="code-pill">{{ $student->student_code }}</span>)?</p>
                                                        <div class="text-muted small mt-2">This action cannot be undone and will delete all student records.</div>
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0">
                                                        <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger rounded-3 fw-semibold">Yes, Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@endsection
