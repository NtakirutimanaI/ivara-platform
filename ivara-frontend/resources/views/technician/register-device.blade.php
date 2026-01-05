@include('layouts.header')
@include('layouts.sidebar')
@include('technician.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Device</title>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Google Fonts Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap CSS for Pagination -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body.rd-body { margin-left:240px; margin-top:100px; font-family: 'Poppins', sans-serif; font-size: 0.75rem; background: #f5f7fa; color: #333; }
.rd-page-container { width: 90%; margin: 20px auto; max-width: 1200px; }
.rd-btn { background: #4f46e5; color: #fff; padding: 6px 10px; border: none; border-radius: 5px; cursor: pointer; margin-top: 5px; transition: 0.3s; text-decoration: none; font-size: 0.7rem; }
.rd-btn:hover { background: #4338ca; }
.rd-modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); display: none; align-items: center; justify-content: center; z-index: 50; }
.rd-modal-content { background: #fff; border-radius: 0.75rem; padding: 15px; max-width: 400px; width: 95%; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-size: 0.75rem; }
.rd-table { border-collapse: collapse; width: 100%; font-size: 0.75rem; }
.rd-th, .rd-td { padding: 6px; border-bottom: 1px solid #e5e7eb; text-align: left; }
.rd-th { background: #4f46e5; color: white; font-size: 0.75rem; }
.rd-tbody-tr:hover { background: #f9fafb; }
.rd-table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.rd-success-msg { background: #d1fae5; color: #065f46; padding: 0.5rem; border-radius: 0.5rem; margin-bottom: 0.5rem; text-align: center; font-size: 0.75rem; }

/* Responsive Tweaks */
@media(max-width:1024px){ .rd-page-container{ width:95%; margin:20px auto; } }
@media(max-width:768px){ .rd-btn{ font-size:0.65rem; padding:5px 8px; } .rd-modal-content{ max-width:95%; padding:10px; } .rd-table{ font-size:0.7rem; } }
@media(max-width:480px){ .rd-page-container{ width:98%; margin:15px auto; } .rd-table{ font-size:0.65rem; } .rd-th, .rd-td{ padding:4px; } }
</style>
</head>
<body class="rd-body">
<div class="rd-page-container">

<!-- Buttons Row -->
<div class="flex flex-col sm:flex-row justify-start items-start gap-4 mb-4">
  <button id="rdOpenRegisterBtn" class="rd-btn">Register Device</button>
  <button id="rdOpenRepairBtn" class="rd-btn">Repair Device</button>
</div>

<!-- Search & Pagination Controls -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
  <div class="flex items-center gap-2">
    <span>Show</span>
    <select id="rdPerPage" class="rd-select border rounded p-1">
      <option value="5">5</option>
      <option value="10" selected>10</option>
      <option value="15">15</option>
    </select>
    <span>entries</span>
  </div>
  <input type="text" id="rdSearchInput" placeholder="Search by Brand, Serial, Model, Type, Client ID, Location" class="w-full md:w-1/3 rd-input border rounded p-2">
</div>

<!-- Success & Error Messages -->
@if(session('success'))
<div class="bg-green-100 text-green-800 p-2 rounded mb-2 text-center">
  {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="bg-red-100 text-red-800 p-2 rounded mb-2 text-center">
  {{ session('error') }}
</div>
@endif

<!-- Register Device Modal -->
<div id="rdRegisterModal" class="rd-modal-overlay">
  <div class="rd-modal-content">
    <div class="flex justify-between items-center mb-2">
      <h2 class="text-lg font-bold text-[#4f46e5]">Register Device</h2>
      <button class="rd-close-btn text-gray-600 hover:text-gray-900">&times;</button>
    </div>
    <form id="rdRegisterForm" method="POST" action="{{ route('technician.devices.store') }}">
      @csrf
      <input type="text" name="brand" placeholder="Brand" class="w-full border rounded p-1 mb-1" required>
      <input type="text" name="model" placeholder="Model" class="w-full border rounded p-1 mb-1" required>
      <input type="text" name="serial_number" placeholder="Serial Number" class="w-full border rounded p-1 mb-1" required>
      <input type="text" name="imei_1" placeholder="IMEI 1 (optional)" class="w-full border rounded p-1 mb-1">
      <select name="type" class="w-full border rounded p-1 mb-1" required>
        <option value="">Select Type</option>
        <option value="Computer">Computer</option>
        <option value="Phone">Phone</option>
      </select>
      <input type="text" name="os" placeholder="Operating System (optional)" class="w-full border rounded p-1 mb-1">
      <input type="number" name="client_id" placeholder="Client ID" class="w-full border rounded p-1 mb-1" required>
      <input type="text" name="location" placeholder="Location (optional)" class="w-full border rounded p-1 mb-1">
      <button type="submit" class="rd-btn w-full mt-2">Submit</button>
    </form>
  </div>
</div>


<!-- Repair Device Modal -->
<div id="rdRepairModal" class="rd-modal-overlay">
  <div class="rd-modal-content">
    <div class="flex justify-between items-center mb-2">
      <h2 class="text-lg font-bold text-[#4f46e5]">Repair Device</h2>
      <button class="rd-close-btn text-gray-600 hover:text-gray-900">&times;</button>
    </div>
    <form id="rdRepairForm" method="POST" action="{{ route('technician.devices.repair') }}">
      @csrf
      <input type="text" name="serial_number" placeholder="Serial Number" class="w-full border rounded p-1 mb-1" required>
      <textarea name="issues" placeholder="Describe Problems" class="w-full border rounded p-1 mb-1" required></textarea>
      <input type="text" name="solved_problems" placeholder="Solved Problems (optional)" class="w-full border rounded p-1 mb-1">
      <input type="text" name="recommendations" placeholder="Recommendations (optional)" class="w-full border rounded p-1 mb-1">
      <button type="submit" class="rd-btn w-full mt-2">Save Repair</button>
    </form>
  </div>
</div>


<!-- Devices Table -->
<div class="rd-table-responsive">
  <table class="w-full rounded-lg shadow-md" id="rdDeviceTable">
    <thead>
      <tr>
        <th>#</th><th>Brand</th><th>Model</th><th>Serial</th><th>Type</th><th>OS</th><th>Client ID</th><th>Location</th><th>Status</th><th>Registered At</th><th>Manage</th>
      </tr>
    </thead>
    <tbody>
      @foreach($devices as $device)
      <tr class="rd-tbody-tr">
        <td></td>
        <td>{{ $device->brand }}</td>
        <td>{{ $device->model }}</td>
        <td>{{ $device->serial_number }}</td>
        <td>{{ $device->type }}</td>
        <td>{{ $device->os ?? '-' }}</td>
        <td>{{ $device->client_id }}</td>
        <td>{{ $device->location ?? '-' }}</td>
        <td><span class="{{ $device->status=='active'?'bg-green-100 text-green-700 px-2 py-1 rounded':'bg-red-100 text-red-700 px-2 py-1 rounded' }}">{{ ucfirst($device->status) }}</span></td>
        <td>{{ $device->created_at->format('Y-m-d H:i') }}</td>
        <td>
          <button class="rd-btn rd-view-btn" data-target="#rdViewModal{{ $device->id }}">View</button>
          <button class="rd-btn" data-target="#rdEditModal{{ $device->id }}">Edit</button>
          <button class="rd-btn bg-red-600 hover:bg-red-700" data-target="#rdDeleteModal{{ $device->id }}">Delete</button>
        </td>
      </tr>

      <!-- View Modal -->
      <div id="rdViewModal{{ $device->id }}" class="rd-modal-overlay">
        <div class="rd-modal-content">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-[#4f46e5]">View Device</h2>
            <button class="rd-close-btn text-gray-600 hover:text-gray-900">&times;</button>
          </div>
          <div>
            <p><strong>Brand:</strong> {{ $device->brand }}</p>
            <p><strong>Model:</strong> {{ $device->model }}</p>
            <p><strong>Serial Number:</strong> {{ $device->serial_number }}</p>
            <p><strong>Type:</strong> {{ $device->type }}</p>
            <p><strong>OS:</strong> {{ $device->os ?? '-' }}</p>
            <p><strong>Client ID:</strong> {{ $device->client_id }}</p>
            <p><strong>Location:</strong> {{ $device->location ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($device->status) }}</p>
            <p><strong>Technician:</strong> {{ $device->technician ?? '-' }}</p>
            <p><strong>Solved Problems:</strong> {{ $device->solved_problems ?? '-' }}</p>
            <p><strong>Recommendations:</strong> {{ $device->recommendations ?? '-' }}</p>
          </div>
        </div>
      </div>

      <!-- Edit Modal -->
      <div id="rdEditModal{{ $device->id }}" class="rd-modal-overlay">
        <div class="rd-modal-content">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-[#4f46e5]">Edit Device</h2>
            <button class="rd-close-btn text-gray-600 hover:text-gray-900">&times;</button>
          </div>
          <form method="POST" action="{{ route('technician.devices.update', $device->id) }}">
            @csrf
            @method('PUT')
            <input type="text" name="brand" value="{{ $device->brand }}" class="w-full border rounded p-1 mb-1" required>
            <input type="text" name="model" value="{{ $device->model }}" class="w-full border rounded p-1 mb-1" required>
            <input type="text" name="serial_number" value="{{ $device->serial_number }}" class="w-full border rounded p-1 mb-1" required>
            <input type="text" name="type" value="{{ $device->type }}" class="w-full border rounded p-1 mb-1" required>
            <input type="text" name="os" value="{{ $device->os }}" class="w-full border rounded p-1 mb-1">
            <input type="number" name="client_id" value="{{ $device->client_id }}" class="w-full border rounded p-1 mb-1" required>
            <input type="text" name="location" value="{{ $device->location }}" class="w-full border rounded p-1 mb-1">
            <button type="submit" class="rd-btn w-full mt-2">Update</button>
          </form>
        </div>
      </div>

      <!-- Delete Modal -->
      <div id="rdDeleteModal{{ $device->id }}" class="rd-modal-overlay">
        <div class="rd-modal-content">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-bold text-[#4f46e5]">Delete Device</h2>
            <button class="rd-close-btn text-gray-600 hover:text-gray-900">&times;</button>
          </div>
          <form method="POST" action="{{ route('technician.devices.destroy', $device->id) }}">
            @csrf
            @method('DELETE')
            <p>Are you sure you want to delete <strong>{{ $device->brand }} {{ $device->model }}</strong>?</p>
            <button type="submit" class="rd-btn bg-red-600 hover:bg-red-700 w-full mt-2">Yes, Delete</button>
          </form>
        </div>
      </div>

      @endforeach
    </tbody>
  </table>
</div>

<!-- Pagination -->
<nav>
  <ul id="rdPagination" class="pagination mt-4"></ul>
</nav>

@include('layouts.footer')

<script>
document.addEventListener("DOMContentLoaded",()=>{

  // Register Modal
  const rdRegisterModal=document.getElementById("rdRegisterModal");
  document.getElementById("rdOpenRegisterBtn").addEventListener("click",()=>rdRegisterModal.style.display="flex");
  rdRegisterModal.querySelectorAll(".rd-close-btn").forEach(btn=>btn.addEventListener("click",()=>rdRegisterModal.style.display="none"));
  rdRegisterModal.addEventListener("click",e=>{if(e.target===rdRegisterModal) rdRegisterModal.style.display="none";});

  // Repair Modal
  const rdRepairModal=document.getElementById("rdRepairModal");
  document.getElementById("rdOpenRepairBtn").addEventListener("click",()=>rdRepairModal.style.display="flex");
  rdRepairModal.querySelectorAll(".rd-close-btn").forEach(btn=>btn.addEventListener("click",()=>rdRepairModal.style.display="none"));
  rdRepairModal.addEventListener("click",e=>{if(e.target===rdRepairModal) rdRepairModal.style.display="none";});

  // View/Edit/Delete Modals
  document.querySelectorAll("[data-target]").forEach(btn=>{
    const target=document.querySelector(btn.dataset.target);
    btn.addEventListener("click",()=>target.style.display="flex");
  });
  document.querySelectorAll(".rd-modal-overlay .rd-close-btn").forEach(btn=>{
    btn.addEventListener("click",e=>e.target.closest(".rd-modal-overlay").style.display="none");
  });
  document.querySelectorAll(".rd-modal-overlay").forEach(modal=>{
    modal.addEventListener("click",e=>{if(e.target===modal) modal.style.display="none";});
  });

  // Table Search & Pagination
  const rdTable=document.getElementById("rdDeviceTable");
  const rdPerPage=document.getElementById("rdPerPage");
  const rdPagination=document.getElementById("rdPagination");
  const rdSearchInput=document.getElementById("rdSearchInput");
  let rdRows=Array.from(rdTable.tBodies[0].rows), rdCurrentPage=1;

  function rdRenderTable(){
    const perPage=parseInt(rdPerPage.value), filter=rdSearchInput.value.toLowerCase();
    let visibleRows=[];
    rdRows.forEach(row=>{
      const cells=Array.from(row.cells).slice(1,9);
      const match=cells.some(td=>td.textContent.toLowerCase().includes(filter));
      row.style.display=match?"":"none";
      if(match)visibleRows.push(row);
    });
    visibleRows.forEach((row,i)=>row.cells[0].textContent=i+1);
    const pageCount=Math.ceil(visibleRows.length/perPage);
    rdCurrentPage=Math.min(rdCurrentPage,pageCount)||1;
    visibleRows.forEach((row,i)=>{
      const start=(rdCurrentPage-1)*perPage,end=start+perPage;
      row.style.display=(i>=start&&i<end)?"":"none";
    });
    rdPagination.innerHTML="";
    for(let i=1;i<=pageCount;i++){
      const li=document.createElement("li");li.className=`page-item ${i===rdCurrentPage?"active":""}`;
      const a=document.createElement("a");a.href="#";a.className="page-link";a.textContent=i;
      a.addEventListener("click",e=>{e.preventDefault();rdCurrentPage=i;rdRenderTable();});
      li.appendChild(a);rdPagination.appendChild(li);
    }
  }

  rdPerPage.addEventListener("change",()=>{rdCurrentPage=1;rdRenderTable();});
  rdSearchInput.addEventListener("input",()=>{rdCurrentPage=1;rdRenderTable();});
  rdRenderTable();

});
</script>

</body>
</html>
