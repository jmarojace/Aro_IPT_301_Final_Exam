@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h2 fw-bold mb-1">Products</h1><p class="text-secondary mb-0">Track your catalog and available stock.</p></div><a class="btn btn-primary" href="{{ route('products.create') }}">Add product</a></div>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Product</th><th>SKU</th><th>Category</th><th>Supplier</th><th>Price</th><th>Stock</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse ($products as $product)<tr><td class="fw-semibold">{{ $product->name }}</td><td>{{ $product->sku }}</td><td>{{ $product->category->name }}</td><td>{{ $product->supplier->name }}</td><td>₱{{ number_format($product->price, 2) }}</td><td><span class="badge {{ $product->stock_quantity < 5 ? 'text-bg-warning' : 'text-bg-success' }}">{{ $product->stock_quantity }}</span></td><td class="text-end text-nowrap"><a class="btn btn-sm btn-outline-secondary" href="{{ route('products.show', $product) }}">View</a> <a class="btn btn-sm btn-outline-primary" href="{{ route('products.edit', $product) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
@empty<tr><td colspan="7" class="text-center text-secondary py-5">No products yet. Add categories and suppliers first, then add a product.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-3">{{ $products->links() }}</div>
@endsection
