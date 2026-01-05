@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Services - Creative & Lifestyle</h1>
        <button class="btn btn-primary" onclick="openModal('addServiceModal')">
            <i class="fas fa-plus me-2"></i>Add New Service
        </button>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->status }}</td>
                                <td>
                                    <a href="{{ route('admin.creative-lifestyle.services.edit', $service->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.creative-lifestyle.services.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No services found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $services->links() }}
        </div>
    </div>
</div>

<!-- Add Service Modal -->
<div id="addServiceModal" class="modal-wrapper" style="position: fixed; inset: 0; background: rgba(0,0,0,0.75); backdrop-filter: blur(12px); z-index: 9999; display: none; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 20px; width: 100%; max-width: 500px; padding: 30px; border: 1px solid var(--border-color);">
        <h3 style="margin: 0 0 20px 0; color: var(--text-primary);"><i class="fas fa-plus" style="color: {{ $categoryColor ?? '#E91E63' }};"></i> Add New Service</h3>
        <form action="{{ route('admin.creative-lifestyle.services.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-action"><i class="fas fa-save"></i> Save Service</button>
        </form>
        <button onclick="closeModal('addServiceModal')" class="btn btn-action" style="margin-top:20px; width:100%;"><i class="fas fa-times"></i> Close</button>
    </div>
</div>

<script>
function openModal(id) { document.getElementById(id).style.display = 'flex'; document.body.style.overflow = 'hidden'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; document.body.style.overflow = ''; }
document.querySelectorAll('.modal-wrapper').forEach(modal => {
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(modal.id); });
});
</script>
@endsection
