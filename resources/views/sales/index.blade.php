@extends('layouts.app')
@section('title', 'Sales')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h2 fw-bold mb-1">Sales</h1><p class="text-secondary mb-0">Review transactions and record a new sale.</p></div><a class="btn btn-primary" href="{{ route('sales.create') }}">Record sale</a></div>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Invoice</th><th>Customer</th><th>Sale date</th><th>Items</th><th>Total</th><th class="text-end">Actions</th></tr></thead><tbody>
@forelse ($sales as $sale)<tr><td class="fw-semibold">{{ $sale->invoice_number }}</td><td>{{ $sale->customer_name ?: 'Walk-in customer' }}</td><td>{{ $sale->sale_date->format('M j, Y') }}</td><td>{{ $sale->items_count }}</td><td>₱{{ number_format($sale->total_amount, 2) }}</td><td class="text-end text-nowrap"><a class="btn btn-sm btn-outline-secondary" href="{{ route('sales.show', $sale) }}">View</a> <a class="btn btn-sm btn-outline-primary" href="{{ route('sales.edit', $sale) }}">Edit</a> <form class="d-inline" method="POST" action="{{ route('sales.destroy', $sale) }}" onsubmit="return confirm('Delete this sale? The sold quantities will be returned to stock.')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
@empty<tr><td colspan="6" class="text-center text-secondary py-5">No sales recorded yet.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-3">{{ $sales->links() }}</div>
@endsection
