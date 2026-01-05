<div class="modal fade" id="addNotificationModal" tabindex="-1" aria-labelledby="addNotificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> <!-- smaller modal -->
        <form method="POST" action="{{ route('client.notifications.store') }}">
            @csrf
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <div class="modal-content" style="font-size:0.85rem;">
                <div class="modal-header" style="padding:0.5rem 1rem; border-bottom:1px solid #dee2e6;">
                    <h5 class="modal-title" id="addNotificationLabel" style="font-size:1rem;">Add Notification</h5>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Message</label>
                        <textarea name="message" class="form-control form-control-sm @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size:0.85rem;">Read Status</label>
                        <select name="read_status" class="form-select form-select-sm @error('read_status') is-invalid @enderror">
                            <option value="0">Unread</option>
                            <option value="1">Read</option>
                        </select>
                        @error('read_status')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-primary btn-sm">Add Notification</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
/* Smaller modal styles */
.modal-sm { max-width: 400px; }
.modal-content { border-radius: 8px; }
.form-control-sm, .form-select-sm { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
.btn-sm { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
.btn-close-sm { width: 1rem; height: 1rem; }
</style>
