@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Devices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            font-size: 12px;
             margin-top:80px
        }

        .container {
            margin-left: 240px;
            width: 80%;
            padding: 10px;
            margin-top:40px;
            max-width: 1000px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .add-button {
            background-color: #28a745;
            color: #fff;
            padding: 4px 8px;
            text-decoration: none;
            border-radius: 4px;
            float: right;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .action-buttons a {
            margin-right: 6px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 11px;
        }

        .view-btn { color: blue; }
        .edit-btn { color: orange; }
        .delete-btn { color: red; }

        .action-header {
            text-align: center;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .modal .form-control {
            font-size: 12px;
            padding: 4px 8px;
        }

        .modal .btn {
            padding: 4px 10px;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .add-button {
                float: none;
                display: block;
                width: 100%;
                text-align: center;
            }

            table {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Devices Table</h2>

    <div class="clearfix">
        <a href="#" class="add-button" data-bs-toggle="modal" data-bs-target="#addDeviceModal">+ Add</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped shadow-sm bg-white">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Serial</th>
                    <th>Status</th>
                    <th class="action-header">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($devices as $device)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $device->brand }}</td>
                        <td>{{ $device->model }}</td>
                        <td>{{ $device->serial_number }}</td>
                        <td>{{ ucfirst($device->status) }}</td>
                        <td class="action-buttons">
                            <a class="view-btn" data-bs-toggle="modal" data-bs-target="#viewModal{{ $device->id }}">View</a>
                            <a class="edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $device->id }}">Edit</a>
                            <a class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $device->id }}">Delete</a>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $device->id }}" tabindex="-1" aria-labelledby="viewLabel{{ $device->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="viewLabel{{ $device->id }}">View Device</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Brand:</strong> {{ $device->brand }}</p>
                                    <p><strong>Model:</strong> {{ $device->model }}</p>
                                    <p><strong>Serial:</strong> {{ $device->serial_number }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($device->status) }}</p>
                                    <p><strong>Description:</strong> {{ $device->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $device->id }}" tabindex="-1" aria-labelledby="editLabel{{ $device->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('devices.update', $device->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="editLabel{{ $device->id }}">Edit Device</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label>Brand</label>
                                            <input type="text" name="brand" class="form-control" value="{{ $device->brand }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Model</label>
                                            <input type="text" name="model" class="form-control" value="{{ $device->model }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label>Serial Number</label>
                                            <input type="text" name="serial_number" class="form-control" value="{{ $device->serial_number }}">
                                        </div>
                                        <div class="mb-2">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="active" {{ $device->status === 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $device->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $device->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $device->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('devices.destroy', $device->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="deleteLabel{{ $device->id }}">Delete Device</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete <strong>{{ $device->brand }} {{ $device->model }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Device Modal -->
<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form method="POST" action="{{ route('devices.store') }}">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title" id="addDeviceLabel">Add Device</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Model</label>
                        <input type="text" name="model" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Serial Number</label>
                        <input type="text" name="serial_number" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

@include('layouts.footer')
