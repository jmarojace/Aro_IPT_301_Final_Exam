@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')
<div class="mb-4"><a href="{{ route('suppliers.index') }}" class="text-decoration-none">← Suppliers</a><h1 class="h2 fw-bold mt-3">Edit supplier</h1></div>
<div class="card card-body p-4"><form method="POST" action="{{ route('suppliers.update', $supplier) }}">@csrf @method('PUT')
<div class="row g-3"><div class="col-md-6"><label class="form-label required" for="name">Business name</label><input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label" for="contact_person">Contact person</label><input class="form-control" id="contact_person" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}"></div>
<div class="col-md-6"><label class="form-label" for="email">Email</label><input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $supplier->email) }}">@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="col-md-6"><label class="form-label" for="phone">Phone</label><input class="form-control" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}"></div>
<div class="col-12"><label class="form-label" for="address">Address</label><textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $supplier->address) }}</textarea></div></div>
<div class="mt-4"><button class="btn btn-primary">Save changes</button> <a class="btn btn-light" href="{{ route('suppliers.index') }}">Cancel</a></div>
</form></div>
@endsection
