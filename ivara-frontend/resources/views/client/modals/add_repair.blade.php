<div class="modal fade" id="addRepairModal" tabindex="-1" aria-labelledby="addRepairLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> <!-- smaller modal -->
        <form method="POST" action="{{ route('client.repairs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content" style="font-size:0.85rem;">
                <div class="modal-header" style="padding:0.5rem 1rem; border-bottom:1px solid #dee2e6;">
                    <h5 class="modal-title" id="addRepairLabel" style="font-size:1rem;">Add Repair</h5>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-2">
                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Device</label>
                        <select name="device_id" class="form-select form-select-sm @error('device_id') is-invalid @enderror">
                            <option value="">Select Device</option>
                            @foreach($client->devices as $device)
                                <option value="{{ $device->id }}">{{ $device->brand }} {{ $device->model }} ({{ $device->serial_number }})</option>
                            @endforeach
                        </select>
                        @error('device_id')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Problem Description</label>
                        <textarea name="problem_description" class="form-control form-control-sm @error('problem_description') is-invalid @enderror">{{ old('problem_description') }}</textarea>
                        @error('problem_description')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Technician</label>
                        <input type="text" name="technician" class="form-control form-control-sm @error('technician') is-invalid @enderror" value="{{ old('technician') }}">
                        @error('technician')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Date Received</label>
                        <input type="date" name="received_date" class="form-control form-control-sm @error('received_date') is-invalid @enderror" value="{{ old('received_date') }}">
                        @error('received_date')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Estimated Cost</label>
                        <input type="number" step="0.01" name="estimated_cost" class="form-control form-control-sm @error('estimated_cost') is-invalid @enderror" value="{{ old('estimated_cost') }}">
                        @error('estimated_cost')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Report File</label>
                        <input type="file" name="repair_report_file" class="form-control form-control-sm @error('repair_report_file') is-invalid @enderror">
                        @error('repair_report_file')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-primary btn-sm">Add Repair</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Smaller modal styles */
.modal-sm { max-width: 450px; } /* a little wider for multiple fields */
.modal-content { border-radius: 8px; }
.form-control-sm, .form-select-sm { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
.btn-sm { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
.btn-close-sm { width: 1rem; height: 1rem; }
</style>
