@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products - Creative & Lifestyle</h1>
        <a href="{{ route('admin.creative-lifestyle.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Product
        </a>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr><td>{{ $product->id }}</td><td>{{ $product->name }}</td><td>{{ $product->price }}</td><td>{{ $product->status }}</td>
                            <td><a href="{{ route('admin.creative-lifestyle.products.edit', $product->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a></td></tr>
                        @empty <tr><td colspan="5" class="text-center">No products found.</td></tr> @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
