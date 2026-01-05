@include('client.reports')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<div class="profile-form-container">
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($devices->isEmpty())
        <p class="no-items text-center">No devices found.</p>
    @else
        <div class="table-responsive">
            <table class="table report-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial Number</th>
                        <th>Purchase Date</th>
                        <th>Warranty Expiry</th>
                        <th>Location</th>
                        <th>Assigned Technician</th>
                        <th>Recorded Time</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devices as $device)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $device->brand }}</td>
                            <td>{{ $device->model }}</td>
                            <td>{{ $device->serial_number }}</td>
                            <td>{{ $device->purchase_date ? \Carbon\Carbon::parse($device->purchase_date)->format('Y-m-d') : '-' }}</td>
                            <td>{{ $device->warranty_expiry ? \Carbon\Carbon::parse($device->warranty_expiry)->format('Y-m-d') : '-' }}</td>
                            <td>{{ $device->location ?? '-' }}</td>
                            <td>{{ $device->assignedTechnician?->name ?? '-' }}</td>
                            <td>{{ $device->created_at ? \Carbon\Carbon::parse($device->created_at)->format('Y-m-d H:i') : '-' }}</td>
                            <td>
                                <!-- Manage buttons -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDeviceModal{{ $device->id }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDeviceModal{{ $device->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Device Modal -->
                        <div class="modal fade" id="editDeviceModal{{ $device->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-dark">
                                        <h5 class="modal-title"><i class="fa fa-edit"></i> Edit Device</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('client.devices.update', $device->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row g-2">
                                                <div class="col-md-6"><label>Brand</label><input type="text" class="form-control form-control-sm" name="brand" value="{{ $device->brand }}" required></div>
                                                <div class="col-md-6"><label>Model</label><input type="text" class="form-control form-control-sm" name="model" value="{{ $device->model }}" required></div>
                                                <div class="col-md-6"><label>Serial Number</label><input type="text" class="form-control form-control-sm" name="serial_number" value="{{ $device->serial_number }}" required></div>
                                                <div class="col-md-6"><label>Type</label><input type="text" class="form-control form-control-sm" name="type" value="{{ $device->type }}"></div>
                                                <div class="col-md-6"><label>OS</label><input type="text" class="form-control form-control-sm" name="os" value="{{ $device->os }}"></div>
                                                <div class="col-md-6"><label>Status</label>
                                                    <select class="form-select form-select-sm" name="status" required>
                                                        <option value="pending" {{ $device->status=='pending'?'selected':'' }}>Pending</option>
                                                        <option value="active" {{ $device->status=='active'?'selected':'' }}>Active</option>
                                                        <option value="inactive" {{ $device->status=='inactive'?'selected':'' }}>Inactive</option>
                                                        <option value="repair" {{ $device->status=='repair'?'selected':'' }}>Repair</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4"><label>IMEI 1</label><input type="text" class="form-control form-control-sm" name="imei_1" value="{{ $device->imei_1 }}"></div>
                                                <div class="col-md-4"><label>IMEI 2</label><input type="text" class="form-control form-control-sm" name="imei_2" value="{{ $device->imei_2 }}"></div>
                                                <div class="col-md-4"><label>IMEI 3 / MAC / Plate</label><input type="text" class="form-control form-control-sm" name="imei_3_or_mac_or_plate" value="{{ $device->imei_3_or_mac_or_plate }}"></div>
                                                <div class="col-md-6"><label>Purchase Date</label><input type="date" class="form-control form-control-sm" name="purchase_date" value="{{ $device->purchase_date }}"></div>
                                                <div class="col-md-6"><label>Warranty Expiry</label><input type="date" class="form-control form-control-sm" name="warranty_expiry" value="{{ $device->warranty_expiry }}"></div>
                                                <div class="col-md-6"><label>Location</label><input type="text" class="form-control form-control-sm" name="location" value="{{ $device->location }}"></div>
                                                <div class="col-12"><label>Notes</label><textarea class="form-control form-control-sm" name="notes" rows="2">{{ $device->notes }}</textarea></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-warning btn-sm">Update Device</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Device Modal -->
                        <div class="modal fade" id="deleteDeviceModal{{ $device->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title"><i class="fa fa-trash"></i> Delete Device</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete <strong>{{ $device->brand }} {{ $device->model }}</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('client.devices.destroy', $device->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Add Device Modal -->
<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addDeviceModalLabel"><i class="fa fa-plus"></i> Add Device</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('client.devices.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6"><label>Brand</label><input type="text" class="form-control form-control-sm" name="brand" required></div>
                        <div class="col-md-6"><label>Model</label><input type="text" class="form-control form-control-sm" name="model" required></div>
                        <div class="col-md-6"><label>Serial Number</label><input type="text" class="form-control form-control-sm" name="serial_number" required></div>
                        <div class="col-md-6"><label>Type</label><input type="text" class="form-control form-control-sm" name="type"></div>
                        <div class="col-md-6"><label>OS</label><input type="text" class="form-control form-control-sm" name="os"></div>
                        <div class="col-md-6"><label>Status</label>
                            <select class="form-select form-select-sm" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="repair">Repair</option>
                            </select>
                        </div>
                        <div class="col-md-4"><label>IMEI 1</label><input type="text" class="form-control form-control-sm" name="imei_1"></div>
                        <div class="col-md-4"><label>IMEI 2</label><input type="text" class="form-control form-control-sm" name="imei_2"></div>
                        <div class="col-md-4"><label>IMEI 3 / MAC / Plate</label><input type="text" class="form-control form-control-sm" name="imei_3_or_mac_or_plate"></div>
                        <div class="col-md-6"><label>Purchase Date</label><input type="date" class="form-control form-control-sm" name="purchase_date"></div>
                        <div class="col-md-6"><label>Warranty Expiry</label><input type="date" class="form-control form-control-sm" name="warranty_expiry"></div>
                        <div class="col-md-6"><label>Location</label><input type="text" class="form-control form-control-sm" name="location"></div>
                        <div class="col-12"><label>Notes</label><textarea class="form-control form-control-sm" name="notes" rows="2"></textarea></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Add Device</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
.profile-form-container {
    width: 80%;
    margin-top: 0px;
    margin-left: 257px;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
.table-responsive { overflow-x: auto; }
.report-table {
    width: 100%;
    border-collapse: collapse;
}
.report-table th,
.report-table td {
    border: none;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 8px 12px;
}
.report-table thead th {
    border-bottom: 2px solid #dee2e6;
}
.no-items { text-align: center; color: gray; font-style: italic; margin-top: 15px; }
.modal-body .form-control, .modal-body .form-select { font-size: 0.85rem; }
</style>
