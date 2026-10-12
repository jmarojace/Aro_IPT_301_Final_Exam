@extends('layouts.app')
@section('title', $sale->invoice_number)
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4"><div><a href="{{ route('sales.index') }}" class="text-decoration-none">← Sales</a><h1 class="h2 fw-bold mt-3 mb-0">{{ $sale->invoice_number }}</h1></div><a class="btn btn-outline-primary" href="{{ route('sales.edit', $sale) }}">Edit sale details</a></div>
<div class="card card-body mb-4"><div class="row g-3"><div class="col-md-4"><span class="text-secondary small">Customer</span><div>{{ $sale->customer_name ?: 'Walk-in customer' }}</div></div><div class="col-md-4"><span class="text-secondary small">Sale date</span><div>{{ $sale->sale_date->format('M j, Y') }}</div></div><div class="col-md-4"><span class="text-secondary small">Invoice total</span><div class="fw-bold">₱{{ number_format($sale->total_amount, 2) }}</div></div></div></div>
<h2 class="h5 mb-3">Items</h2><div class="card"><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Product</th><th>SKU</th><th>Unit price</th><th>Quantity</th><th class="text-end">Subtotal</th></tr></thead><tbody>
@foreach ($sale->items as $item)<tr><td><a href="{{ route('sale-items.show', $item) }}">{{ $item->product->name }}</a></td><td>{{ $item->product->sku }}</td><td>₱{{ number_format($item->unit_price, 2) }}</td><td>{{ $item->quantity }}</td><td class="text-end">₱{{ number_format($item->subtotal, 2) }}</td></tr>@endforeach
</tbody><tfoot><tr><th colspan="4" class="text-end">Total</th><th class="text-end">₱{{ number_format($sale->total_amount, 2) }}</th></tr></tfoot></table></div></div>
@endsection
