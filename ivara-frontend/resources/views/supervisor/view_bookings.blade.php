
@include('layouts.header')
@include('layouts.sidebar')
@include('supervisor.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Supervisor - View Bookings</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #112240;
    color: white;
    margin: 0;
    padding: 20px;
}
.container {
    width: 80%;
    margin-left: 240px;
    margin-top: 80px;
    max-width: 1200px;
}
h1 { margin-bottom: 20px; color: #FFB600; }
table {
    width: 100%;
    border-collapse: collapse;
    background: #1c3454;
    border-radius: 8px;
    overflow: hidden;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #2c4a70;
    text-align: left;
    word-wrap: break-word;
}
th { background: #0f1e36; }
tr:hover { background: #22395e; }
button { background: #FFB600; border: none; padding: 6px 12px; color: black; border-radius: 4px; cursor: pointer; margin:2px; }
button:hover { background: #e0a800; }
select, input { padding: 6px; border-radius: 4px; border: none; }

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.7);
    justify-content: center;
    align-items: center;
    z-index: 999;
}
.modal-content {
    background: #1c3454;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    color: white;
    position: relative;
}
.modal-header { display:flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.close { cursor: pointer; font-size: 20px; }
.modal form { display: flex; flex-direction: column; }

/* Responsive */
@media (max-width: 992px) {
    .container { width: 95%; margin-left: 15px;margin-top: 160px;  }
     th, td { font-size: 12px; }
}
@media (max-width: 768px) {
    .container { width: 95%; margin-left: 15px; margin-top: 160px; }
    table, thead, tbody, th, td, tr { display: block; }
    th { display: none; }
    td { display: flex; justify-content: space-between; padding: 6px; }
    td:before { content: attr(data-label); font-weight: bold; color:#FFB600; }
}
.pagination-container { margin-top: 15px; display: flex; justify-content: space-between; align-items: center; }
</style>
</head>
<body>
<div class="container">
<h1>Supervisor - View Bookings</h1>

<div class="pagination-container">
    <div>
        Show 
        <select id="rowsPerPage" class="form-select d-inline-block w-auto">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="15">15</option>
        </select>
        entries
    </div>
    <nav>
        <ul class="pagination" id="pagination"></ul>
    </nav>
</div>

<table id="bookingsTable">
<thead>
<tr>
    <th>#</th>
    <th>Client</th>
    <th>Service</th>
    <th>Status</th>
    <th>Assigned To</th>
    <th>Manage</th>
</tr>
</thead>
<tbody>
@php $counter = 1; @endphp
@foreach($bookings as $booking)
<tr class="booking-row" id="booking-row-{{ $booking->id }}">
    <td data-label="#"> {{ $counter++ }} </td>
    <td data-label="Client">{{ $booking->client->name ?? 'N/A' }}</td>
    <td data-label="Service">{{ $booking->service->name ?? 'N/A' }}</td>
    <td data-label="Status">{{ $booking->status }}</td>
    <td data-label="Assigned To" class="assigned-name">{{ $booking->assigned_name ?? 'Unassigned' }}</td>
    <td data-label="Action">
        <button onclick="openAssignModal({{ $booking->id }})">Assign</button>
        <button onclick="openStatusModal({{ $booking->id }}, '{{ $booking->status }}')">Change Status</button>
        <button onclick="openNotifyModal({{ $booking->id }})">Notify</button>
        <form action="{{ route('supervisor.bookings.delete', $booking->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Are you sure to delete?')">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!-- Assign Modal -->
<div class="modal" id="assignModal">
<div class="modal-content">
    <div class="modal-header">
        <h3>Assign Technician/Team</h3>
        <span class="close" onclick="closeAssignModal()">&times;</span>
    </div>
    <form id="assignForm">
        <input type="hidden" id="bookingId" name="bookingId">
        <label for="assigned_id">Select Technician or Team:</label>
        <select name="assigned_id" id="assigned_id" required>
            <option value="">-- Select --</option>
            <optgroup label="Technicians">
            @foreach($technicians as $tech)
                <option value="technician-{{ $tech->id }}">{{ $tech->name }}</option>
            @endforeach
            </optgroup>
            <optgroup label="Teams">
            @foreach($teams as $team)
                <option value="team-{{ $team->id }}">{{ $team->full_name }}</option>
            @endforeach
            </optgroup>
        </select>
        <button type="submit">Assign</button>
    </form>
    <p id="assignMessage" style="margin-top:10px;"></p>
</div>
</div>

<!-- Change Status Modal -->
<div class="modal" id="statusModal">
<div class="modal-content">
    <div class="modal-header">
        <h3>Change Booking Status</h3>
        <span class="close" onclick="closeStatusModal()">&times;</span>
    </div>
    <form id="statusForm">
        <input type="hidden" id="statusBookingId" name="bookingId">
        <label for="status">Select Status:</label>
        <select name="status" id="statusSelect" required>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Cancelled">Cancelled</option>
        </select>
        <button type="submit">Update Status</button>
    </form>
</div>
</div>

<!-- Notify Modal -->
<div class="modal" id="notifyModal">
<div class="modal-content">
    <div class="modal-header">
        <h3>Send Notification</h3>
        <span class="close" onclick="closeNotifyModal()">&times;</span>
    </div>
    <form id="notifyForm">
        <input type="hidden" id="notifyBookingId" name="bookingId">
        <label>Message:</label>
        <input type="text" name="message" id="notifyMessage" required placeholder="Enter message">
        <button type="submit">Send</button>
    </form>
    <p id="notifyFeedback" style="margin-top:10px;"></p>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
let currentBookingId = null;

// ===== Client-side Pagination =====
const rowsPerPageSelect = document.getElementById('rowsPerPage');
const table = document.getElementById('bookingsTable');
const rows = Array.from(table.querySelectorAll('.booking-row'));
const pagination = document.getElementById('pagination');

let currentPage = 1;

function renderTablePage(page = 1) {
    const rowsPerPage = parseInt(rowsPerPageSelect.value);
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    rows.forEach((row, index) => {
        row.style.display = (index >= start && index < end) ? '' : 'none';
        if(index >= start && index < end) row.querySelector('td:first-child').textContent = index + 1;
    });

    renderPagination(rowsPerPage);
}

function renderPagination(rowsPerPage) {
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    pagination.innerHTML = '';

    for(let i=1; i<=totalPages; i++){
        const li = document.createElement('li');
        li.classList.add('page-item', i === currentPage ? 'active' : '');
        const a = document.createElement('a');
        a.classList.add('page-link');
        a.href = "#";
        a.textContent = i;
        a.addEventListener('click', e=>{
            e.preventDefault();
            currentPage = i;
            renderTablePage(currentPage);
        });
        li.appendChild(a);
        pagination.appendChild(li);
    }
}

rowsPerPageSelect.addEventListener('change', () => {
    currentPage = 1;
    renderTablePage(currentPage);
});

// Initialize table
renderTablePage(currentPage);

// ===== Your existing modals JS (Assign, Status, Notify) remains unchanged =====
function openAssignModal(id){ currentBookingId = id; document.getElementById('bookingId').value = id; document.getElementById('assignModal').style.display='flex'; }
function closeAssignModal(){ document.getElementById('assignModal').style.display='none'; document.getElementById('assignMessage').textContent=''; document.getElementById('assignForm').reset(); }

document.getElementById('assignForm').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch(`/supervisor/bookings/${currentBookingId}/assign`,{
        method:'POST',
        headers:{ 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept':'application/json' },
        body: formData
    })
       .then(response => response.json())
    .then(data => {
        let msg = document.getElementById('assignMessage');
        if(data.success){
            msg.style.color='lightgreen';
            msg.textContent = data.message;
            document.querySelector(`#booking-row-${currentBookingId} .assigned-name`).textContent = data.assigned_name;
            setTimeout(closeAssignModal, 1000);
        } else {
            msg.style.color='red';
            msg.textContent = data.message || 'Assignment failed';
        }
    })
    .catch(err=>{
        let msg = document.getElementById('assignMessage');
        msg.style.color='red';
        msg.textContent='Something went wrong.';
        console.error(err);
    });
});

// ===== Change Status =====
function openStatusModal(id,status){
    currentBookingId = id;
    document.getElementById('statusBookingId').value = id;
    document.getElementById('statusSelect').value = status;
    document.getElementById('statusModal').style.display='flex';
}
function closeStatusModal(){ document.getElementById('statusModal').style.display='none'; document.getElementById('statusForm').reset(); }

document.getElementById('statusForm').addEventListener('submit', function(e){
    e.preventDefault();
    let status = document.getElementById('statusSelect').value;
    fetch(`/supervisor/bookings/${currentBookingId}/status`,{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept':'application/json',
            'Content-Type':'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data=>{
        if(data.success){
            document.querySelector(`#booking-row-${currentBookingId} td[data-label="Status"]`).textContent = status;
            closeStatusModal();
        } else {
            alert(data.message || 'Failed to update status');
        }
    }).catch(err=>{
        console.error(err);
        alert('Something went wrong.');
    });
});

// ===== Notify =====
function openNotifyModal(id){
    currentBookingId = id;
    document.getElementById('notifyBookingId').value = id;
    document.getElementById('notifyModal').style.display='flex';
}
function closeNotifyModal(){
    document.getElementById('notifyModal').style.display='none';
    document.getElementById('notifyForm').reset();
    document.getElementById('notifyFeedback').textContent='';
}

document.getElementById('notifyForm').addEventListener('submit', function(e){
    e.preventDefault();
    let message = document.getElementById('notifyMessage').value;
    fetch(`/supervisor/bookings/${currentBookingId}/notify`,{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept':'application/json',
            'Content-Type':'application/json'
        },
        body: JSON.stringify({ message: message })
    })
    .then(res => res.json())
    .then(data=>{
        let feedback = document.getElementById('notifyFeedback');
        if(data.success){
            feedback.style.color='lightgreen';
            feedback.textContent=data.message;
            setTimeout(closeNotifyModal,1000);
        } else {
            feedback.style.color='red';
            feedback.textContent=data.message || 'Failed to send';
        }
    }).catch(err=>{
        console.error(err);
        document.getElementById('notifyFeedback').style.color='red';
        document.getElementById('notifyFeedback').textContent='Something went wrong.';
    });
});

// Close modals when clicking outside content
window.onclick = function(event){
    ['assignModal','statusModal','notifyModal'].forEach(modalId=>{
        let modal=document.getElementById(modalId);
        if(event.target == modal) modal.style.display='none';
    });
}
</script>
</body>
</html>
