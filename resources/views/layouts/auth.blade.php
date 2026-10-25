<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Authentication') - {{ config('app.name', 'Student Management') }}</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        }

        body {
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.25) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.2) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(15, 23, 42, 0.95) 0px, transparent 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        .auth-card {
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 1.25rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
        }

        .brand-badge {
            width: 52px;
            height: 52px;
            background: var(--primary-gradient);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.75rem;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.4);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.65rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .form-control {
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 1rem;
            font-size: 0.925rem;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .input-group-text {
            border-radius: 0.75rem 0 0 0.75rem;
            border-color: #cbd5e1;
            background-color: #f8fafc;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="text-center mb-4">
                    <div class="brand-badge mb-3 shadow-lg">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h3 class="fw-bold text-white mb-1" style="letter-spacing: -0.5px;">Student Management</h3>
                    <p class="text-white-50 small mb-0">Academic & Student Record Portal</p>
                </div>

                @include('partials.alerts')

                <div class="card auth-card p-3 p-sm-4">
                    @yield('content')
                </div>

                <div class="text-center mt-4 text-white-50 small">
                    &copy; {{ date('Y') }} Student Management System &bull; Final Project
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
