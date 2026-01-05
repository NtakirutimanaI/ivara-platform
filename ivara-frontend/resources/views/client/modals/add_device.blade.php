<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> <!-- smaller modal -->
        <form method="POST" action="{{ route('client.devices.store') }}">
            @csrf
            <div class="modal-content" style="font-size:0.85rem;">
                <div class="modal-header" style="padding:0.5rem 1rem; border-bottom:1px solid #dee2e6;">
                    <h5 class="modal-title" id="addDeviceLabel" style="font-size:1rem;">Add Device</h5>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-2">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    
                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Brand</label>
                        <input type="text" name="brand" class="form-control form-control-sm @error('brand') is-invalid @enderror" value="{{ old('brand') }}">
                        @error('brand')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Model</label>
                        <input type="text" name="model" class="form-control form-control-sm @error('model') is-invalid @enderror" value="{{ old('model') }}">
                        @error('model')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Serial Number</label>
                        <input type="text" name="serial_number" class="form-control form-control-sm @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}">
                        @error('serial_number')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Type</label>
                        <input type="text" name="type" class="form-control form-control-sm @error('type') is-invalid @enderror" value="{{ old('type') }}">
                        @error('type')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Warranty Expiry</label>
                        <input type="date" name="warranty_expiry" class="form-control form-control-sm @error('warranty_expiry') is-invalid @enderror" value="{{ old('warranty_expiry') }}">
                        @error('warranty_expiry')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Location</label>
                        <input type="text" name="location" class="form-control form-control-sm @error('location') is-invalid @enderror" value="{{ old('location') }}">
                        @error('location')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-primary btn-sm">Add Device</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Smaller and cleaner modal styles */
.modal-sm { max-width: 450px; }
.modal-content { border-radius: 8px; }
.form-control-sm { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
.btn-sm { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
.btn-close-sm { width: 1rem; height: 1rem; }
</style>
