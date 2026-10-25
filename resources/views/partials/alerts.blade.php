@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4 p-3 mb-4 d-flex align-items-center" role="alert" style="background-color: #ecfdf5; border-left: 4px solid #10b981 !important;">
        <div class="p-2 rounded-circle me-3 text-white d-inline-flex" style="background-color: #10b981;">
            <i class="bi bi-check-lg fs-6"></i>
        </div>
        <div class="text-success-emphasis fw-medium small pe-3">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-4 p-3 mb-4 d-flex align-items-center" role="alert" style="background-color: #fff1f2; border-left: 4px solid #f43f5e !important;">
        <div class="p-2 rounded-circle me-3 text-white d-inline-flex" style="background-color: #f43f5e;">
            <i class="bi bi-exclamation-triangle-fill fs-6"></i>
        </div>
        <div class="text-danger-emphasis fw-medium small pe-3">
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-4 p-3 mb-4" role="alert" style="background-color: #fff1f2; border-left: 4px solid #f43f5e !important;">
        <div class="d-flex align-items-start">
            <div class="p-2 rounded-circle me-3 text-white d-inline-flex mt-0.5" style="background-color: #f43f5e;">
                <i class="bi bi-x-circle-fill fs-6"></i>
            </div>
            <div class="pe-3">
                <div class="fw-semibold text-danger-emphasis mb-1 small">Please correct the following errors:</div>
                <ul class="mb-0 ps-3 small text-danger-emphasis">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
