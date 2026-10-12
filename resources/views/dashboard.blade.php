@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
        <div><p class="text-secondary mb-1">Store overview</p><h1 class="h2 fw-bold mb-0">Dashboard</h1></div>
        <span class="text-secondary">{{ now()->format('l, F j, Y') }}</span>
    </div>

    <section class="rounded-4 p-4 p-lg-5 text-white mb-4" style="background:linear-gradient(115deg,#3158d8,#6846c6)">
        <h2 class="h4 fw-bold">Welcome to your Electronics Store</h2>
        <p class="mb-0 text-white-50">Manage your product catalog, suppliers, stock, and sales from one place.</p>
    </section>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3"><a href="{{ route('products.index') }}" class="card card-body dashboard-card h-100 text-decoration-none text-dark"><span class="text-primary fs-3">▣</span><strong class="mt-2">Products</strong><span class="text-secondary small">View and manage store inventory</span></a></div>
        <div class="col-12 col-sm-6 col-xl-3"><a href="{{ route('categories.index') }}" class="card card-body dashboard-card h-100 text-decoration-none text-dark"><span class="text-primary fs-3">▤</span><strong class="mt-2">Categories</strong><span class="text-secondary small">Organize your catalog</span></a></div>
        <div class="col-12 col-sm-6 col-xl-3"><a href="{{ route('suppliers.index') }}" class="card card-body dashboard-card h-100 text-decoration-none text-dark"><span class="text-primary fs-3">♧</span><strong class="mt-2">Suppliers</strong><span class="text-secondary small">Keep supplier details up to date</span></a></div>
        <div class="col-12 col-sm-6 col-xl-3"><a href="{{ route('sales.index') }}" class="card card-body dashboard-card h-100 text-decoration-none text-dark"><span class="text-primary fs-3">↗</span><strong class="mt-2">Sales</strong><span class="text-secondary small">Record and review transactions</span></a></div>
    </div>

    <div class="alert alert-primary border-0 mb-0">Start by adding categories and suppliers, then create products. Once products are in stock, you can record sales.</div>
@endsection
