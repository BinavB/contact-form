<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Submissions – Admin</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet" />
    <style>
        body { background: #f4f6fb; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 240px; min-height: 100vh; background: #1e293b; color: #cbd5e1; }
        .sidebar a { color: #cbd5e1; text-decoration: none; }
        .sidebar a:hover, .sidebar a.active { color: #fff; background: rgba(255,255,255,.08); border-radius: 8px; }
        .main { flex: 1; overflow-x: auto; }
        .stat-card { border: none; border-radius: 12px; }
        .badge-unread { background: #ef4444; }
        .table thead th { font-weight: 600; font-size: .8rem; text-transform: uppercase;
                          letter-spacing: .05em; color: #64748b; border-bottom: 2px solid #e2e8f0; }
        .filter-card { border: none; border-radius: 12px; }
    </style>
</head>
<body>
<div class="d-flex">

    {{-- ─── Sidebar ────────────────────────────────────────────────────── --}}
    <aside class="sidebar d-flex flex-column p-3 gap-1">
        <div class="d-flex align-items-center gap-2 mb-4 px-2 pt-2">
            <i class="bi bi-envelope-fill fs-4 text-blue-300"></i>
            <span class="fw-bold text-white fs-5">ContactForm</span>
        </div>

        <a href="{{ route('contact-form.admin.index') }}"
           class="d-flex align-items-center gap-2 px-2 py-2 active">
            <i class="bi bi-inbox"></i> Submissions
        </a>

        <hr class="my-3 border-secondary" />

        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 px-2 py-2">
            <i class="bi bi-house"></i> Back to site
        </a>
    </aside>

    {{-- ─── Main Content ───────────────────────────────────────────────── --}}
    <main class="main p-4">

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
