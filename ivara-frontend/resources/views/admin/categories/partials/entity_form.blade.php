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

<form action="{{ $action }}" method="POST" class="premium-form">
    @csrf
    @if(strtoupper($method) !== 'POST')
        @method($method)
    @endif

    <div class="row g-4">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label fw-800 text-dark mb-2">
                    <i class="fas fa-tag text-primary me-2"></i> {{ $entity }} Name
                </label>
                <input type="text" name="name" class="pro-input @error('name') is-invalid @enderror" 
                       placeholder="e.g. Smartphone Screen Repair"
                       value="{{ old('name', $model->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label fw-800 text-dark mb-2">
                    <i class="fas fa-align-left text-primary me-2"></i> Description
                </label>
                <textarea name="description" class="pro-input @error('description') is-invalid @enderror" 
                          rows="4" placeholder="Briefly describe what this {{ strtolower($entity) }} covers...">{{ old('description', $model->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label fw-800 text-dark mb-2">
                    <i class="fas fa-money-bill-wave text-primary me-2"></i> Base Price (FRW)
                </label>
                <div class="input-group-premium">
                    <input type="number" step="0.01" name="price" class="pro-input @error('price') is-invalid @enderror" 
                           placeholder="0.00" value="{{ old('price', $model->price ?? '') }}">
                </div>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label fw-800 text-dark mb-2">
                    <i class="fas fa-toggle-on text-primary me-2"></i> Availability Status
                </label>
                <select name="status" class="pro-input @error('status') is-invalid @enderror">
                    <option value="active" {{ (old('status', $model->status ?? '') == 'active') ? 'selected' : '' }}>Active - Visible to Clients</option>
                    <option value="inactive" {{ (old('status', $model->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive - Hidden from Clients</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-12 mt-5">
            <div class="d-flex justify-content-between align-items-center p-3 rounded-3" style="background: rgba(0,0,0,0.02); border: 1px dashed var(--glass-border);">
                <div class="text-muted small">
                    <i class="fas fa-info-circle me-1"></i> Double check all fields before saving.
                </div>
                <button type="submit" class="action-btn btn-primary px-5">
                    <i class="fas fa-save"></i> {{ $model ? 'Update' : 'Create' }} {{ $entity }}
                </button>
            </div>
        </div>
    </div>
</form>

<style>
    .premium-form .form-group {
        margin-bottom: 0.5rem;
    }
    .fw-800 { font-weight: 800; }
    .input-group-premium {
        position: relative;
    }
</style>
