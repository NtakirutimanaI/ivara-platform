<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> <!-- smaller modal -->
        <form method="POST" action="{{ route('client.profile.update', $client->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content" style="font-size:0.85rem;">
                
                <div class="modal-header" style="padding:0.5rem 1rem; border-bottom:1px solid #dee2e6;">
                    <h5 class="modal-title" id="editProfileLabel" style="font-size:1rem;">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-2">
                    <div class="mb-2">
                        <label for="name" class="form-label" style="font-size:0.85rem;">Name</label>
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name', $client->name) }}">
                        @error('name')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label" style="font-size:0.85rem;">Email</label>
                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email', $client->email) }}">
                        @error('email')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label for="phone" class="form-label" style="font-size:0.85rem;">Phone</label>
                        <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $client->phone) }}">
                        @error('phone')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label for="address" class="form-label" style="font-size:0.85rem;">Address</label>
                        <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address', $client->address) }}">
                        @error('address')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label for="city" class="form-label" style="font-size:0.85rem;">City</label>
                        <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" name="city" value="{{ old('city', $client->city) }}">
                        @error('city')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label for="country" class="form-label" style="font-size:0.85rem;">Country</label>
                        <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" name="country" value="{{ old('country', $client->country) }}">
                        @error('country')<div class="invalid-feedback" style="font-size:0.75rem;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
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
