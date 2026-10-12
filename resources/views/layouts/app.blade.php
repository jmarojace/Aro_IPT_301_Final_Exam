<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Electronics Store') | Electronics Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7fb; color: #182235; }
        .navbar { background: #14213d; }
        .navbar-brand { font-weight: 700; letter-spacing: .01em; }
        .page-wrap { max-width: 1180px; }
        .card { border: 1px solid #e6ebf2; box-shadow: 0 5px 18px rgba(20,33,61,.045); }
        .table thead th { color: #64748b; font-size: .78rem; text-transform: uppercase; letter-spacing: .045em; }
        .required::after { content: ' *'; color: #dc3545; }
        .dashboard-card { transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease; }
        .dashboard-card:hover { transform: translateY(-4px); border-color: #b8c8ff; box-shadow: 0 12px 26px rgba(49,88,216,.14); }
        .dashboard-card:focus-visible { outline: 3px solid #7895ff; outline-offset: 3px; }
        .navbar .nav-link { border-radius: .375rem; transition: color .18s ease, background-color .18s ease; }
        .navbar .nav-link:hover { color: #fff; background-color: rgba(255,255,255,.12); }
        .btn { transition: transform .15s ease, box-shadow .15s ease; }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 10px rgba(20,33,61,.12); }
        .table-hover tbody tr { transition: background-color .15s ease; }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container page-wrap">
            <a class="navbar-brand" href="{{ route('dashboard') }}">⚡ Electronics Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a>
                    <a class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">Suppliers</a>
                    <a class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}" href="{{ route('sales.index') }}">Sales</a>
                    <a class="nav-link {{ request()->routeIs('sale-items.*') ? 'active' : '' }}" href="{{ route('sale-items.index') }}">Sale items</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container page-wrap py-4 py-lg-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert"><strong>Please fix the following:</strong><ul class="mb-0 mt-2">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
