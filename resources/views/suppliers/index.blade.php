@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h2 fw-bold mb-1">Suppliers</h1><p class="text-secondary mb-0">Manage the businesses that supply your products.</p></div><a class="btn btn-primary" href="{{ route('suppliers.create') }}">Add supplier</a></div>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Supplier</th><th>Contact</th><th>Email</th><th>Phone</th><th>Products</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse ($suppliers as $supplier)<tr><td class="fw-semibold">{{ $supplier->name }}</td><td>{{ $supplier->contact_person ?: '—' }}</td><td>{{ $supplier->email ?: '—' }}</td><td>{{ $supplier->phone ?: '—' }}</td><td>{{ $supplier->products_count }}</td><td class="text-end text-nowrap"><a class="btn btn-sm btn-outline-secondary" href="{{ route('suppliers.show', $supplier) }}">View</a> <a class="btn btn-sm btn-outline-primary" href="{{ route('suppliers.edit', $supplier) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('suppliers.destroy', $supplier) }}" onsubmit="return confirm('Delete this supplier?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
@empty<tr><td colspan="6" class="text-center text-secondary py-5">No suppliers yet. Add a supplier to get started.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-3">{{ $suppliers->links() }}</div>
@endsection
