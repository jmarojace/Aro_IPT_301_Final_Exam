@extends('layouts.app')
@section('title', $category->name)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><a href="{{ route('categories.index') }}" class="text-decoration-none">← Categories</a><h1 class="h2 fw-bold mt-3 mb-0">{{ $category->name }}</h1></div><a class="btn btn-primary" href="{{ route('categories.edit', $category) }}">Edit category</a></div>
<div class="card card-body mb-4"><h2 class="h6 text-secondary">Description</h2><p class="mb-0">{{ $category->description ?: 'No description provided.' }}</p></div>
<h2 class="h5 mb-3">Products in this category</h2><div class="card"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Product</th><th>SKU</th><th>Price</th><th>Stock</th></tr></thead><tbody>
@forelse ($category->products as $product)<tr><td>{{ $product->name }}</td><td>{{ $product->sku }}</td><td>₱{{ number_format($product->price, 2) }}</td><td>{{ $product->stock_quantity }}</td></tr>@empty<tr><td colspan="4" class="text-center text-secondary py-4">No products in this category.</td></tr>@endforelse
</tbody></table></div></div>
@endsection
