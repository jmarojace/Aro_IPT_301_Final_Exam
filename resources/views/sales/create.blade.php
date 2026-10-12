@extends('layouts.app')
@section('title', 'Record Sale')
@section('content')
<div class="mb-4"><a href="{{ route('sales.index') }}" class="text-decoration-none">← Sales</a><h1 class="h2 fw-bold mt-3">Record a sale</h1></div>
@if ($products->isEmpty())<div class="alert alert-warning">There are no products in stock. Add products and stock before recording a sale.</div>@endif
<div class="card card-body p-4"><form method="POST" action="{{ route('sales.store') }}">@csrf
<div class="row g-3 mb-4"><div class="col-md-6"><label class="form-label" for="customer_name">Customer name</label><input class="form-control" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Walk-in customer"></div><div class="col-md-6"><label class="form-label required" for="sale_date">Sale date</label><input type="date" class="form-control" id="sale_date" name="sale_date" value="{{ old('sale_date', now()->toDateString()) }}" required></div></div>
<div class="d-flex justify-content-between align-items-center mb-2"><h2 class="h5 mb-0">Items sold</h2><button class="btn btn-sm btn-outline-primary" type="button" id="add-item">Add item</button></div>
<div class="table-responsive"><table class="table align-middle"><thead><tr><th style="min-width:240px">Product</th><th style="width:160px">Quantity</th><th></th></tr></thead><tbody id="sale-items">
@php($formItems = old('items', [['product_id' => '', 'quantity' => 1]]))
@foreach ($formItems as $index => $formItem)
<tr><td><select class="form-select" name="items[{{ $index }}][product_id]" required><option value="">Choose a product</option>@foreach ($products as $product)<option value="{{ $product->id }}" @selected(($formItem['product_id'] ?? '') == $product->id)>{{ $product->name }} — {{ $product->stock_quantity }} in stock (₱{{ number_format($product->price, 2) }})</option>@endforeach</select></td><td><input class="form-control" type="number" min="1" name="items[{{ $index }}][quantity]" value="{{ $formItem['quantity'] ?? 1 }}" required></td><td><button type="button" class="btn btn-sm btn-outline-danger remove-item" aria-label="Remove item">Remove</button></td></tr>
@endforeach
</tbody></table></div>
<div class="mt-3"><button class="btn btn-primary" @disabled($products->isEmpty())>Save sale</button> <a class="btn btn-light" href="{{ route('sales.index') }}">Cancel</a></div>
</form></div>
<template id="sale-item-template"><tr><td><select class="form-select" name="items[__INDEX__][product_id]" required><option value="">Choose a product</option>@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->name }} — {{ $product->stock_quantity }} in stock (₱{{ number_format($product->price, 2) }})</option>@endforeach</select></td><td><input class="form-control" type="number" min="1" name="items[__INDEX__][quantity]" value="1" required></td><td><button type="button" class="btn btn-sm btn-outline-danger remove-item" aria-label="Remove item">Remove</button></td></tr></template>
@push('scripts')
<script>
(() => {
    const body = document.getElementById('sale-items');
    const template = document.getElementById('sale-item-template').innerHTML;
    let nextIndex = {{ count($formItems) }};
    document.getElementById('add-item').addEventListener('click', () => {
        body.insertAdjacentHTML('beforeend', template.replaceAll('__INDEX__', nextIndex++));
    });
    body.addEventListener('click', (event) => {
        if (event.target.closest('.remove-item') && body.querySelectorAll('tr').length > 1) {
            event.target.closest('tr').remove();
        }
    });
})();
</script>
@endpush
@endsection
