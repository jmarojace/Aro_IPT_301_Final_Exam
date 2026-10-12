@extends('layouts.app')
@section('title', $supplier->name)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><a href="{{ route('suppliers.index') }}" class="text-decoration-none">← Suppliers</a><h1 class="h2 fw-bold mt-3 mb-0">{{ $supplier->name }}</h1></div><a class="btn btn-primary" href="{{ route('suppliers.edit', $supplier) }}">Edit supplier</a></div>
<div class="card card-body mb-4"><div class="row g-3"><div class="col-md-6"><span class="text-secondary small">Contact person</span><div>{{ $supplier->contact_person ?: '—' }}</div></div><div class="col-md-6"><span class="text-secondary small">Email</span><div>{{ $supplier->email ?: '—' }}</div></div><div class="col-md-6"><span class="text-secondary small">Phone</span><div>{{ $supplier->phone ?: '—' }}</div></div><div class="col-md-6"><span class="text-secondary small">Address</span><div>{{ $supplier->address ?: '—' }}</div></div></div></div>
<h2 class="h5 mb-3">Products supplied</h2><div class="card"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Product</th><th>SKU</th><th>Category</th><th>Stock</th></tr></thead><tbody>
@forelse ($supplier->products as $product)<tr><td>{{ $product->name }}</td><td>{{ $product->sku }}</td><td>{{ $product->category->name }}</td><td>{{ $product->stock_quantity }}</td></tr>@empty<tr><td colspan="4" class="text-center text-secondary py-4">No products from this supplier.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
