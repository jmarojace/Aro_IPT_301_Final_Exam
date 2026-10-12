@extends('layouts.app')
@section('title', 'Sale Item')
@section('content')
<div class="mb-4"><a href="{{ route('sales.show', $saleItem->sale) }}" class="text-decoration-none">← {{ $saleItem->sale->invoice_number }}</a><h1 class="h2 fw-bold mt-3">Sale item details</h1></div>
<div class="card card-body"><div class="row g-4"><div class="col-md-6"><span class="text-secondary small">Product</span><div>{{ $saleItem->product->name }} ({{ $saleItem->product->sku }})</div></div><div class="col-md-6"><span class="text-secondary small">Invoice</span><div><a href="{{ route('sales.show', $saleItem->sale) }}">{{ $saleItem->sale->invoice_number }}</a></div></div><div class="col-md-4"><span class="text-secondary small">Quantity</span><div>{{ $saleItem->quantity }}</div></div><div class="col-md-4"><span class="text-secondary small">Unit price</span><div>₱{{ number_format($saleItem->unit_price, 2) }}</div></div><div class="col-md-4"><span class="text-secondary small">Subtotal</span><div class="fw-bold">₱{{ number_format($saleItem->subtotal, 2) }}</div></div></div></div>
@endsection
