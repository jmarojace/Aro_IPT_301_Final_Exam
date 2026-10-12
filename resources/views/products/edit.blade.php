@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<div class="mb-4"><a href="{{ route('products.index') }}" class="text-decoration-none">← Products</a><h1 class="h2 fw-bold mt-3">Edit product</h1></div>
<div class="card card-body p-4"><form method="POST" action="{{ route('products.update', $product) }}">@csrf @method('PUT')
<div class="row g-3"><div class="col-md-6"><label class="form-label required" for="name">Product name</label><input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label required" for="sku">SKU</label><input class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>@error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label required" for="category_id">Category</label><select class="form-select" id="category_id" name="category_id" required>@foreach ($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label required" for="supplier_id">Supplier</label><select class="form-select" id="supplier_id" name="supplier_id" required>@foreach ($suppliers as $supplier)<option value="{{ $supplier->id }}" @selected(old('supplier_id', $product->supplier_id) == $supplier->id)>{{ $supplier->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label required" for="price">Price</label><div class="input-group"><span class="input-group-text">₱</span><input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required></div></div>
<div class="col-md-6"><label class="form-label required" for="stock_quantity">Stock quantity</label><input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required></div></div>
<div class="mt-4"><button class="btn btn-primary">Save changes</button> <a class="btn btn-light" href="{{ route('products.index') }}">Cancel</a></div>
</form></div>
@endsection
