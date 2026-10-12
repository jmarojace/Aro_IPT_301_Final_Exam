@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h2 fw-bold mb-1">Categories</h1><p class="text-secondary mb-0">Organize the products in your catalog.</p></div><a class="btn btn-primary" href="{{ route('categories.create') }}">Add category</a></div>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Name</th><th>Description</th><th>Products</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse ($categories as $category)
<tr><td class="fw-semibold">{{ $category->name }}</td><td>{{ \Illuminate\Support\Str::limit($category->description ?: '—', 70) }}</td><td>{{ $category->products_count }}</td><td class="text-end text-nowrap"><a class="btn btn-sm btn-outline-secondary" href="{{ route('categories.show', $category) }}">View</a> <a class="btn btn-sm btn-outline-primary" href="{{ route('categories.edit', $category) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
@empty
<tr><td colspan="4" class="text-center text-secondary py-5">No categories yet. Add one to start organizing products.</td></tr>
@endforelse
</tbody></table></div></div><div class="mt-3">{{ $categories->links() }}</div>
@endsection
