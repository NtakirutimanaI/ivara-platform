
@include('layouts.footer')
@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<div class="container">
    <h2>Client Management</h2>

    <!-- ===== Add Client Button ===== -->
    <button class="btn-add-client" onclick="openModal('addClientModal')">Add Client</button>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <!-- ===== Search + Filters + Rows per Page ===== -->
    <form method="GET" class="filters">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="🔍 Search clients..." id="searchInput">
        <select name="status" id="statusFilter">
            <option value="">All Clients</option>
            <option value="active" {{ (isset($status) && $status=='active')?'selected':'' }}>Active</option>
            <option value="inactive" {{ (isset($status) && $status=='inactive')?'selected':'' }}>Inactive</option>
            <option value="pending" {{ (isset($status) && $status=='pending')?'selected':'' }}>Pending</option>
        </select>
        <select name="per_page" id="itemsPerPage">
            <option value="5" {{ (isset($perPage) && $perPage==5)?'selected':'' }}>5</option>
            <option value="10" {{ (isset($perPage) && $perPage==10)?'selected':'' }}>10</option>
            <option value="20" {{ (isset($perPage) && $perPage==20)?'selected':'' }}>20</option>
        </select>
        <button type="submit" class="btn-search">Apply</button>
    </form>

    <!-- ===== Clients Table ===== -->
    <div class="table-wrapper">
        <table id="clientsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subscription</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @if(!empty($clients) && $clients->count() > 0)
                    @foreach($clients as $index => $client)
                        <tr data-status="{{ $client->status }}" data-visible="true">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->user ? $client->user->name : $client->name }}</td>
                            <td>{{ $client->user ? $client->user->email : $client->email }}</td>
                            <td>{{ $client->user ? $client->user->phone : $client->phone }}</td>
                            <td>{{ ucfirst($client->subscription) }}</td>
                            <td>
                                <span class="status-badge {{ $client->status }}">
                                    {{ ucfirst($client->status) }}
                                </span>
                            </td>
                            <td class="actions">
                                <button class="btn-view" onclick="openModal('viewModal-{{ $client->id }}')">View</button>
                                <button class="btn-status" onclick="openModal('statusModal-{{ $client->id }}')">
                                    {{ $client->status == 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button class="btn-notify" onclick="openModal('notifyModal-{{ $client->id }}')">Notify</button>
                                <form action="{{ route('manager.clients.destroy', $client->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Include your existing modals -->
                        @include('manager.partials.client_modals', ['client' => $client])

                        <!-- ===== Notify Modal (POST Form) ===== -->
                        <div id="notifyModal-{{ $client->id }}" class="modal hidden">
                            <div class="modal-content small">
                                <h3>Send Notification to {{ $client->name }}</h3>
                                <form action="{{ route('manager.clients.notify', $client->id) }}" method="POST">
                                    @csrf
                                    <input type="text" name="message" placeholder="Enter message..." required>
                                    <div class="modal-actions">
                                        <button type="submit" class="btn-save">Send</button>
                                        <button type="button" class="close-btn" onclick="closeModal('notifyModal-{{ $client->id }}')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align:center;">No clients found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- ===== Add Client Modal ===== -->
<div id="addClientModal" class="modal hidden">
    <div class="modal-content small">
        <h3>Add New Client</h3>
        <form action="{{ route('manager.clients.store') }}" method="POST" onsubmit="return checkDuplicateEmail(event)">
            @csrf
            <input type="text" name="name" placeholder="Enter full name..." required>
            <input type="email" name="email" placeholder="Enter client email..." required>
            <input type="text" name="phone" placeholder="Enter phone number...">
            <select name="subscription">
                <option value="">Select Subscription</option>
                <option value="basic">Basic</option>
                <option value="premium">Premium</option>
                <option value="vip">VIP</option>
            </select>
            <select name="status">
                <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="pending">Pending</option>
            </select>
            <div class="modal-actions">
                <button type="submit" class="btn-save">Save</button>
                <button type="button" class="close-btn" onclick="closeModal('addClientModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="toastContainer"></div>

<!-- =================== JS =================== -->
<script>
function openModal(id){document.getElementById(id).classList.remove('hidden');}
function closeModal(id){document.getElementById(id).classList.add('hidden');}

function checkDuplicateEmail(e){
    const form = e.target;
    const emailInput = form.querySelector('input[name="email"]').value.toLowerCase();
    const existingEmails = [...document.querySelectorAll('#clientsTable tbody tr td:nth-child(3)')].map(td => td.textContent.toLowerCase());
    if(existingEmails.includes(emailInput)){
        showToast('⚠️ Email already exists! Please use a different one.');
        e.preventDefault();
        return false;
    }
    return true;
}

const searchInput=document.getElementById('searchInput');
const statusFilter=document.getElementById('statusFilter');
const tbody=document.getElementById('tableBody');
const itemsPerPageSelect=document.getElementById('itemsPerPage');
let current_page=1;
let rows_per_page=parseInt(itemsPerPageSelect.value);

function filterClients(){
    const searchText=searchInput.value.toLowerCase();
    const statusText=statusFilter.value.toLowerCase();
    [...tbody.querySelectorAll('tr')].forEach(row=>{
        const cells=row.querySelectorAll('td');
        const name=cells[1].textContent.toLowerCase();
        const email=cells[2].textContent.toLowerCase();
        const phone=cells[3].textContent.toLowerCase();
        const status=row.dataset.status.toLowerCase();
        const matchesSearch=name.includes(searchText)||email.includes(searchText)||phone.includes(searchText);
        const matchesStatus=statusText===''||status===statusText;
        row.dataset.visible=(matchesSearch&&matchesStatus)?"true":"false";
    });
    displayRows();
}

function displayRows(){
    const rows=[...tbody.querySelectorAll('tr')].filter(r=>r.dataset.visible!=="false");
    let start=(current_page-1)*rows_per_page;
    let end=start+rows_per_page;
    rows.forEach((row,i)=>row.style.display=(i>=start&&i<end)?'':'none');
}

searchInput.addEventListener('input',filterClients);
statusFilter.addEventListener('change',filterClients);
itemsPerPageSelect.addEventListener('change',()=>{rows_per_page=parseInt(itemsPerPageSelect.value);displayRows();});

document.addEventListener('DOMContentLoaded',()=>{[...tbody.querySelectorAll('tr')].forEach(r=>r.dataset.visible="true");displayRows();});

function showToast(message){
    const c=document.getElementById("toastContainer");
    const t=document.createElement("div");
    t.className="toast";t.textContent=message;c.appendChild(t);
    setTimeout(()=>t.style.opacity=1,100);
    setTimeout(()=>{t.style.opacity=0;setTimeout(()=>t.remove(),400)},4000);
}
</script>

@include('layouts.footer')

<style>
body {
    background: #f7f9fc;
    color: #333;
    font-family: 'Poppins', sans-serif;
}
.container {
    max-width: 82%;
    margin-left: 260px;
    margin-top: 0px;
    padding: 20px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
h2 {
    font-size: 20px;
    font-weight: 600;
    color: #924FC2;
    margin-bottom: 12px;
}
.btn-add-client {
    background: linear-gradient(90deg,#924FC2,#6B21A8);
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 13px;
}
.alert-success {
    background: #e7f9ed;
    color: #0f5132;
    padding: 8px;
    border-left: 4px solid #16a34a;
    border-radius: 5px;
    margin-bottom: 10px;
    text-align: center;
    font-size: 13px;
}
.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 12px;
}
.filters input, .filters select {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 13px;
}
.btn-search {
    background: #924FC2;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 13px;
    cursor: pointer;
}
.table-wrapper {
    overflow-x: auto;
}
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
th, td {
    padding: 8px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}
th {
    background: #f9fafb;
    color: #555;
    font-weight: 600;
}
tr:hover { background: #f3f0ff; }

.status-badge {
    padding: 3px 8px;
    border-radius: 12px;
    color: white;
    font-size: 11px;
    text-transform: capitalize;
}
.status-badge.active { background: #16a34a; }
.status-badge.inactive { background: #dc2626; }
.status-badge.pending { background: #f59e0b; }

.actions { display: flex; flex-wrap: wrap; gap: 4px; justify-content: center; }
.actions button, .actions form button {
    border: none;
    border-radius: 5px;
    padding: 5px 8px;
    color: white;
    font-size: 11px;
    cursor: pointer;
    transition: transform 0.2s ease;
}
.actions button:hover { transform: scale(1.05); }

.btn-view { background: #1d4ed8; height:20px; width:50px;}
.btn-edit { background: #f59e0b;height:20px; width:50px;}
.btn-status { background: #dc2626; height:20px; width:50px;}
.btn-notify { background: #924FC2; height:20px; width:50px;}
.btn-invoice { background: #16a34a; height:20px; width:50px;}
.btn-delete { background: #374151; height:20px; width:50px; }

.modal {
    position: fixed; top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.4);
    display: flex; justify-content: center; align-items: center;
    z-index: 999;
}
.modal-content {
    background: #fff;
    padding: 16px;
    border-radius: 10px;
    width: 100%;
    max-width: 360px; /* smaller modal */
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.modal-content h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #924FC2;
}
.modal-content input, .modal-content select {
    width: 100%;
    padding: 6px 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 8px;
    font-size: 13px;
}
.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-top: 10px;
}
.btn-save { background: #1d4ed8; color: #fff; border: none; border-radius: 6px; padding: 6px 10px; }
.close-btn { background: #e5e7eb; color: #333; border: none; border-radius: 6px; padding: 6px 10px; }
.hidden { display: none; }

#toastContainer { position: fixed; top: 15px; right: 15px; z-index: 2000; }
.toast {
    background: #333;
    color: #fff;
    padding: 8px 14px;
    border-radius: 6px;
    margin-top: 6px;
    opacity: 0;
    transition: opacity 0.4s;
}
</style>