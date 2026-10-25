<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Student Management System') - {{ config('app.name', 'Student Management') }}</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-50: #eef2ff;
            --primary-100: #e0e7ff;
            --primary-200: #c7d2fe;
            --primary-500: #6366f1;
            --primary-600: #4f46e5;
            --primary-700: #4338ca;
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            --primary-glow: rgba(79, 70, 229, 0.25);
            --card-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.04), 0 10px 25px -5px rgba(15, 23, 42, 0.05);
            --card-shadow-hover: 0 4px 6px -1px rgba(15, 23, 42, 0.05), 0 20px 30px -10px rgba(15, 23, 42, 0.1);
        }

        body {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.05) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(244, 63, 94, 0.02) 0px, transparent 50%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        main {
            flex: 1 0 auto;
        }

        /* Modern Glass Navbar */
        .modern-navbar {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
            padding: 0.75rem 0;
            transition: all 0.2s ease;
        }

        .brand-badge {
            width: 38px;
            height: 38px;
            background: var(--primary-gradient);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            margin-right: 0.75rem;
        }

        .brand-title {
            font-weight: 800;
            letter-spacing: -0.5px;
            font-size: 1.15rem;
            color: #0f172a;
        }

        .brand-title span {
            color: var(--primary-600);
        }

        /* Modern Nav Pills */
        .nav-pill-item {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.88rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-pill-item:hover {
            color: var(--primary-600);
            background-color: #f1f5f9;
        }

        .nav-pill-item.active {
            color: var(--primary-600);
            background-color: #eef2ff;
            font-weight: 600;
            box-shadow: inset 0 0 0 1px rgba(99, 102, 241, 0.2);
        }

        /* User Profile Pill */
        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.35rem 0.85rem 0.35rem 0.45rem;
            border-radius: 9999px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #334155;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 600;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease;
        }

        .user-pill:hover, .user-pill:focus {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .user-avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 9999px;
            background: var(--primary-gradient);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25);
        }

        /* Modern Cards */
        .card {
            background-color: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.15rem 1.5rem;
            font-weight: 600;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
        }

        /* Modern Buttons */
        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
        }

        /* Ensure icon spacing in buttons */
        .btn i {
            display: inline-flex;
            align-items: center;
            line-height: 1;
            vertical-align: middle;
        }

        .btn i:first-child:not(:only-child) {
            margin-right: 0.5rem;
        }

        .table i.bi {
            vertical-align: -0.125em;
        }

        .btn-outline-primary {
            background: #ffffff;
            border: 1px solid #e0e7ff;
            color: var(--primary-600);
            font-weight: 600;
            padding: 0.6rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background: #eef2ff;
            border-color: #c7d2fe;
            color: var(--primary-700);
            transform: translateY(-1px);
        }

        .btn-sm {
            padding: 0.4rem 0.85rem;
            font-size: 0.825rem;
            border-radius: 0.6rem;
        }

        /* Modern Table */
        .table {
            --bs-table-bg: transparent;
            margin-bottom: 0;
        }

        .table thead th {
            font-size: 0.73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #64748b;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1.25rem;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 0.9rem;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: #fbfcfe;
        }

        /* Modern Badges */
        .code-pill {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 600;
            background: #f1f5f9;
            color: var(--primary-600);
            padding: 0.25rem 0.55rem;
            border-radius: 0.4rem;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .badge-gender-male {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-gender-female {
            background-color: #fff1f2;
            color: #e11d48;
            border: 1px solid #ffe4e6;
            font-weight: 600;
            padding: 0.3rem 0.7rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-department-pill {
            background-color: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            padding: 0.3rem 0.7rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .action-btn-circle {
            width: 34px;
            height: 34px;
            border-radius: 0.55rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .action-btn-circle:hover {
            background: var(--primary-50);
            border-color: var(--primary-200);
            color: var(--primary-600);
            transform: translateY(-1px);
        }

        /* Modern Form Inputs */
        .form-control, .form-select {
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 1rem;
            font-size: 0.925rem;
            color: #1e293b;
            transition: all 0.15s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .input-group-text {
            border-radius: 0.75rem 0 0 0.75rem;
            border-color: #cbd5e1;
            background-color: #f8fafc;
        }

        /* Pagination Modern */
        .pagination {
            margin-bottom: 0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-item .page-link {
            min-width: 36px;
            height: 36px;
            padding: 0 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.65rem !important;
            font-weight: 600;
            font-size: 0.875rem;
            color: #475569;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.15s ease;
            text-decoration: none;
            line-height: 1;
        }

        .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: var(--primary-600);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.06);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-gradient) !important;
            border-color: transparent !important;
            color: #ffffff !important;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35) !important;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            color: #cbd5e1 !important;
            opacity: 0.8;
            cursor: not-allowed;
            pointer-events: none;
            box-shadow: none !important;
        }

        .pagination .page-link i {
            font-size: 0.85rem;
            line-height: 1;
            margin: 0 !important;
            display: inline-block;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .pagination-info span {
            color: #0f172a;
            font-weight: 700;
        }

        /* Footer Modern */
        footer {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.8);
            border-top: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(12px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg modern-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}">
                <div class="brand-badge">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div class="brand-title">
                    Student<span>Management</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-pill-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-pill-item {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                            <i class="bi bi-building"></i> Departments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-pill-item {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <i class="bi bi-people"></i> Students
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item dropdown">
                        <a class="user-pill dropdown-toggle" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar-circle">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2 mt-2" aria-labelledby="navbarUserDropdown" style="min-width: 220px;">
                            <li class="px-3 py-2 border-bottom mb-1">
                                <div class="text-xs text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Signed in as</div>
                                <div class="fw-semibold text-dark text-truncate">{{ Auth::user()->name }}</div>
                                <div class="text-muted small text-truncate">{{ Auth::user()->email }}</div>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center py-2 rounded-3">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @include('partials.alerts')
            @yield('content')
        </div>
    </main>

    <footer class="py-3 text-center text-muted small">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
            <div>
                &copy; {{ date('Y') }} <span class="fw-semibold text-dark">Student Management System</span> &bull; Academic Portal
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="d-inline-flex align-items-center text-success small">
                    <span class="p-1 bg-success rounded-circle me-1" style="width: 6px; height: 6px;"></span>
                    System Active
                </span>
                <span>Final School Project</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
