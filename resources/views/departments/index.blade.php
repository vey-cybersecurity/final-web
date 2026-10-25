@extends('layouts.app')

@section('title', 'Departments')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">Departments</h2>
            <p class="text-muted mb-0 small">Manage academic departments, faculties, and enrolled student allocations</p>
        </div>
        <div>
            <a href="{{ route('departments.create') }}" class="btn btn-primary d-inline-flex align-items-center shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Add Department
            </a>
        </div>
    </div>

    <!-- Search Bar Card -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('departments.index') }}" class="row g-2 align-items-center">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text"
                               class="form-control border-start-0"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Search departments by name...">
                    </div>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        Search
                    </button>
                    @if ($search)
                        <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary" title="Reset search">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Department Table Card -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-body p-0">
            @if ($departments->isEmpty())
                <div class="text-center py-5 text-muted">
                    <div class="p-3 bg-light rounded-circle d-inline-flex mb-3">
                        <i class="bi bi-building-slash fs-1 text-secondary opacity-50"></i>
                    </div>
                    @if ($search)
                        <h6 class="fw-bold text-dark mb-1">No matching departments</h6>
                        <p class="small text-muted mb-3">No departments found matching "<strong>{{ $search }}</strong>".</p>
                        <div>
                            <a href="{{ route('departments.index') }}" class="btn btn-sm btn-outline-primary">Clear Search</a>
                        </div>
                    @else
                        <h6 class="fw-bold text-dark mb-1">No departments created yet</h6>
                        <p class="small text-muted mb-3">Get started by creating your first academic department.</p>
                        <div>
                            <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary">Add Department</a>
                        </div>
                    @endif
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 70px;">#</th>
                                <th>Department Name</th>
                                <th>Description</th>
                                <th class="text-center" style="width: 150px;">Students</th>
                                <th class="text-end pe-4" style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td class="ps-4 text-muted small fw-medium">
                                        {{ $loop->iteration + ($departments->currentPage() - 1) * $departments->perPage() }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="p-2 rounded-3 me-2 text-primary" style="background-color: #eef2ff;">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <div>
                                                <a href="{{ route('departments.show', $department) }}" class="text-decoration-none fw-semibold text-dark hover-primary d-block">
                                                    {{ $department->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted small text-truncate" style="max-width: 320px;">
                                        {{ $department->description ?: 'No description provided' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('students.index', ['department_id' => $department->id]) }}"
                                           class="badge rounded-pill text-decoration-none px-3 py-1"
                                           style="background-color: #eef2ff; color: #4f46e5; border: 1px solid #c7d2fe; font-size: 0.78rem;">
                                            <i class="bi bi-people me-1"></i>
                                            {{ $department->students_count }} {{ Str::plural('student', $department->students_count) }}
                                        </a>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('departments.show', $department) }}" class="action-btn-circle" title="View Department">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('departments.edit', $department) }}" class="action-btn-circle" title="Edit Department">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button"
                                                    class="action-btn-circle text-danger border-danger-subtle"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteDepartmentModal-{{ $department->id }}"
                                                    title="Delete Department">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade text-start" id="deleteDepartmentModal-{{ $department->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $department->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content rounded-4 border-0 shadow-lg">
                                                    <div class="modal-header border-0 pb-0">
                                                        <h5 class="modal-title fw-bold" id="modalLabel-{{ $department->id }}">Delete Department</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body py-3">
                                                        @if ($department->students_count > 0)
                                                            <div class="alert alert-warning mb-0 rounded-3 border-0 bg-warning-subtle">
                                                                <i class="bi bi-exclamation-triangle-fill me-1 text-warning"></i>
                                                                <strong>Cannot delete department:</strong> It currently has <strong>{{ $department->students_count }}</strong> registered student(s).
                                                                <div class="mt-2 small text-muted">
                                                                    Please reassign or delete enrolled students before removing this department.
                                                                </div>
                                                            </div>
                                                        @else
                                                            <p class="mb-0 text-muted">Are you sure you want to delete the department <strong class="text-dark">{{ $department->name }}</strong>? This action cannot be undone.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0">
                                                        <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                                                        @if ($department->students_count == 0)
                                                            <form action="{{ route('departments.destroy', $department) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger rounded-3 fw-semibold">Yes, Delete</button>
                                                            </form>
                                                        @endif
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

                @if ($departments->hasPages())
                    <div class="p-3 px-4 border-top">
                        {{ $departments->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
