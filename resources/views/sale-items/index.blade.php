@extends('layouts.app')
@section('title', 'Sale Items')
@section('content')
<div class="mb-4"><h1 class="h2 fw-bold mb-1">Sale items</h1><p class="text-secondary mb-0">Line items are created and managed with their parent sale.</p></div>
<div class="card"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead><tr><th>Sale</th><th>Product</th><th>Quantity</th><th>Unit price</th><th>Subtotal</th><th></th></tr></thead><tbody>
@forelse ($items as $item)<tr><td><a href="{{ route('sales.show', $item->sale) }}">{{ $item->sale->invoice_number }}</a></td><td>{{ $item->product->name }}</td><td>{{ $item->quantity }}</td><td>₱{{ number_format($item->unit_price, 2) }}</td><td>₱{{ number_format($item->subtotal, 2) }}</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('sale-items.show', $item) }}">Details</a></td></tr>@empty<tr><td colspan="6" class="text-center text-secondary py-5">No sale items recorded yet.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-3">{{ $items->links() }}</div>
@endsection
