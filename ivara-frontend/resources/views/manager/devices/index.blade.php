@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<!-- Google Font + Bootstrap -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; background: #f9f9fb; color: #333; font-size: 13px; }
.container { width: 80%; margin-left: 240px; margin-top: 100px; padding: 15px; }
h2 { color: #924FC2; font-weight: 600; display: inline-block; font-size: 18px; }
.btn-primary { background: #924FC2; border: none; font-size: 12px; padding: 2px 8px; }
.btn-primary:hover { background: #7c3bb0; }
.table-container { background: #fff; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); padding: 15px; margin-top: 20px; font-size: 12px; }
table thead { background: #f3e9fb; color: #924FC2; font-size: 12px; }
.status { padding: 2px 6px; border-radius: 5px; font-size: 11px; font-weight: 600; text-transform: capitalize; }
.status.pending { background: #fff3cd; color: #856404; }
.status.active { background: #d4edda; color: #155724; }
.status.inactive { background: #f8d7da; color: #721c24; }
.status.repair { background: #d1ecf1; color: #0c5460; }
.modal { display: none; position: fixed; z-index: 1000; left:0; top:0; width:100%; height:100%; background: rgba(0,0,0,0.5);}
.modal-dialog { max-width: 450px; margin: 6% auto; }
.modal-content { background:#fff; padding:15px; border-radius:8px; font-size: 13px; }
.modal-header { display:flex; justify-content:space-between; align-items:center; }
.modal-title { color:#924FC2; margin:0; font-size: 14px; font-weight:600; }
.btn-close { cursor:pointer; font-size: 14px; padding:2px 6px; }
.btn-group-sm .btn { font-size: 10px; padding: 2px 8px; margin-right:5px; margin-bottom:2px; }
.alert-success, .alert-danger { font-size:13px; }
.hr-view { border-top:1px solid #924FC2; margin:10px 0; }
#searchInput {
    width: 700px;
    margin-left: 34%; /* Optional if you want to center relative to container */
    border: none;
    border-bottom: 1px solid #924FC2;
    border-radius: 0;
    padding: 4px 8px;
    font-size: 13px;
    background: transparent;
}

#searchInput:focus {
    outline: none;
    box-shadow: none;
}
@media (max-width: 992px) { .container { width:95%; margin-left:0; margin-top:80px; } }
@media (max-width: 600px) { table th, table td { padding: 4px; font-size:10px; } .btn-group { display: flex; flex-wrap: wrap; gap: 2px; } }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Registered Devices</h2>
        <button class="btn btn-primary btn-sm" onclick="openModal('deviceModal')">Register Device</button>
    </div>

     <a href="{{ route('manager.devices.repairs') }}" class="btn btn-primary btn-sm">
        Manage Repairs
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error) {{ $error }} <br> @endforeach
        </div>
    @endif

    <div class="d-flex align-items-center mb-2" style="gap: 15px;">
    <input type="text" id="searchInput" class="form-control" placeholder="Search in all columns" onkeyup="filterTable()">
    
    <div id="paginate" class="d-flex align-items-center">
        <label for="pageSize" class="me-2 mb-0">Show</label>
        <select id="pageSize" class="form-select d-inline-block w-auto" onchange="changePageSize(this)">
            <option value="5" {{ request('pageSize') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('pageSize') == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ request('pageSize') == 15 ? 'selected' : '' }}>15</option>
        </select>
        <span class="ms-1">rows</span>
    </div>
</div>

    <div class="table-container table-responsive">
        <table class="table table-hover align-middle" id="devicesTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Serial</th>
                    <th>IMEI(s)</th>
                    <th>Type</th>
                    <th>OS</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Purchase</th>
                    <th>Warranty</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($devices as $index => $device)
                <tr>
                    <td>{{ ($devices->currentPage()-1) * $devices->perPage() + $index + 1 }}</td>
                    <td>{{ $device->brand }}</td>
                    <td>{{ $device->model }}</td>
                    <td>{{ $device->serial_number }}</td>
                    <td>{{ $device->imei_1 }} @if($device->imei_2), {{ $device->imei_2 }} @endif @if($device->imei_3_or_mac_or_plate), {{ $device->imei_3_or_mac_or_plate }} @endif</td>
                    <td>{{ $device->type ?? '-' }}</td>
                    <td>{{ $device->os ?? '-' }}</td>
                    <td><span class="status {{ $device->status }}">{{ $device->status }}</span></td>
                    <td>{{ $device->location ?? '-' }}</td>
                    <td>{{ $device->purchase_date ?? '-' }}</td>
                    <td>{{ $device->warranty_expiry ?? '-' }}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-info" onclick="openViewModal({{ $device->id }})">View</button>
                            <button class="btn btn-warning" onclick="openEditModal({{ $device->id }})">Edit</button>
                            <button class="btn btn-danger" onclick="openDeleteModal({{ $device->id }})">Delete</button>
                            <button class="btn btn-secondary" onclick="openStatusModal({{ $device->id }})">Status</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="14" class="text-center">No devices found</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $devices->appends(['pageSize' => request('pageSize')])->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- DEVICE MODAL -->
<div id="deviceModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Device</h5>
                <button type="button" class="btn-close" onclick="closeModal('deviceModal')"></button>
            </div>
            <form action="{{ route('admin.devices.store') }}" method="POST" id="deviceForm">
                @csrf
                <input type="text" name="brand" class="form-control mb-2" placeholder="Brand" required>
                <input type="text" name="model" class="form-control mb-2" placeholder="Model" required>
                <input type="text" name="serial_number" class="form-control mb-2" placeholder="Serial Number" required>
                <input type="text" name="imei_1" class="form-control mb-2" placeholder="IMEI 1">
                <input type="text" name="imei_2" class="form-control mb-2" placeholder="IMEI 2">
                <input type="text" name="imei_3_or_mac_or_plate" class="form-control mb-2" placeholder="IMEI 3 / MAC / Plate">
                <input type="text" name="type" class="form-control mb-2" placeholder="Device Type">
                <input type="text" name="os" class="form-control mb-2" placeholder="OS">
                <select name="status" class="form-select mb-2" required>
                    <option value="" disabled selected>Status</option>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="repair">Repair</option>
                </select>
                <input type="date" name="purchase_date" class="form-control mb-2">
                <input type="date" name="warranty_expiry" class="form-control mb-2">
                <input type="text" name="location" class="form-control mb-2" placeholder="Location">
                <textarea name="notes" class="form-control mb-2" placeholder="Notes"></textarea>
                <button type="submit" class="btn btn-primary w-100 btn-sm">Save</button>
            </form>
        </div>
    </div>
</div>

<!-- CLIENT MODAL -->
<div id="clientModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Client (Device Owner)</h5>
                <button type="button" class="btn-close" onclick="closeModal('clientModal')"></button>
            </div>
            <form action="{{ route('clients.store') }}" method="POST" id="clientForm">
                @csrf
                <input type="hidden" name="device_id" id="client_device_id">
                <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
                <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
                <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                <input type="text" name="address" class="form-control mb-2" placeholder="Address">
                <input type="text" name="city" class="form-control mb-2" placeholder="City">
                <input type="text" name="country" class="form-control mb-2" placeholder="Country" value="Rwanda">
                <input type="text" name="national_id" class="form-control mb-2" placeholder="National ID">
                <select name="gender" class="form-select mb-2">
                    <option value="" disabled selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="date" name="date_of_birth" class="form-control mb-2" placeholder="Date of Birth">
                <textarea name="notes" class="form-control mb-2" placeholder="Notes"></textarea>
                <button type="submit" class="btn btn-primary w-100 btn-sm">Save Client</button>
            </form>
        </div>
    </div>
</div>

<!-- VIEW MODAL -->
<div id="viewModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Device & Client</h5>
                <button type="button" class="btn-close" onclick="closeModal('viewModal')"></button>
            </div>
            <div class="modal-body" id="viewContent"></div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Device</h5>
                <button type="button" class="btn-close" onclick="closeModal('editModal')"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="brand" class="form-control mb-2" placeholder="Brand" required>
                <input type="text" name="model" class="form-control mb-2" placeholder="Model" required>
                <input type="text" name="serial_number" class="form-control mb-2" placeholder="Serial Number" required>
                <input type="text" name="imei_1" class="form-control mb-2" placeholder="IMEI 1">
                <input type="text" name="imei_2" class="form-control mb-2" placeholder="IMEI 2">
                <input type="text" name="imei_3_or_mac_or_plate" class="form-control mb-2" placeholder="IMEI 3 / MAC / Plate">
                <input type="text" name="type" class="form-control mb-2" placeholder="Device Type">
                <input type="text" name="os" class="form-control mb-2" placeholder="OS">
                <select name="status" class="form-select mb-2" required>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="repair">Repair</option>
                </select>
                <input type="date" name="purchase_date" class="form-control mb-2">
                <input type="date" name="warranty_expiry" class="form-control mb-2">
                <input type="text" name="location" class="form-control mb-2" placeholder="Location">
                <textarea name="notes" class="form-control mb-2" placeholder="Notes"></textarea>
                <button type="submit" class="btn btn-primary w-100 btn-sm">Update Device</button>
            </form>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Device</h5>
                <button type="button" class="btn-close" onclick="closeModal('deleteModal')"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <p>Are you sure you want to delete this device?</p>
                <button type="submit" class="btn btn-danger w-100 btn-sm">Delete</button>
            </form>
        </div>
    </div>
</div>

<!-- STATUS MODAL -->
<div id="statusModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Device Status</h5>
                <button type="button" class="btn-close" onclick="closeModal('statusModal')"></button>
            </div>
            <form id="statusForm" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select mb-2" required>
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="repair">Repair</option>
                </select>
                <button type="submit" class="btn btn-secondary w-100 btn-sm">Update Status</button>
            </form>
        </div>
    </div>
</div>

<script>
function openModal(id){ document.getElementById(id).style.display = 'block'; }
function closeModal(id){ document.getElementById(id).style.display = 'none'; }

function changePageSize(select){
    let url = new URL(window.location.href);
    url.searchParams.set('pageSize', select.value);
    window.location.href = url.toString();
}

// Search filter
function filterTable(){
    let input = document.getElementById("searchInput");
    let filter = input.value.toLowerCase();
    let table = document.getElementById("devicesTable");
    let trs = table.getElementsByTagName("tr");
    for (let i = 1; i < trs.length; i++){
        let tds = trs[i].getElementsByTagName("td");
        let show = false;
        for (let j = 0; j < tds.length - 1; j++){
            if(tds[j].textContent.toLowerCase().indexOf(filter) > -1){ show = true; break; }
        }
        trs[i].style.display = show ? "" : "none";
    }
}

// OPEN MODALS WITH DATA
function openEditModal(id){
    fetch(`/admin/devices/${id}`)
        .then(res => res.json())
        .then(device => {
            const form = document.getElementById('editForm');
            form.action = `/admin/devices/${id}`;
            form.brand.value = device.brand;
            form.model.value = device.model;
            form.serial_number.value = device.serial_number;
            form.imei_1.value = device.imei_1;
            form.imei_2.value = device.imei_2;
            form.imei_3_or_mac_or_plate.value = device.imei_3_or_mac_or_plate;
            form.type.value = device.type;
            form.os.value = device.os;
            form.status.value = device.status;
            form.purchase_date.value = device.purchase_date;
            form.warranty_expiry.value = device.warranty_expiry;
            form.location.value = device.location;
            form.notes.value = device.notes;
            openModal('editModal');
        });
}

function openDeleteModal(id){
    const form = document.getElementById('deleteForm');
    form.action = `/admin/devices/${id}`;
    openModal('deleteModal');
}

function openStatusModal(id){
    const form = document.getElementById('statusForm');
    form.action = `/admin/devices/${id}/status`;
    openModal('statusModal');
}

function openViewModal(id){
    fetch(`/admin/devices/${id}`)
        .then(res => res.json())
        .then(data => {
            let html = `<p><strong>Brand:</strong> ${data.brand}</p>
                        <p><strong>Model:</strong> ${data.model}</p>
                        <p><strong>Serial:</strong> ${data.serial_number}</p>
                        <p><strong>IMEIs:</strong> ${data.imei_1}${data.imei_2 ? ', ' + data.imei_2 : ''}${data.imei_3_or_mac_or_plate ? ', ' + data.imei_3_or_mac_or_plate : ''}</p>
                        <hr>
                        <h6>Client Info</h6>
                        <p><strong>Name:</strong> ${data.client?.name || 'N/A'}</p>
                        <p><strong>Phone:</strong> ${data.client?.phone || 'N/A'}</p>
                        <p><strong>Email:</strong> ${data.client?.email || 'N/A'}</p>`;
            document.getElementById('viewContent').innerHTML = html;
            openModal('viewModal');
        });
}

// Auto-open Client Modal after Device save
@if(session('device_saved_id'))
    document.getElementById('client_device_id').value = '{{ session("device_saved_id") }}';
    openModal('clientModal');
@endif
</script>
@include('layouts.footer')
