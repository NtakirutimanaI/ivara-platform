@include('layouts.header')
@include('layouts.sidebar')
@include('supervisor.connect')

<div class="container">
    <h2>Client Management</h2>

    <!-- ===== Add Client Button ===== -->
    <button class="btn-add-client" onclick="openModal('addClientModal')">Add Client</button>

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search + Filters + Rows per Page -->
    <form method="GET" class="filters">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search clients..." id="searchInput">
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

    <!-- Clients Table -->
    <div class="table-wrapper">
        <table id="clientsTable">
            <thead>
                <tr>
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
                    @foreach($clients as $client)
                    <tr data-status="{{ $client->status }}" data-visible="true">
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
                            <button class="btn-edit" onclick="openModal('editModal-{{ $client->id }}')">Edit</button>
                            <button class="btn-status" onclick="openModal('statusModal-{{ $client->id }}')">
                                {{ $client->status == 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                            <button class="btn-notify" onclick="openModal('notifyModal-{{ $client->id }}')">Notify</button>
                            <button class="btn-invoice" onclick="openModal('invoiceModal-{{ $client->id }}')">Invoice</button>
                            <form action="{{ route('manager.clients.destroy', $client->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- ===== Modals (View, Edit, Status, Notify, Invoice) ===== -->
                    @include('manager.partials.client_modals', ['client' => $client])

                    @endforeach
                @else
                    <tr>
                        <td colspan="6" style="text-align:center;">No clients found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $clients->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- ===== Add Client Modal ===== -->
<div id="addClientModal" class="modal hidden">
    <div class="modal-content">
        <h3>Add New Client</h3>
        <form action="{{ route('manager.clients.store') }}" method="POST">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Email:</label>
            <input type="email" name="email">
            <label>Phone:</label>
            <input type="text" name="phone">
            <label>Subscription:</label>
            <select name="subscription">
                <option value="basic">Basic</option>
                <option value="premium">Premium</option>
                <option value="vip">VIP</option>
            </select>
            <label>Status:</label>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="pending">Pending</option>
            </select>
            <div style="margin-top:10px; display:flex; gap:6px; justify-content:flex-end;">
                <button type="submit" class="btn-save">Save</button>
                <button type="button" class="close-btn" onclick="closeModal('addClientModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast Container -->
<div id="toastContainer"></div>

<!-- =================== SCRIPTS =================== -->
<script>
// ===== Original JS =====
function openModal(id){document.getElementById(id).classList.remove('hidden')}
function closeModal(id){document.getElementById(id).classList.add('hidden')}

const searchInput=document.getElementById('searchInput');
const statusFilter=document.getElementById('statusFilter');
const tbody=document.getElementById('tableBody');
const pagination=document.getElementById('pagination');
const itemsPerPageSelect=document.getElementById('itemsPerPage');

let current_page=1;
let rows_per_page=parseInt(itemsPerPageSelect.value);

function filterClients(){
    const searchText=searchInput.value.toLowerCase();
    const statusText=statusFilter.value.toLowerCase();
    [...tbody.querySelectorAll('tr')].forEach(row=>{
        const cells=row.querySelectorAll('td');
        const name=cells[0].textContent.toLowerCase();
        const email=cells[1].textContent.toLowerCase();
        const phone=cells[2].textContent.toLowerCase();
        const status=row.dataset.status.toLowerCase();
        const matchesSearch=name.includes(searchText)||email.includes(searchText)||phone.includes(searchText);
        const matchesStatus=statusText===''||status===statusText;
        row.dataset.visible=(matchesSearch&&matchesStatus)?"true":"false";
    });
    setupPagination();
}

searchInput.addEventListener('input',filterClients);
statusFilter.addEventListener('change',filterClients);

function displayRows(){
    const rows=[...tbody.querySelectorAll('tr')].filter(r=>r.dataset.visible!=="false");
    let start=(current_page-1)*rows_per_page;
    let end=start+rows_per_page;
    rows.forEach((row,i)=>row.style.display=(i>=start&&i<end)?'':'none');
}

function setupPagination(){
    rows_per_page=parseInt(itemsPerPageSelect.value);
    pagination.innerHTML='';
    const rows=[...tbody.querySelectorAll('tr')].filter(r=>r.dataset.visible!=="false");
    const page_count=Math.ceil(rows.length/rows_per_page);
    if(current_page>page_count) current_page=page_count>0?page_count:1;
    for(let i=1;i<=page_count;i++){
        const btn=document.createElement('button');
        btn.innerText=i;
        if(i===current_page) btn.classList.add('active');
        btn.addEventListener('click',()=>{current_page=i;displayRows();updatePaginationButtons();});
        pagination.appendChild(btn);
    }
    displayRows();
}

function updatePaginationButtons(){
    pagination.querySelectorAll('button').forEach((btn,idx)=>btn.classList.toggle('active',idx+1===current_page));
}

document.addEventListener('DOMContentLoaded',()=>{
    [...tbody.querySelectorAll('tr')].forEach(r=>r.dataset.visible="true");
    setupPagination();

    document.querySelectorAll('.delete-form').forEach(form=>{
        form.addEventListener('submit',function(e){
            e.preventDefault();
            if(!confirm('Are you sure you want to delete this client?')) return;
            fetch(this.action,{method:"POST",body:new FormData(this)})
            .then(r=>r.ok?this.closest('tr').remove():Promise.reject())
            .then(()=>{showToast("Client deleted successfully"); setupPagination();})
            .catch(()=>alert("Failed to delete client"));
        });
    });
});

itemsPerPageSelect.addEventListener('change',setupPagination);

document.addEventListener("keydown",e=>{if(e.key==="Escape") document.querySelectorAll(".modal").forEach(m=>m.classList.add("hidden"));});
document.querySelectorAll(".modal").forEach(m=>m.addEventListener("click",e=>{if(e.target===m) m.classList.add("hidden");}));

function showToast(message){
    const c=document.getElementById("toastContainer");
    const t=document.createElement("div");
    t.className="toast";t.textContent=message;c.appendChild(t);
    setTimeout(()=>t.style.opacity=1,100);
    setTimeout(()=>{t.style.opacity=0;setTimeout(()=>t.remove(),400)},4000);
}
</script>

<style>
/* ===== Original CSS ===== */
.container {max-width:80%; margin-left:260px;margin-top:80px; font-family:Arial,sans-serif; font-size:12px; }
h2 { font-size:22px; font-weight:bold; margin-bottom:8px; }
.btn-add-client { background:#16a34a; color:white; padding:6px 10px; border-radius:4px; border:none; margin-bottom:6px; cursor:pointer; font-size:12px; }
.alert-success { background:#d1fae5; color:#065f46; padding:6px; border-radius:4px; margin-bottom:8px; font-size:12px; text-align:center; }
.filters { display:flex; flex-wrap:wrap; gap:6px; margin-bottom:8px; justify-content:center; }
.filters input, .filters select { padding:6px; border-radius:3px; border:1px solid #ccc; flex:1; min-width:100px; font-size:12px; }
.table-wrapper { overflow-x:auto; background:#fff; padding:6px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
table { width:100%; border-collapse:collapse; font-size:12px; min-width:600px; }
table th, table td { padding:4px; border-bottom:1px solid #ddd; text-align:left; vertical-align:middle; }
table th { background:#f3f4f6; font-weight:bold; font-size:12px; }
table tr:nth-child(odd) { background:#f9f9f9; }
table tr:hover { background:#e6f2ff; cursor:pointer; }
.status-badge { padding:1px 4px; border-radius:3px; font-size:11px; color:white; }
.status-badge.active { background:#16a34a;width:70px; height:25px; font-size:12px; }
.status-badge.inactive { background:#dc2626; width:70px; height:25px; font-size:12px;}
.status-badge.pending { background:#f59e0b;width:70px; height:25px; font-size:12px; }
.actions { display:flex; flex-wrap:wrap; gap:3px; justify-content:center; }
.actions button, .actions form button { padding:4px 6px; border-radius:3px; border:none; cursor:pointer; color:white; font-size:11px; white-space:nowrap; flex:1 1 70px; }
.btn-view { background:#1d4ed8;width:70px; height:25px; font-size:18px;}
.btn-edit { background:#f59e0b;width:70px; height:25px; font-size:18px; }
.btn-status { background:#dc2626;width:70px; height:25px; font-size:18px; }
.btn-notify { background:#4f46e5;width:70px; height:25px; font-size:18px; }
.btn-invoice { background:#16a34a;width:70px; height:25px; font-size:18px; }
.btn-delete { background:#374151;width:70px; height:25px; font-size:18px; }
.btn-save { background:#1d4ed8; }
.btn-status-action { background:#dc2626; }
.btn-notify-send { background:#4f46e5; }
.btn-invoice-generate { background:#16a34a; }
.modal { position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:flex; justify-content:center; align-items:center; z-index:50; padding:10px; }
.modal-content { background:#fff; padding:12px; border-radius:6px; width:100%; max-width:450px; max-height:90vh; overflow-y:auto; font-size:12px; }
.hidden { display:none; }
.close-btn { background:#ccc; padding:4px 8px; border-radius:4px; margin-top:4px; cursor:pointer; font-size:11px; }
.pagination-container { margin:6px 0; display:flex; flex-wrap:wrap; justify-content:center; align-items:center; gap:4px; font-size:14px; }
.pagination-container select { padding:3px 5px; border-radius:3px; border:1px solid #ccc; font-size:11px; }
#pagination button { padding:3px 6px; border-radius:3px; border:1px solid #4f46e5; background:white; color:#4f46e5; cursor:pointer; margin:0 1px; font-size:11px; }
#pagination button.active { background:#4f46e5; color:white; }
#toastContainer { position:fixed; top:15px; right:15px; z-index:2000; font-size:12px; }

@media (max-width: 1200px) {
    .container { max-width: 95%; margin-left: 20px; }
    .filters { flex-direction: column; gap: 4px; }
    .filters input, .filters select { flex: 1 1 100%; }
    .actions { flex-direction: column; }
    .actions button, .actions form button { flex: 1 1 100%; margin-bottom: 3px; }
}
@media (max-width: 768px) {
    .container { margin-left: 10px; font-size: 11px; }
    h2 { font-size: 16px; }
    table th, table td { padding: 3px; font-size: 11px; }
    .status-badge { width: auto; font-size: 11px; }
    .btn-view, .btn-edit, .btn-status, .btn-notify, .btn-invoice, .btn-delete {
        width: 100%; height: auto; font-size: 12px;
    }
    .table-wrapper { padding: 4px; }
    .modal-content { max-width: 90%; padding: 10px; font-size: 11px; }
    .pagination-container { flex-direction: column; gap: 4px; }
}
@media (max-width: 480px) {
    .filters input, .filters select, .filters button { font-size: 10px; padding: 4px; }
    table th, table td { font-size: 10px; padding: 2px; }
    .actions button, .actions form button { font-size: 10px; padding: 3px; }
    .status-badge { font-size: 10px; padding: 1px 3px; }
    h2 { font-size: 14px; }
}
</style>

@include('layouts.footer')
