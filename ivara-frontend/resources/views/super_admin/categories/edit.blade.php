@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Edit Category</h1>
            <p>Modify category details for: <span class="text-primary">{{ $category['name'] }}</span></p>
        </div>
    </header>

    <div class="pro-card glass-panel" style="max-width: 800px; margin: 0 auto;">
        <form action="{{ route('super_admin.categories.update', $category['slug']) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="form-label fw-bold">Category Name</label>
                <input type="text" name="name" class="form-control pro-input" value="{{ $category['name'] }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Route Slug</label>
                <input type="text" class="form-control pro-input" value="{{ $category['slug'] }}" readonly>
                <small class="text-muted">Slug cannot be changed once created to prevent broken links.</small>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" class="form-control pro-input" value="{{ $category['icon'] ?? 'fas fa-layer-group' }}">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control pro-input" rows="4">Description for {{ $category['name'] }} goes here...</textarea>
            </div>

            <div class="form-check form-switch mb-4">
                <input type="hidden" name="status" value="Inactive">
                <input class="form-check-input" type="checkbox" id="isActive" name="status" value="Active" {{ ($category['status'] ?? 'Active') === 'Active' ? 'checked' : '' }}>
                <label class="form-check-label" for="isActive">Active Status</label>
            </div>

            <div class="text-end mt-5">
                <a href="{{ route('super_admin.categories.index') }}" class="btn-secondary-premium me-3">Cancel</a>
                <button type="submit" class="btn-premium">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
