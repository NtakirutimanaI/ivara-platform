@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Connections - IVARA</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: Arial, sans-serif; background: #f5f7fa; margin: 0; padding: 0; }
.container { padding: 20px; margin-left: 270px; margin-top: 80px; width: 80%; }
h2 { color: #333; margin-bottom: 20px; }

table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
th, td { padding: 10px; text-align: left; border-bottom: 1px solid #e0e0e0; }
th { background: #f1f1f1; font-weight: bold; }
.status-badge { padding: 4px 10px; border-radius: 6px; color: #fff; cursor: pointer; }
.status-pending { background: #f59e0b; }
.status-completed { background: #059669; }
.status-paid { background: #1e40af; }

.btn { background: #924FC2; color: #fff; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; margin-right: 5px; }
.btn:hover { background: #6366f1; }
.btn-danger { background: #ef4444; }
.btn-danger:hover { background: #dc2626; }
.filters { margin-bottom: 15px; display:flex; gap:10px; flex-wrap: wrap; }
.filters select { padding:6px 10px; border-radius:5px; border:1px solid #ccc; }

#notification { display:none; position: fixed; top: 20px; right: 20px; z-index:2000; padding: 15px; border-radius: 8px; color:#fff; font-weight:bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); }
</style>
</head>
<body>

<div id="notification"></div>

<div class="container">
    <h2><i class="fa fa-network-wired"></i> Manage Connections</h2>

    <!-- Filters & Export -->
    <div class="filters">
        <select id="filterLocation">
            <option value="">-- All Locations --</option>
            @foreach($locations as $loc)
                <option value="{{ $loc }}">{{ $loc }}</option>
            @endforeach
        </select>
        <select id="filterTechnician">
            <option value="">-- All Technicians --</option>
            @foreach($technicians as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
            @endforeach
        </select>
        <select id="filterStatus">
            <option value="">-- All Status --</option>
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
            <option value="Paid">Paid</option>
        </select>
        <button class="btn" onclick="exportConnections()">Export CSV</button>
    </div>

    <!-- Connections Table -->
    <table id="connectionsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Location</th>
                <th>Technician</th>
                <th>Service</th>
                <th>Client</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($connections as $index => $conn)
            <tr data-id="{{ $conn->id }}" data-location="{{ $conn->location }}" data-technician="{{ $conn->technician_id }}" data-status="{{ $conn->status }}">
                <td>{{ $index+1 }}</td>
                <td>{{ $conn->location }}</td>
                <td>
                    <select class="inline-technician">
                        @foreach($technicians as $tech)
                            <option value="{{ $tech->id }}" {{ $tech->id == $conn->technician_id ? 'selected' : '' }}>
                                {{ $tech->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $conn->service->name }}</td>
                <td>{{ $conn->client->name }}</td>
                <td>
                    <select class="inline-payment">
                        <option value="cash" {{ $conn->payment_method=='cash' ? 'selected':'' }}>Cash</option>
                        <option value="mtn_momo" {{ $conn->payment_method=='mtn_momo' ? 'selected':'' }}>MTN MoMo</option>
                        <option value="airtel_money" {{ $conn->payment_method=='airtel_money' ? 'selected':'' }}>Airtel Money</option>
                        <option value="card" {{ $conn->payment_method=='card' ? 'selected':'' }}>Card</option>
                        <option value="bank" {{ $conn->payment_method=='bank' ? 'selected':'' }}>Bank Transfer</option>
                    </select>
                </td>
                <td>
                    <span class="status-badge status-{{ strtolower($conn->status) }}" onclick="toggleStatus({{ $conn->id }}, this)">
                        {{ $conn->status }}
                    </span>
                </td>
                <td>
                    <button class="btn" onclick="viewConnection({{ $conn->id }})"><i class="fa fa-eye"></i></button>
                    <button class="btn btn-danger" onclick="deleteConnection({{ $conn->id }})"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- View Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeViewModal()">&times;</span>
        <h3>Connection Details</h3>
        <div id="viewContent"></div>
    </div>
</div>

<!-- Notification Function -->
<script>
function showNotification(message, type='success'){
    const notif = document.getElementById('notification');
    notif.innerText = message;
    notif.style.backgroundColor = type==='success' ? '#059669' : type==='error' ? '#EF4444' : '#924FC2';
    notif.style.display='block';
    setTimeout(()=>{ notif.style.display='none'; }, 4000);
}

// Inline Technician
document.querySelectorAll('.inline-technician').forEach(select=>{
    select.addEventListener('change', function(){
        const row = this.closest('tr');
        fetch(`/admin/connections/${row.dataset.id}/update-technician`, {
            method:'POST',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'},
            body: JSON.stringify({ technician_id: this.value })
        }).then(res=>res.json())
          .then(data=>{ if(data.success) showNotification("Technician updated successfully!"); })
          .catch(()=>showNotification("Failed to update technician.", "error"));
    });
});

// Inline Payment
document.querySelectorAll('.inline-payment').forEach(select=>{
    select.addEventListener('change', function(){
        const row = this.closest('tr');
        fetch(`/admin/connections/${row.dataset.id}/update-payment`, {
            method:'POST',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'},
            body: JSON.stringify({ payment_method: this.value })
        }).then(res=>res.json())
          .then(data=>{ if(data.success) showNotification("Payment method updated successfully!"); })
          .catch(()=>showNotification("Failed to update payment method.", "error"));
    });
});

// Inline Status
function toggleStatus(connectionId, element){
    let currentStatus = element.innerText;
    let nextStatus = currentStatus==='Pending'?'Completed':currentStatus==='Completed'?'Paid':'Pending';
    fetch(`/admin/connections/${connectionId}/update-status`, {
        method:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'},
        body: JSON.stringify({ status: nextStatus })
    }).then(res=>res.json())
      .then(data=>{ if(data.success){ element.innerText=nextStatus; element.className='status-badge status-'+nextStatus.toLowerCase(); showNotification(`Status updated to ${nextStatus}!`); } })
      .catch(()=>showNotification("Failed to update status.", "error"));
}

// View Modal
function viewConnection(id){
    fetch(`/admin/connections/${id}`)
    .then(res=>res.text())
    .then(html=>{
        document.getElementById('viewContent').innerHTML = html;
        document.getElementById('viewModal').style.display='block';
    });
}
function closeViewModal(){ document.getElementById('viewModal').style.display='none'; }

// Delete Connection
function deleteConnection(id){
    if(!confirm("Are you sure you want to delete this connection?")) return;
    fetch(`/admin/connections/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'} })
    .then(res=>res.json())
    .then(data=>{ if(data.success){ document.querySelector(`tr[data-id='${id}']`).remove(); showNotification("Connection deleted successfully!"); } })
    .catch(()=>showNotification("Failed to delete connection.", "error"));
}

// Filters
document.getElementById('filterLocation').addEventListener('change', applyFilters);
document.getElementById('filterTechnician').addEventListener('change', applyFilters);
document.getElementById('filterStatus').addEventListener('change', applyFilters);

function applyFilters(){
    const loc = document.getElementById('filterLocation').value;
    const tech = document.getElementById('filterTechnician').value;
    const status = document.getElementById('filterStatus').value;

    document.querySelectorAll('#connectionsTable tbody tr').forEach(tr=>{
        const matchLoc = loc==='' || tr.dataset.location===loc;
        const matchTech = tech==='' || tr.dataset.technician===tech;
        const matchStatus = status==='' || tr.dataset.status===status;
        tr.style.display = (matchLoc && matchTech && matchStatus)?'':'none';
    });
}

// Export CSV
function exportConnections(){
    let csv='Location,Technician,Service,Client,Payment Method,Status\n';
    document.querySelectorAll('#connectionsTable tbody tr').forEach(tr=>{
        if(tr.style.display==='none') return;
        const tds = tr.querySelectorAll('td');
        csv += `${tds[1].innerText},${tds[2].querySelector('select').selectedOptions[0].text},${tds[3].innerText},${tds[4].innerText},${tds[5].querySelector('select').value},${tds[6].innerText}\n`;
    });
    const blob = new Blob([csv], {type:'text/csv'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'connections_export.csv';
    a.click();
}
</script>

@include('layouts.footer')
</body>
</html>
