@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Device Tracking</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Bootstrap for pagination -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f5f7fa;
        color: #333;
        font-size: 14px;
    }
    .page-container {
        width: 80%;
        margin-left: 270px;
        margin-top: 100px;
        max-width: 1400px;
    }
    .page-container h2 {
        font-size: 16px;
    }
    input, select, button {
        font-size: 12px;
        padding: 0.25rem 0.5rem;
    }
    table th, table td {
        padding: 0.25rem 0.5rem;
    }
    @media (max-width: 1024px) {
        .page-container {
            margin-left: 0;
            width: 95%;
        }
    }
    @media (max-width: 640px) {
        .page-container {
            width: 100%;
            padding: 5px;
        }
    }
</style>
</head>
<body>
<div class="page-container">

    <div class="flex justify-between items-center mb-2">
        <h2 class="text-[#4f46e5] font-bold">Device Tracking</h2>
        <button id="openDeviceModal" class="bg-indigo-600 text-white rounded hover:bg-indigo-700">+ Register Device</button>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-2 py-1 mb-2 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-2 py-1 mb-2 rounded">{{ session('error') }}</div>
    @endif

    <!-- Search -->
    <input id="searchInput" type="text" placeholder="Search devices..." class="w-full md:w-1/2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-indigo-500 mb-2">

    <!-- Rows per page -->
    <div class="mb-1 flex justify-between items-center">
        <div>
            Show
            <select id="rowsPerPage" class="border rounded p-1">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
            </select>
            entries
        </div>
        <nav>
            <ul id="pagination" class="pagination pagination-sm mb-0"></ul>
        </nav>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-xl shadow-sm">
        <table id="deviceTable" class="w-full text-sm">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th>#</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Serial</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Owner</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devices as $index => $device)
                <tr class="border-b hover:bg-indigo-50">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $device->brand }}</td>
                    <td>{{ $device->model }}</td>
                    <td>{{ $device->serial_number }}</td>
                    <td>
                        <span class="px-1 py-0.5 rounded {{ $device->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($device->status) }}
                        </span>
                    </td>
                    <td>{{ $device->location ?? 'Unknown' }}</td>
                    <td>{{ $device->client ? $device->client->name : 'Not Assigned' }}</td>
                    <td class="space-x-1 flex flex-wrap gap-1">
                        <button onclick="trackDevice({{ $device->id }})" class="bg-blue-500 text-white rounded hover:bg-blue-600 px-2 py-0.5 text-xs">Track</button>
                        <button onclick="updateDevice({{ $device->id }})" class="bg-yellow-500 text-white rounded hover:bg-yellow-600 px-2 py-0.5 text-xs">Update</button>
                        <button onclick="reportStolen({{ $device->id }})" class="bg-red-500 text-white rounded hover:bg-red-600 px-2 py-0.5 text-xs">Report Stolen</button>
                        <button onclick="getData({{ $device->id }})" class="bg-green-500 text-white rounded hover:bg-green-600 px-2 py-0.5 text-xs">Get Data</button>
                        <button onclick="changeStatus({{ $device->id }})" class="bg-purple-500 text-white rounded hover:bg-purple-600 px-2 py-0.5 text-xs">Change Status</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Device Modal -->
<div id="deviceModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-4 rounded-xl shadow-lg w-full max-w-md">
        <h3 class="text-sm font-bold mb-2">Register Device</h3>
        <form action="{{ route('admin.devices.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div><label>Brand</label><input type="text" name="brand" class="w-full border rounded p-1" required></div>
                <div><label>Model</label><input type="text" name="model" class="w-full border rounded p-1" required></div>
                <div><label>Serial Number</label><input type="text" name="serial_number" class="w-full border rounded p-1" required></div>
                <div><label>Type</label><input type="text" name="type" class="w-full border rounded p-1" required></div>
            </div>
            <div class="mt-2 flex justify-end space-x-1">
                <button type="button" id="closeDeviceModal" class="px-2 py-1 border rounded text-xs">Cancel</button>
                <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Client Modal -->
<div id="clientModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-4 rounded-xl shadow-lg w-full max-w-md">
        <h3 class="text-sm font-bold mb-2">Register Device Owner</h3>
        <form method="POST" action="{{ route('admin.clients.store') }}">
            @csrf
            <input type="hidden" name="device_id" id="clientDeviceId">
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div><label>Name</label><input type="text" name="name" class="w-full border rounded p-1" required></div>
                <div><label>Phone</label><input type="text" name="phone" class="w-full border rounded p-1" required></div>
                <div><label>Email</label><input type="email" name="email" class="w-full border rounded p-1"></div>
                <div><label>National ID</label><input type="text" name="national_id" class="w-full border rounded p-1"></div>
                <div><label>City</label><input type="text" name="city" class="w-full border rounded p-1"></div>
                <div><label>Country</label><input type="text" name="country" value="Rwanda" class="w-full border rounded p-1"></div>
            </div>
            <div class="mt-2 flex justify-end space-x-1">
                <button type="button" id="closeClientModal" class="px-2 py-1 border rounded text-xs">Cancel</button>
                <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded text-xs">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modals
    const deviceModal = document.getElementById("deviceModal");
    const clientModal = document.getElementById("clientModal");
    const openDeviceBtn = document.getElementById("openDeviceModal");
    const closeDeviceBtn = document.getElementById("closeDeviceModal");
    const closeClientBtn = document.getElementById("closeClientModal");

    openDeviceBtn.addEventListener("click", () => deviceModal.classList.remove("hidden"));
    closeDeviceBtn.addEventListener("click", () => deviceModal.classList.add("hidden"));
    closeClientBtn.addEventListener("click", () => clientModal.classList.add("hidden"));

    // Search all columns
    document.getElementById("searchInput").addEventListener("keyup", function () {
        const filter = this.value.toLowerCase();
        const rows = Array.from(document.querySelectorAll("#deviceTable tbody tr"));
        rows.forEach(row => {
            const match = Array.from(row.cells).some(cell => 
                cell.textContent.toLowerCase().includes(filter)
            );
            row.style.display = match ? "" : "none";
        });
        paginateTable();
    });

    // Manage buttons
    function trackDevice(id) { alert("Tracking device ID: "+id); }
    function updateDevice(id) { alert("Update device ID: "+id); }
    function reportStolen(id) { alert("Report stolen for device ID: "+id); }
    function getData(id) { alert("Exporting device data ID: "+id); }
    function changeStatus(id) { alert("Changing status for device ID: "+id); }

    // Pagination
    const rowsPerPageSelect = document.getElementById("rowsPerPage");
    let currentPage = 1;

    function paginateTable() {
        const table = document.getElementById("deviceTable");
        const rows = Array.from(table.tBodies[0].rows).filter(r => r.style.display !== "none");
        const rowsPerPage = parseInt(rowsPerPageSelect.value);
        const totalPages = Math.ceil(rows.length / rowsPerPage);
        const pagination = document.getElementById("pagination");

        rows.forEach((row, i) => {
            row.style.display = (i >= (currentPage-1)*rowsPerPage && i < currentPage*rowsPerPage) ? "" : "none";
        });

        pagination.innerHTML = '';
        for(let i=1;i<=totalPages;i++){
            const li = document.createElement('li');
            li.classList.add('page-item', i===currentPage?'active':'');
            const a = document.createElement('a');
            a.classList.add('page-link');
            a.href="#";
            a.innerText=i;
            a.addEventListener('click', e=>{ e.preventDefault(); currentPage=i; paginateTable(); });
            li.appendChild(a);
            pagination.appendChild(li);
        }
    }

    rowsPerPageSelect.addEventListener('change', ()=>{ currentPage=1; paginateTable(); });

    window.onload=function(){
        paginateTable();
        @if(session('openClientModal'))
            clientModal.classList.remove("hidden");
            document.getElementById("clientDeviceId").value="{{ session('device_id') }}";
        @endif
    }
</script>
</body>
</html>
@include('layouts.footer')
