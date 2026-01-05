@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Vehicles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f9fafb; }
        .page-container { width: 80%; margin-left: 240px; padding: 20px; }
        @media (max-width: 1024px) { .page-container { margin-left: 0; width: 100%; } }
    </style>
</head>
<body>
<div class="page-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Registered Vehicles</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerVehicleModal">+ Register Vehicle</button>
    </div>
        <a href="{{ route('mechanic.repairs') }}" class="btn btn-primary btn-sm">
            Manage Repairs
        </a>

    <!-- Vehicles Table -->
    <div class="table-responsive bg-white p-3 shadow-sm rounded">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Registration</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Color</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehicles as $index => $vehicle)
                    <tr>
                        <td>{{ $vehicles->firstItem() + $index }}</td>
                        <td>{{ $vehicle->registration_number }}</td>
                        <td>{{ $vehicle->make }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year ?? '-' }}</td>
                        <td>{{ $vehicle->color ?? '-' }}</td>
                        <td>{{ $vehicle->vehicle_type ?? '-' }}</td>
                        <td><span class="badge bg-info">{{ ucfirst($vehicle->status) }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $vehicle->id }}">View</button>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $vehicle->id }}">Edit</button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $vehicle->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header"><h5 class="modal-title">Vehicle Details</h5></div>
                                <div class="modal-body">
                                    <p><strong>Registration Number:</strong> {{ $vehicle->registration_number }}</p>
                                    <p><strong>Make:</strong> {{ $vehicle->make }}</p>
                                    <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                                    <p><strong>Year:</strong> {{ $vehicle->year ?? '-' }}</p>
                                    <p><strong>Color:</strong> {{ $vehicle->color ?? '-' }}</p>
                                    <p><strong>Type:</strong> {{ $vehicle->vehicle_type ?? '-' }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($vehicle->status) }}</p>
                                    <p><strong>Created At:</strong> {{ $vehicle->created_at }}</p>
                                    <p><strong>Updated At:</strong> {{ $vehicle->updated_at }}</p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $vehicle->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                           <form method="POST" action="{{ route('mechanic.storeVehicle') }}">
                              @csrf
                                <div class="modal-header"><h5 class="modal-title">Edit Vehicle</h5></div>
                                <div class="modal-body">
                                    <div class="mb-2"><label>Registration Number</label><input type="text" name="registration_number" value="{{ $vehicle->registration_number }}" class="form-control" required></div>
                                    <div class="mb-2"><label>Make</label><input type="text" name="make" value="{{ $vehicle->make }}" class="form-control" required></div>
                                    <div class="mb-2"><label>Model</label><input type="text" name="model" value="{{ $vehicle->model }}" class="form-control" required></div>
                                    <div class="mb-2"><label>Year</label><input type="number" name="year" value="{{ $vehicle->year }}" class="form-control"></div>
                                    <div class="mb-2"><label>Color</label><input type="text" name="color" value="{{ $vehicle->color }}" class="form-control"></div>
                                    <div class="mb-2"><label>Type</label><input type="text" name="vehicle_type" value="{{ $vehicle->vehicle_type }}" class="form-control"></div>
                                    <div class="mb-2"><label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" {{ $vehicle->status=='active'?'selected':'' }}>Active</option>
                                            <option value="inactive" {{ $vehicle->status=='inactive'?'selected':'' }}>Inactive</option>
                                            <option value="scrapped" {{ $vehicle->status=='scrapped'?'selected':'' }}>Scrapped</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                @empty
                    <tr><td colspan="9" class="text-center">No vehicles registered.</td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center">
            <div>Showing {{ $vehicles->firstItem() }} to {{ $vehicles->lastItem() }} of {{ $vehicles->total() }}</div>
            <div>{{ $vehicles->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>

<!-- Register Vehicle Modal -->
<div class="modal fade" id="registerVehicleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('mechanic.storeVehicle') }}" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Register Vehicle</h5></div>
            <div class="modal-body">
                <div class="mb-2"><label>Registration Number</label><input type="text" name="registration_number" class="form-control" required></div>
                <div class="mb-2"><label>Make</label><input type="text" name="make" class="form-control" required></div>
                <div class="mb-2"><label>Model</label><input type="text" name="model" class="form-control" required></div>
                <div class="mb-2"><label>Year</label><input type="number" name="year" class="form-control"></div>
                <div class="mb-2"><label>Color</label><input type="text" name="color" class="form-control"></div>
                <div class="mb-2"><label>Type</label><input type="text" name="vehicle_type" class="form-control"></div>
                <div class="mb-2"><label>Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="scrapped">Scrapped</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
