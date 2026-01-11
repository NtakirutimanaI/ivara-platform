@include('layouts.header')
@include('layouts.sidebar')
@include('mediator.connect')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
<div class="container">

    {{-- Level & Deleted Clients Row --}}
    <div class="step-box" style="display:flex; gap:20px; flex-wrap:wrap; align-items:flex-start;">

        {{-- Level Info Card --}}
        <div style="flex:1; background:#f1f5f9; padding:15px; border-radius:10px; min-width:250px;">
            <h2>Hello, {{ auth()->user()->name }}</h2>
            @php
                $totalClients = $clients->count();
                $level = 'Bronze';
                $commission = '5%';
                $nextTarget = 250;

                if ($totalClients >= 1000) {
                    $level = 'Elite';
                    $commission = '20%';
                    $nextTarget = null;
                } elseif ($totalClients >= 750) {
                    $level = 'Gold';
                    $commission = '15%';
                    $nextTarget = 1000;
                } elseif ($totalClients >= 500) {
                    $level = 'Silver';
                    $commission = '10%';
                    $nextTarget = 750;
                } elseif ($totalClients >= 250) {
                    $level = 'Bronze';
                    $commission = '5%';
                    $nextTarget = 500;
                }

                $remaining = $nextTarget ? $nextTarget - $totalClients : 0;
                $progress = $nextTarget ? min(100, ($totalClients / $nextTarget) * 100) : 100;

                $levels = [
                    ['name'=>'Bronze','color'=>'#cd7f32','commission'=>'5%','clients'=>250,'benefit'=>'Access to basic tools'],
                    ['name'=>'Silver','color'=>'#c0c0c0','commission'=>'10%','clients'=>500,'benefit'=>'Priority support'],
                    ['name'=>'Gold','color'=>'#924FC2','commission'=>'15%','clients'=>750,'benefit'=>'Premium service access'],
                    ['name'=>'Elite','color'=>'#ff4500','commission'=>'20%','clients'=>1000,'benefit'=>'Top tier perks & recognition'],
                ];
            @endphp

            <p>Your current level: <strong>{{ $level }}</strong></p>
            <p>Total Clients: <strong>{{ $totalClients }}</strong></p>
            <p>Commission on Service Payments: <strong>{{ $commission }}</strong></p>
            @if($nextTarget)
                <p>Remaining to next level: <strong>{{ $remaining }}</strong> clients</p>
                <div class="progress-bar" style="background:#4f46e5; width: {{ $progress }}%; height:10px; border-radius:5px; margin:5px 0;"></div>
            @else
                <p>You’ve reached the highest level 🎉</p>
            @endif

            <div class="levels-container">
                @foreach($levels as $lvl)
                    <div class="level-card" style="border-top:5px solid {{ $lvl['color'] }}">
                        <h4>{{ $lvl['name'] }}</h4>
                        <p>Commission: {{ $lvl['commission'] }}</p>
                        <p>Requirement: {{ $lvl['clients'] }} clients</p>
                        <p>{{ $lvl['benefit'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Deleted Clients Card --}}
        <div style="flex:0 0 200px; background:#fee2e2; color:#b91c1c; font-weight:bold; text-align:center; padding:15px; border-radius:10px;">
            Deleted Clients<br>
            <span id="deletedClientsCount" style="font-size:24px;">0</span>
        </div>
    </div>

    {{-- Record New Client --}}
    <div class="step-box">
        <h3>Do you have a new client now?</h3>
        <button class="btn" onclick="openModal('addClientModal')">Record New Client</button>
    </div>

    {{-- Clients Table --}}
    <div class="step-box" id="clientsTableBox">
        <h3>Clients</h3>
        <input type="text" id="searchClient" placeholder="Search Clients..." onkeyup="filterClients()">
        <table id="clientsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>City</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $i => $client)
                    <tr @if($client->status=='pending') class="highlight" @endif data-id="{{ $client->id }}">
                        <td>{{ $i+1 }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email ?? '-' }}</td>
                        <td>{{ $client->city ?? '-' }}</td>
                        <td>{{ ucfirst($client->status) }}</td>
                        <td>
                            <button class="btn" onclick="openModal('viewClientModal{{ $client->id }}')">View</button>
                            <button class="btn" onclick="openServiceModal({{ $client->id }})">Record Service</button>
                            <button class="btn" class="btn_delete" onclick="removeClientFromPage({{ $client->id }})" title="Remove">  <i class="fa fa-trash" style="color:#b91c1c;"></i></button>
                        </td>
                    </tr>

                    {{-- View Client Modal --}}
                    <div id="viewClientModal{{ $client->id }}" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('viewClientModal{{ $client->id }}')">&times;</span>
                            <h3>{{ $client->name }}</h3>
                            <p><strong>Phone:</strong> {{ $client->phone }}</p>
                            <p><strong>Email:</strong> {{ $client->email ?? '-' }}</p>
                            <p><strong>City:</strong> {{ $client->city ?? '-' }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($client->status) }}</p>
                            <p><strong>Notes:</strong> {{ $client->notes ?? '-' }}</p>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- Add Client Modal --}}
<div id="addClientModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addClientModal')">&times;</span>
        <h3>Add New Client</h3>
        <form id="addClientForm" action="{{ route('mediator.addClient') }}" method="POST">
            @csrf
            <label>Name</label>
            <input type="text" name="name" placeholder = "Enter Client Fullname" required>
            <label>Phone</label>
            <input type="text" name="phone" placeholder = "Enter Client Phone" required>
            <label>Email</label>
            <input type="email" name="email" placeholder = "Enter Client Email">
            <label>City</label>
            <input type="text" name="city" placeholder = "Enter Client living City">
            <label>Notes</label>
            <textarea name="notes" placeholder = "Enter Client Notes on our Service"></textarea>
            <button type="submit" class="btn">Add Client</button>
        </form>
    </div>
</div>

{{-- Service Modal --}}
<div id="serviceModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('serviceModal')">&times;</span>
        <h3>Record Service</h3>
        <form id="serviceForm">
            @csrf
            <input type="hidden" id="client_id" name="client_id">
            <label>Select Service</label>
            <select name="service_id" id="service_id" required>
                <option value="">-- Choose Service --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }} - Frw{{ $service->price }}</option>
                @endforeach
            </select>
            <button type="button" class="btn" onclick="openPaymentModal()">Record Service & Process Payment</button>
        </form>
    </div>
</div>

{{-- Payment Modal --}}
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('paymentModal')">&times;</span>
        <h3>Process Payment</h3>
        <form id="paymentForm">
            @csrf
            <input type="hidden" id="payment_client_id" name="client_id">
            <input type="hidden" id="payment_service_id" name="service_id">
            <label>Payment Method</label>
            <select name="method" required>
                <option value="">-- Choose Method --</option>
                <option value="cash">Cash</option>
                <option value="mtn_momo">MTN Momo</option>
                <option value="airtel_money">Airtel Money</option>
                <option value="card">Card</option>
            </select>
            <label>Amount</label>
            <input type="number" name="payment_amount" id="payment_amount" readonly>
            <label>Transaction ID / Reference</label>
            <input type="text" name="transaction_id" required>
            <button type="submit" class="btn">Process Payment</button>
        </form>
    </div>
</div>

<div id="successToast" style="display:none; position:fixed; top:20px; right:20px; background:#4f46e5; color:white; padding:15px; border-radius:8px; z-index:2000;">Success!</div>

<script>
let deletedClientsCount = 0;
let deletedClients = JSON.parse(localStorage.getItem('deletedClients')) || [];
deletedClientsCount = deletedClients.length;
document.getElementById('deletedClientsCount').textContent = deletedClientsCount;

// Remove deleted clients from page on load
deletedClients.forEach(id=>{
    const row = document.querySelector('tr[data-id="'+id+'"]');
    if(row) row.remove();
});
updateRowNumbers();

function filterClients(){
    const input = document.getElementById('searchClient').value.toLowerCase();
    document.querySelectorAll('#clientsTable tbody tr').forEach(row=>{
        row.style.display = row.cells[1].textContent.toLowerCase().includes(input) ? '' : 'none';
    });
}

function openModal(id){ document.getElementById(id).style.display='block'; }
function closeModal(id){ document.getElementById(id).style.display='none'; }
window.onclick=function(e){
    document.querySelectorAll('.modal').forEach(m=>{
        if(e.target==m)m.style.display='none';
    });
}

function openServiceModal(clientId){
    document.getElementById('client_id').value = clientId;
    openModal('serviceModal');
}

function openPaymentModal(){
    const clientId = document.getElementById('client_id').value;
    const serviceSelect = document.getElementById('service_id');
    const serviceId = serviceSelect.value;
    if(!serviceId){ alert('Select a service first'); return; }

    const price = serviceSelect.selectedOptions[0].dataset.price;
    document.getElementById('payment_client_id').value = clientId;
    document.getElementById('payment_service_id').value = serviceId;
    document.getElementById('payment_amount').value = price;

    closeModal('serviceModal');
    openModal('paymentModal');
}

document.getElementById('addClientForm').addEventListener('submit', function(e){
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': data.get('_token')},
        body: data
    }).then(r=>r.json())
    .then(res=>{
        if(res.success){
            closeModal('addClientModal');
            showToast("New client added!");
            form.reset();

            const tbody = document.querySelector('#clientsTable tbody');
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-id', res.client.id);
            newRow.innerHTML = `
                <td></td>
                <td>${res.client.name}</td>
                <td>${res.client.phone}</td>
                <td>${res.client.email || '-'}</td>
                <td>${res.client.city || '-'}</td>
                <td>${res.client.status.charAt(0).toUpperCase() + res.client.status.slice(1)}</td>
                <td>
                    <button class="btn" onclick="openModal('viewClientModal${res.client.id}')">View</button>
                    <button class="btn" onclick="openServiceModal(${res.client.id})">Record Service</button>
                    <button class="btn" id="btn_delete" onclick="removeClientFromPage(${res.client.id})" title="Remove"> <i class="fa fa-trash" style="color:#b91c1c;"></i></button>
                </td>
            `;
            tbody.appendChild(newRow);

            const modalDiv = document.createElement('div');
            modalDiv.id = `viewClientModal${res.client.id}`;
            modalDiv.className = 'modal';
            modalDiv.innerHTML = `
                <div class="modal-content">
                    <span class="close" onclick="closeModal('viewClientModal${res.client.id}')">&times;</span>
                    <h3>${res.client.name}</h3>
                    <p><strong>Phone:</strong> ${res.client.phone}</p>
                    <p><strong>Email:</strong> ${res.client.email || '-'}</p>
                    <p><strong>City:</strong> ${res.client.city || '-'}</p>
                    <p><strong>Status:</strong> ${res.client.status.charAt(0).toUpperCase() + res.client.status.slice(1)}</p>
                    <p><strong>Notes:</strong> ${res.client.notes || '-'}</p>
                </div>
            `;
            document.body.appendChild(modalDiv);

            updateRowNumbers();
            newRow.scrollIntoView({behavior:'smooth'});
        }else{
            alert('Error: ' + (res.error||'Unknown'));
        }
    });
});

document.getElementById('paymentForm').addEventListener('submit', function(e){
    e.preventDefault();
    const form =    e.target;
    const data = new FormData(form);

    fetch("{{ route('mediator.recordServicePayment') }}", {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': data.get('_token')},
        body: data
    }).then(r=>r.json())
    .then(res=>{
        if(res.success){
            closeModal('paymentModal');
            showToast(res.success);
            form.reset();
        }else{
            alert('Error: ' + (res.error||'Unknown'));
        }
    });
});

// Permanently remove client from page
function removeClientFromPage(id){
    if(confirm('Are you sure you want to remove this client from the list?')){
        const row = document.querySelector('tr[data-id="'+id+'"]');
        if(row) row.remove();
        deletedClients.push(id);
        localStorage.setItem('deletedClients', JSON.stringify(deletedClients));
        deletedClientsCount++;
        document.getElementById('deletedClientsCount').textContent = deletedClientsCount;
        updateRowNumbers();
    }
}

// Update row numbering after deletion/addition
function updateRowNumbers(){
    document.querySelectorAll('#clientsTable tbody tr').forEach((row, index)=>{
        row.cells[0].textContent = index+1;
    });
}

function showToast(msg){
    const toast = document.getElementById('successToast');
    toast.textContent = msg;
    toast.style.display='block';
    setTimeout(()=>toast.style.display='none',3000);
}
</script>

@include('layouts.footer')

<style>
.container{margin-left:300px;margin-top:70px;padding:20px;width:70%;font-size:12px;font-family: 'Poppins', sans-serif;}
.step-box{background:#fff;padding:15px;border-radius:10px;margin-bottom:25px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
.levels-container{display:flex;flex-wrap:wrap;gap:10px;}
.level-card{flex:1 1 120px;padding:10px;text-align:center;border-radius:8px;background:#f1f5f9;position:relative;}
.level-card h4{margin:5px 0;}
.progress-bar{border-radius:4px;}
table{width:100%;border-collapse:collapse;margin-top:15px;}
th,td{padding:10px;border-bottom:1px solid #4f46e5;text-align:left;font-size:13px;}
th{background:#f1f1f1;}
.btn{background:#4f46e5;color:#fff;padding:6px 12px;border:none;border-radius:5px;cursor:pointer;margin-top:5px;}
.btn:hover{background:#4338ca;}
#btn_delete{background:#924FC2;}
#btn_delete:hover{color:green;}
.modal{display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgba(0,0,0,0.6);}
.modal-content{background:#fff;margin:5% auto;padding:20px;border-radius:10px;width:80%;max-width:500px;box-shadow:0 4px 8px rgba(0,0,0,0.3);}
.close{float:right;font-size:22px;font-weight:bold;cursor:pointer;color:#333;}
.close:hover{color:red;}
.highlight{background:#fff4e5;}
input,textarea,select{width:100%;padding:8px;margin:5px 0;border-radius:5px;border:1px solid #ccc;}
</style>

