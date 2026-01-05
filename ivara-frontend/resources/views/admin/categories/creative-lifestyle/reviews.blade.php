@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reviews - Creative & Lifestyle</h1>
        <a href="{{ route('admin.creative-lifestyle.reviews.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Review
        </a>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>ID</th><th>Name</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr><td>{{ $review->id }}</td><td>{{ $review->name }}</td><td>{{ $review->status }}</td>
                            <td><a href="{{ route('admin.creative-lifestyle.reviews.edit', $review->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a></td></tr>
                        @empty <tr><td colspan="4" class="text-center">No reviews found.</td></tr> @endforelse
                    </tbody>
                </table>
            </div>
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection
