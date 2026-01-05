@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bookings - Creative & Lifestyle</h1>
        <a href="{{ route('admin.creative-lifestyle.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Booking
        </a>
    </div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr><td>{{ $booking->id }}</td><td>{{ $booking->name }}</td><td>{{ $booking->price }}</td><td>{{ $booking->status }}</td>
                            <td><a href="{{ route('admin.creative-lifestyle.bookings.edit', $booking->id) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a></td></tr>
                        @empty <tr><td colspan="5" class="text-center">No bookings found.</td></tr> @endforelse
                    </tbody>
                </table>
            </div>
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
