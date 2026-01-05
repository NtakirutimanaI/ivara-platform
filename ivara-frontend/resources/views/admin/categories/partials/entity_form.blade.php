@php
/**
 * Generic entity form partial.
 *
 * Expected variables:
 *   - $action   (string)   URL for the form action
 *   - $method   (string)   HTTP method (POST or PUT)
 *   - $model    (object)   Existing model instance (null for create)
 *   - $entity   (string)   Human readable name (e.g. "Service")
 */
@endphp

<form action="{{ $action }}" method="POST">
    @csrf
    @if(strtoupper($method) !== 'POST')
        @method($method)
    @endif
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $model->name ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $model->description ?? '') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $model->price ?? '') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="active" {{ (old('status', $model->status ?? '') == 'active') ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ (old('status', $model->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">{{ $model ? 'Update' : 'Create' }} {{ $entity }}</button>
</form>
