@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Edit Category</h1>
            <p>Modify category details for: <span class="text-primary">{{ ucwords(str_replace('-', ' ', $slug)) }}</span></p>
        </div>
    </header>

    <div class="pro-card glass-panel" style="max-width: 800px; margin: 0 auto;">
        <form action="#" method="POST">
            @csrf
            <!-- Simulated PUT method -->
            <input type="hidden" name="_method" value="PUT"> 
            
            <div class="mb-4">
                <label class="form-label fw-bold">Category Name</label>
                <input type="text" class="form-control pro-input" value="{{ ucwords(str_replace('-', ' ', $slug)) }}">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Route Slug</label>
                <input type="text" class="form-control pro-input" value="{{ $slug }}" readonly>
                <small class="text-muted">Slug cannot be changed once created to prevent broken links.</small>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Icon Class (FontAwesome)</label>
                <input type="text" class="form-control pro-input" value="fas fa-layer-group">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control pro-input" rows="4">Description for {{ str_replace('-', ' ', $slug) }} goes here...</textarea>
            </div>

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" id="isActive" checked>
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
