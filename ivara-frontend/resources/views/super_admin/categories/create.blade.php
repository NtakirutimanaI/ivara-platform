@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <header class="pro-header">
        <div>
            <h1>Create New Category</h1>
            <p>Add a new service domain to the IVARA Platform.</p>
        </div>
    </header>

    <div class="pro-card glass-panel" style="max-width: 800px; margin: 0 auto;">
        <form action="{{ route('super_admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Category Name</label>
                <input type="text" class="form-control pro-input" placeholder="e.g. Advanced AI Solutions">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Route Slug</label>
                <input type="text" class="form-control pro-input" placeholder="e.g. advanced-ai-solutions">
                <small class="text-muted">Used in URLs: ivara.com/market/slug</small>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Icon Class (FontAwesome)</label>
                <input type="text" class="form-control pro-input" placeholder="e.g. fas fa-robot">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control pro-input" rows="4" placeholder="Brief description of this category..."></textarea>
            </div>

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" id="isActive" checked>
                <label class="form-check-label" for="isActive">Immediately Active</label>
            </div>

            <div class="text-end mt-5">
                <a href="{{ route('super_admin.categories.index') }}" class="btn-secondary-premium me-3">Cancel</a>
                <button type="submit" class="btn-premium">Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
