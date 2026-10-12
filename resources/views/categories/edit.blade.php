@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<div class="mb-4"><a href="{{ route('categories.index') }}" class="text-decoration-none">← Categories</a><h1 class="h2 fw-bold mt-3">Edit category</h1></div>
<div class="card card-body p-4"><form method="POST" action="{{ route('categories.update', $category) }}">@csrf @method('PUT')
<div class="mb-3"><label class="form-label required" for="name">Name</label><input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<div class="mb-4"><label class="form-label" for="description">Description</label><textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
<button class="btn btn-primary">Save changes</button> <a class="btn btn-light" href="{{ route('categories.index') }}">Cancel</a>
</form></div>
@endsection
