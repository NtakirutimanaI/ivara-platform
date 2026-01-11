
@include('layouts.header')
@include('layouts.sidebar')
@include('supervisor.connect')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard - Team & Task Oversight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { margin: 0; padding: 0; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; font-size: 14px; }
        .container { width: 90%; margin-left: 240px; margin-top: 60px; margin-bottom: 30px; padding: 25px; }
        h2 { font-weight: 600; color: #2c3e50; margin-bottom: 15px; }
        .alert { padding: 14px 20px; border-radius: 8px; margin-bottom: 25px; font-weight: 500; box-shadow: 0 2px 6px rgba(0,0,0,0.08);}
        .alert-success { background: #d1f2e7; color: #0f5132; border: 1px solid #badbcc; }
        .alert-danger { background: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .card { border: none; border-radius: 10px; background: #ffffff; margin-bottom: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);}
        .card-header { font-weight: 600; font-size: 15px; padding: 14px 20px; background: #f1f3f5; border-bottom: 1px solid #e0e0e0;}
        .card-body { padding: 20px; }
        .table { width: 100%; margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
        .table th, .table td { padding: 12px 16px; vertical-align: middle; border-bottom: 1px solid #e9ecef; }
        .table th { background: #f8f9fa; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #495057;}
        .table-hover tbody tr:hover { background-color: #f1f5ff; }
        .badge { font-size: 12px; padding: 6px 10px; border-radius: 12px; font-weight: 500; }
        .badge.bg-success { background-color: #28a745 !important; }
        .badge.bg-warning { background-color: #924FC2 !important; color: #000; }
        .badge.bg-danger { background-color: #dc3545 !important; }
        .badge.bg-info { background-color: #17a2b8 !important; }
        .btn { border-radius: 6px; font-size: 13px; padding: 6px 12px; transition: all 0.25s ease-in-out; }
        .btn-sm { padding: 4px 9px; font-size: 12px; }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 2px 6px rgba(0,0,0,0.12); }
        .btn-outline-primary { border: 1px solid #0d6efd; color: #0d6efd; }
        .btn-outline-primary:hover { background: #0d6efd; color: #fff; }
        .btn-outline-secondary { border: 1px solid #6c757d; color: #6c757d; }
        .btn-outline-secondary:hover { background: #6c757d; color: #fff; }
        .btn-outline-danger { border: 1px solid #dc3545; color: #dc3545; }
        .btn-outline-danger:hover { background: #dc3545; color: #fff; }
        .modal-content { border-radius: 10px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.15);}
        .modal-header { background: #f8f9fa; border-bottom: 1px solid #dee2e6; padding: 14px 20px;}
        .modal-title { font-weight: 600; font-size: 15px; }
        .modal-body { padding: 20px; font-size: 14px; }
        .modal-footer { border-top: 1px solid #dee2e6; padding: 12px 20px; }
        .form-control, .form-select { font-size: 14px; border-radius: 6px; padding: 8px 12px; border: 1px solid #ced4da; }
        .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 4px rgba(13,110,253,0.3); }
        .pagination-container { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; flex-wrap: wrap; }
        @media (max-width: 1200px){ .container { width: 95%; margin-left: 220px; } }
        @media (max-width: 992px){ .container { width: 95%; margin-left: 200px; } .table th, .table td { font-size: 12px; padding: 10px; } }
        @media (max-width: 768px){ .container { width: 100%; margin-left: 0; padding: 15px; } h2 { font-size: 18px; } .btn { font-size: 12px; padding: 5px 10px; } }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">👨‍💼 Supervisor - Team & Task Oversight</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tasks Section --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">📋 Tasks</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                <i class="bi bi-plus-circle"></i> Assign Task
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle" id="tasksTable">
                <thead class="bg-success text-white">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Assigned User</th>
                        <th>Created</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ Str::limit($task->description, 50) }}</td>
                        <td>
                            <span class="badge bg-{{ $task->status == 'completed' ? 'success' : ($task->status == 'in_progress' ? 'info' : 'warning') }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>{{ optional($task->user)->name }}</td>
                        <td>{{ $task->created_at->diffForHumans() }}</td>
                        <td class="text-nowrap">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewTask{{ $task->id }}">View</button>
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editTask{{ $task->id }}">Edit</button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTask{{ $task->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination Controls --}}
            <div class="pagination-container">
                <div>
                    Show
                    <select class="form-select form-select-sm" id="tasksPerPage" style="width: auto; display: inline-block;">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                    </select>
                    entries
                </div>
                <nav>
                    <ul class="pagination mb-0" id="tasksPagination"></ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- Devices Section --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">💻 Devices Under Repair / Service</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addDeviceModal">
                <i class="bi bi-plus-circle"></i> Add Device
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle" id="devicesTable">
                <thead class="bg-success text-white">
                    <tr>
                        <th>#</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial</th>
                        <th>Status</th>
                        <th>Assigned Tech</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td>{{ $device->brand }}</td>
                        <td>{{ $device->model }}</td>
                        <td>{{ $device->serial_number }}</td>
                        <td>{{ ucfirst($device->status) }}</td>
                        <td>{{ optional($device->technician)->name ?? 'Unassigned' }}</td>
                        <td class="text-nowrap">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewDevice{{ $device->id }}">View</button>
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editDevice{{ $device->id }}">Edit</button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteDevice{{ $device->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination Controls --}}
            <div class="pagination-container">
                <div>
                    Show
                    <select class="form-select form-select-sm" id="devicesPerPage" style="width: auto; display: inline-block;">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                    </select>
                    entries
                </div>
                <nav>
                    <ul class="pagination mb-0" id="devicesPagination"></ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- Repairs Section --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h5 class="mb-0">🛠️ Repairs</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addRepairModal">
                <i class="bi bi-plus-circle"></i> Add Repair
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle" id="repairsTable">
                <thead class="bg-success text-white">
                    <tr>
                        <th>#</th>
                        <th>Device</th>
                        <th>Problem</th>
                        <th>Technician</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($repairs as $repair)
                    <tr>
                        <td>{{ $repair->id }}</td>
                        <td>{{ $repair->device_name }}</td>
                        <td>{{ Str::limit($repair->problem_description, 40) }}</td>
                        <td>{{ optional($repair->technician)->name ?? 'Unassigned' }}</td>
                        <td>
                            <span class="badge bg-{{ $repair->repair_status == 'completed' ? 'success' : ($repair->repair_status == 'in_progress' ? 'info' : 'warning') }}">
                                {{ ucfirst($repair->repair_status) }}
                            </span>
                        </td>
                        <td>{{ $repair->received_date }}</td>
                        <td class="text-nowrap">
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewRepair{{ $repair->id }}">View</button>
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editRepair{{ $repair->id }}">Edit</button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRepair{{ $repair->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{-- Pagination Controls --}}
            <div class="pagination-container">
                <div>
                    Show
                    <select class="form-select form-select-sm" id="repairsPerPage" style="width: auto; display: inline-block;">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                    </select>
                    entries
                </div>
                <nav>
                    <ul class="pagination mb-0" id="repairsPagination"></ul>
                </nav>
            </div>
        </div>
    </div>

</div>


{{-- ================= Modals ================= --}}

<!-- ===== Tasks Modals ===== -->
{{-- Add Task --}}
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('supervisor.tasks.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Assign New Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Assign To User</label>
            <select name="user_id" class="form-select" required>
              @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign Task</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Edit/View/Delete Tasks modals --}}
@foreach($tasks as $task)
  {{-- View Task --}}
  <div class="modal fade" id="viewTask{{ $task->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Task #{{ $task->id }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Title:</strong> {{ $task->title }}</p>
          <p><strong>Description:</strong> {{ $task->description }}</p>
          <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
          <p><strong>Assigned User:</strong> {{ optional($task->user)->name }}</p>
          <p><strong>Created At:</strong> {{ $task->created_at }}</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Task --}}
  <div class="modal fade" id="editTask{{ $task->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('supervisor.tasks.update', $task->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Edit Task #{{ $task->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="4" required>{{ $task->description }}</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Update Task</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Delete Task --}}
  <div class="modal fade" id="deleteTask{{ $task->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('supervisor.tasks.destroy', $task->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title">Delete Task #{{ $task->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete task "<strong>{{ $task->title }}</strong>"?
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

<!-- ===== Devices Modals ===== -->
{{-- Add Device --}}
<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('supervisor.devices.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Device</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Serial Number</label>
            <input type="text" name="serial_number" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Technician</label>
            <select name="technician_id" class="form-select">
              <option value="">Unassigned</option>
              @foreach($technicians as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Device</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Edit/View/Delete Devices --}}
@foreach($devices as $device)
  {{-- View Device --}}
  <div class="modal fade" id="viewDevice{{ $device->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Device #{{ $device->id }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Brand:</strong> {{ $device->brand }}</p>
          <p><strong>Model:</strong> {{ $device->model }}</p>
          <p><strong>Serial Number:</strong> {{ $device->serial_number }}</p>
          <p><strong>Status:</strong> {{ ucfirst($device->status) }}</p>
          <p><strong>Technician:</strong> {{ optional($device->technician)->name ?? 'Unassigned' }}</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Device --}}
  <div class="modal fade" id="editDevice{{ $device->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('supervisor.devices.update', $device->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Edit Device #{{ $device->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Brand</label>
              <input type="text" name="brand" class="form-control" value="{{ $device->brand }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Model</label>
              <input type="text" name="model" class="form-control" value="{{ $device->model }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Serial Number</label>
              <input type="text" name="serial_number" class="form-control" value="{{ $device->serial_number }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Technician</label>
              <select name="technician_id" class="form-select">
                <option value="">Unassigned</option>
                @foreach($technicians as $tech)
                  <option value="{{ $tech->id }}" {{ $device->technician_id == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Update Device</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Delete Device --}}
  <div class="modal fade" id="deleteDevice{{ $device->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('supervisor.devices.destroy', $device->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title">Delete Device #{{ $device->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete device "<strong>{{ $device->brand }} {{ $device->model }}</strong>"?
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

<!-- ===== Repairs Modals ===== -->
{{-- Add Repair --}}
<div class="modal fade" id="addRepairModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('supervisor.repairs.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Repair</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Device</label>
            <select name="device_id" class="form-select" required>
              @foreach($devices as $device)
                <option value="{{ $device->id }}">{{ $device->brand }} {{ $device->model }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Problem Description</label>
            <textarea name="problem_description" class="form-control" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Technician</label>
            <select name="technician_id" class="form-select">
              <option value="">Unassigned</option>
              @foreach($technicians as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Repair</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Edit/View/Delete Repairs --}}
@foreach($repairs as $repair)
  {{-- View Repair --}}
  <div class="modal fade" id="viewRepair{{ $repair->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Repair #{{ $repair->id }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Device:</strong> {{ $repair->device_name }}</p>
          <p><strong>Problem:</strong> {{ $repair->problem_description }}</p>
          <p><strong>Technician:</strong> {{ optional($repair->technician)->name ?? 'Unassigned' }}</p>
          <p><strong>Status:</strong> {{ ucfirst($repair->repair_status) }}</p>
          <p><strong>Received Date:</strong> {{ $repair->received_date }}</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Repair --}}
  <div class="modal fade" id="editRepair{{ $repair->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('supervisor.repairs.update', $repair->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Edit Repair #{{ $repair->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Problem Description</label>
              <textarea name="problem_description" class="form-control" rows="4">{{ $repair->problem_description }}</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <select name="repair_status" class="form-select">
                <option value="pending" {{ $repair->repair_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $repair->repair_status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ $repair->repair_status == 'completed' ? 'selected' : '' }}>Completed</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Technician</label>
              <select name="technician_id" class="form-select">
                <option value="">Unassigned</option>
                @foreach($technicians as $tech)
                  <option value="{{ $tech->id }}" {{ $repair->technician_id == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Update Repair</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Delete Repair --}}
  <div class="modal fade" id="deleteRepair{{ $repair->id }}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('supervisor.repairs.destroy', $repair->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title">Delete Repair #{{ $repair->id }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete repair for "<strong>{{ $repair->device_name }}</strong>"?
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

@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ======== Generic Pagination Script ========
function paginateTable(tableId, perPageSelectId, paginationId) {
    const table = document.getElementById(tableId);
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const perPageSelect = document.getElementById(perPageSelectId);
    const pagination = document.getElementById(paginationId);

    function renderPage(page = 1) {
        const perPage = parseInt(perPageSelect.value);
        const start = (page - 1) * perPage;
        const end = start + perPage;

        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? '' : 'none';
        });

        const pageCount = Math.ceil(rows.length / perPage);
        pagination.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = 'page-item' + (i === page ? ' active' : '');
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.innerText = i;
            a.addEventListener('click', (e) => { e.preventDefault(); renderPage(i); });
            li.appendChild(a);
            pagination.appendChild(li);
        }
    }

    perPageSelect.addEventListener('change', () => renderPage(1));
    renderPage();
}

// Initialize pagination for each table
paginateTable('tasksTable', 'tasksPerPage', 'tasksPagination');
paginateTable('devicesTable', 'devicesPerPage', 'devicesPagination');
paginateTable('repairsTable', 'repairsPerPage', 'repairsPagination');



</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function() {
    $('table').each(function() {
        $(this).DataTable({
            "pageLength": 5,
            "lengthMenu": [5, 10, 15],
            "order": [], // keeps default order
            "columnDefs": [
                { "orderable": false, "targets": -1 } // last column (Manage) not orderable
            ]
        });
    });
});
</script>

</body>
</html>
