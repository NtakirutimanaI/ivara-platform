<div class="container mt-4" style="width:80%; margin-left:220px;">

    <h2 class="mb-3 text-center">Repaired Devices Management</h2>

    {{-- Success / Error messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.devices.repairs') }}" class="mb-3 row g-2">
        <div class="col-md-3 col-12">
            <input type="text" name="technician" value="{{ request('technician') }}" class="form-control" placeholder="Search Technician">
        </div>
        <div class="col-md-2 col-12">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                <option value="In Progress" {{ request('status')=='In Progress'?'selected':'' }}>In Progress</option>
                <option value="Completed" {{ request('status')=='Completed'?'selected':'' }}>Completed</option>
            </select>
        </div>
        <div class="col-md-2 col-12">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control">
        </div>
        <div class="col-md-2 col-12">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control">
        </div>
        <div class="col-md-3 col-12">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    {{-- Devices Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Device Name</th>
                    <th>Brand</th>
                    <th>Owner</th>
                    <th>Technician</th>
                    <th>Problem</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($devices as $device)
                <tr>
                    <td>{{ $device->id }}</td>
                    <td>{{ $device->device_name }}</td>
                    <td>{{ $device->brand }}</td>
                    <td>{{ $device->device_owner ?? '-' }}</td>
                    <td>{{ $device->technician ?? '-' }}</td>
                    <td>{{ Str::limit($device->problem_description ?? '-', 30) }}</td>
                    <td>
                        <span class="badge 
                            @if($device->repair_status == 'Completed') bg-success 
                            @elseif($device->repair_status == 'In Progress') bg-warning 
                            @else bg-secondary @endif">
                            {{ $device->repair_status ?? 'Pending' }}
                        </span>
                    </td>
                    <td>{{ $device->updated_at->format('Y-m-d') }}</td>
                    <td>
                        {{-- View Button --}}
                        <button class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#viewModal{{ $device->id }}">View</button>

                        {{-- Edit Button --}}
                        <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $device->id }}">Edit</button>

                        {{-- Delete Button --}}
                        <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $device->id }}">Delete</button>
                    </td>
                </tr>

                {{-- ================= View Modal ================= --}}
                <div class="modal fade" id="viewModal{{ $device->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $device->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel{{ $device->id }}">Device Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p><strong>Device Name:</strong> {{ $device->device_name }}</p>
                                <p><strong>Brand:</strong> {{ $device->brand }}</p>
                                <p><strong>Owner:</strong> {{ $device->device_owner ?? '-' }}</p>
                                <p><strong>Technician:</strong> {{ $device->technician ?? '-' }}</p>
                                <p><strong>Problem:</strong> {{ $device->problem_description ?? '-' }}</p>
                                <p><strong>Solved Problems:</strong> {{ $device->solved_problems ?? '-' }}</p>
                                <p><strong>Recommendations:</strong> {{ $device->recommendations ?? '-' }}</p>
                                <p><strong>Status:</strong> {{ $device->repair_status ?? 'Pending' }}</p>
                                <p><strong>Last Updated:</strong> {{ $device->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= Edit Modal ================= --}}
                <div class="modal fade" id="editModal{{ $device->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $device->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $device->id }}">Update Repair</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.repairs.updateStatus', $device->id) }}" method="POST">
                                @csrf
                                <div class="modal-body text-start">
                                    <div class="mb-2">
                                        <label class="form-label">Technician</label>
                                        <input type="text" class="form-control" name="technician" value="{{ $device->technician }}">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Solved Problems</label>
                                        <textarea class="form-control" name="solved_problems">{{ $device->solved_problems }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Recommendations</label>
                                        <textarea class="form-control" name="recommendations">{{ $device->recommendations }}</textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Repair Status</label>
                                        <select class="form-select" name="repair_status" required>
                                            <option value="Pending" {{ $device->repair_status=='Pending'?'selected':'' }}>Pending</option>
                                            <option value="In Progress" {{ $device->repair_status=='In Progress'?'selected':'' }}>In Progress</option>
                                            <option value="Completed" {{ $device->repair_status=='Completed'?'selected':'' }}>Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ================= Delete Modal ================= --}}
                <div class="modal fade" id="deleteModal{{ $device->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $device->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $device->id }}">Delete Device</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.repairs.destroy', $device->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body text-start">
                                    Are you sure you want to delete <strong>{{ $device->device_name }} ({{ $device->brand }})</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="9">No repaired devices found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $devices->links() }}
    </div>
</div>
@endsection

{{-- Optional JS for responsive behavior --}}
@push('scripts')
<script>
    // Example function to open first modal
    function openModal(id) {
        var modal = new bootstrap.Modal(document.getElementById(id));
        modal.show();
    }
</script>
@endpush
