@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mediator Connections - IVARA</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body { font-family: Arial, sans-serif; background: #f5f7fa; margin: 0; padding: 0; }
    .container { padding: 20px; margin-left: 300px; margin-top: 100px; width: 70%; }
    h2 { color: #333; margin-bottom: 15px; }
    .step-box { margin-bottom: 30px; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    label { font-weight: bold; margin-right: 10px; }
    select, input, textarea { padding: 8px; margin-top: 8px; border-radius: 5px; border: 1px solid #ccc; width: 100%; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th, td { padding: 10px; border-bottom: 1px solid #4f46e5; text-align: left; }
    th { background: #f1f1f1; }
    .btn { background: #4f46e5; color: #fff; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; margin-top:20px; }
    .btn:hover { background: #b9b6e9ff; }
    .btn-secondary { background: #4f46e5; color: #fff; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
    .btn-secondary:hover { background: #059669; }

    /* Modal styles */
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); }
    .modal-content { background: #fff; margin: 5% auto; padding: 20px; border-radius: 10px; width: 80%; max-width: 900px; box-shadow: 0 4px 8px rgba(0,0,0,0.3); }
    .close { float: right; font-size: 22px; font-weight: bold; cursor: pointer; color: #333; }
    .close:hover { color: red; }

    /* Payment Interface */
    .payment-interface { display: none; margin-top: 20px; padding: 15px; border-radius: 8px; }
    .payment-interface h4 { margin-top: 0; }
    .payment-interface label { font-weight: bold; display: block; margin-top: 10px; }

    /* Notification */
    #notification { display:none; position: fixed; top: 20px; right: 20px; z-index:2000; padding: 15px; border-radius: 8px; color:#fff; font-weight:bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); }
</style>
</head>
<body>

<div id="notification"></div>

<div class="container">
    <h2><i class="fa fa-network-wired"></i> Mediator Connections</h2>

    <!-- Step 1: Select Location -->
    <div id="locationStep" class="step-box">
        <h3><i class="fa fa-map-marker-alt"></i> Step 1: Select Location</h3>
        <form id="locationForm" method="GET" action="{{ route('mediator.connections') }}">
            <label for="location">Choose Location:</label>
            <select name="location" id="location" onchange="handleLocationSelect()">
                <option value="">-- Select Location --</option>
                @foreach($locations as $loc)
                    <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>
                        {{ $loc }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<!-- Modal: Technicians -->
<div id="techniciansModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeTechnicians()">&times;</span>
        <h3><i class="fa fa-tools"></i> Step 2: Select Available Technicians</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Technician Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Experience</th>
                    <th>Track Service</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($technicians) && $technicians->count() > 0)
                    @foreach($technicians as $index => $tech)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $tech->name }}</td>
                        <td>{{ $tech->email }}</td>
                        <td>{{ $tech->phone }}</td>
                        <td>{{ $tech->experience ?? 'N/A' }} yrs</td>
                        <td>
                            <button class="btn" onclick="showServices({{ $tech->id }})">Select</button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="6">No technicians available.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Services -->
<div id="servicesModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeServices()">&times;</span>
        <h3><i class="fa fa-cogs"></i> Step 3: Select Services by Technician</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Connect Client</th>
                </tr>
            </thead>
            <tbody id="servicesTableBody">
                @if(!empty($services) && $services->count() > 0)
                    @foreach($services as $index => $service)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>
                            <button class="btn" onclick="showClientModal({{ $service->id }}, {{ $service->technician_id }})">
                                Connect Client
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="4">Select a technician to view services.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Clients -->
<div id="clientsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeClients()">&times;</span>
        <h3><i class="fa fa-users"></i> Step 4: Add or Select Client & Make Payment</h3>
        <button class="btn-secondary" onclick="openAddClientModal()">+ Add Client</button>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Pay Service</th>
                </tr>
            </thead>
            <tbody id="clientsTableBody">
                @if(!empty($clients) && count($clients) > 0)
                    @foreach($clients as $index => $client)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email ?? 'N/A' }}</td>
                        <td>
                            <select onchange="openPaymentInterface({{ $client->id }}, this.value)">
                                <option value="">-- Select Payment Method --</option>
                                <option value="cash">Cash</option>
                                <option value="mtn_momo">MTN MoMo</option>
                                <option value="airtel_money">Airtel Money</option>
                                <option value="card">Card</option>
                                <option value="bank">Bank Transfer</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="5">No clients available.</td></tr>
                @endif
            </tbody>
        </table>

        <!-- Payment Interface -->
        <div id="paymentInterface" class="payment-interface">
            <h4>Payment Details</h4>
            <p><strong>Client:</strong> <span id="pi_client_name"></span></p>
            <p><strong>Service:</strong> <span id="pi_service_name"></span></p>
            <p><strong>Payment Method:</strong> <span id="pi_method"></span></p>

            <form id="paymentForm" method="POST" action="{{ route('mediator.payments.process') }}">
                @csrf
                <input type="hidden" name="booking_id" id="pi_booking_id">

                <!-- Dynamic inputs based on payment method -->
                <div id="pi_fields"></div>

                <button type="submit" class="btn">Confirm Payment</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Client -->
<div id="addClientModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddClientModal()">&times;</span>
        <h3><i class="fa fa-user-plus"></i> Add New Client</h3>
        <form id="addClientForm">
            @csrf
            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter Client Fullname" required>
            
            <label>Phone:</label>
            <input type="text" name="phone" placeholder="Enter Client Phone" required>
            
            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter Client Email">
            
            <label>Address:</label>
            <input type="text" name="address" placeholder="Enter Client Address">
            
            <label>City:</label>
            <input type="text" name="city" placeholder="City">
            
            <label>Country:</label>
            <input type="text" name="country" value="Rwanda">
            
            <label>National ID:</label>
            <input type="text" name="national_id" placeholder="Enter Client ID">
            
            <label>Gender:</label>
            <select name="gender">
                <option value="">-- Select Gender --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth">
            
            <label>Notes:</label>
            <textarea name="notes" placeholder="Enter Notes if Any!"></textarea>

            <button type="submit" class="btn">Save Client</button>
        </form>
    </div>
</div>

<script>
function showNotification(message, type='success'){
    const notif = document.getElementById('notification');
    notif.innerText = message;
    if(type==='success') notif.style.backgroundColor = '#059669';
    else if(type==='error') notif.style.backgroundColor = '#EF4444';
    else notif.style.backgroundColor = '#4f46e5';
    notif.style.display = 'block';
    setTimeout(()=>{ notif.style.display='none'; }, 4000);
}

// Step 1: Location select
function handleLocationSelect(){
    let form = document.getElementById('locationForm');
    if(document.getElementById('location').value !== ""){
        showNotification("Location selected successfully!", "success");
        form.submit();
    }
}

@if(!empty($technicians) && $technicians->count() > 0 && request('location'))
    document.getElementById('locationStep').style.display='none';
    document.getElementById('techniciansModal').style.display='block';
@endif

@if(!empty($services) && $services->count() > 0 && request('technician'))
    document.getElementById('techniciansModal').style.display='none';
    document.getElementById('servicesModal').style.display='block';
@endif

function closeTechnicians(){ document.getElementById('techniciansModal').style.display='none'; document.getElementById('locationStep').style.display='block'; }
function closeServices(){ document.getElementById('servicesModal').style.display='none'; document.getElementById('techniciansModal').style.display='block'; }
function showServices(techId){
    showNotification("Technician selected successfully!", "success");
    let url = new URL(window.location.href);
    url.searchParams.set('technician', techId);
    window.location.href = url.toString();
}

function showClientModal(serviceId, techId){
    window.selectedServiceId = serviceId;
    window.selectedTechId = techId;
    document.getElementById('servicesModal').style.display='none';
    document.getElementById('clientsModal').style.display='block';
    window.selectedServiceName = document.querySelector(`#servicesTableBody tr td:nth-child(2)`).innerText;
}

function closeClients(){
    document.getElementById('clientsModal').style.display='none';
    document.getElementById('servicesModal').style.display='block';
    document.getElementById('paymentInterface').style.display='none';
}

function openAddClientModal(){
    document.getElementById('clientsModal').style.display='none';
    document.getElementById('addClientModal').style.display='block';
}

function closeAddClientModal(){
    document.getElementById('addClientModal').style.display='none';
    document.getElementById('clientsModal').style.display='block';
}

// Show Payment Interface dynamically
function openPaymentInterface(clientId, method){
    if(method==="") return;

    const clientRow = document.querySelector(`#clientsTableBody tr:nth-child(${clientId})`);
    const clientName = clientRow ? clientRow.cells[1].innerText : "Client";
    const serviceName = window.selectedServiceName || "Service";

    document.getElementById('pi_client_name').innerText = clientName;
    document.getElementById('pi_service_name').innerText = serviceName;
    document.getElementById('pi_method').innerText = method;
    document.getElementById('pi_booking_id').value = clientId;

    // Build dynamic payment fields
    const piFields = document.getElementById('pi_fields');
    piFields.innerHTML = ""; // reset

    if(method==='mtn_momo'){
        piFields.innerHTML = `<label>MTN MoMo Phone Number:</label><input type="text" name="payment_contact" placeholder="Enter MTN MoMo number" required style="border:1px solid #FFD700;">`;
        document.getElementById('paymentInterface').style.backgroundColor='#FFF9E5';
    } else if(method==='airtel_money'){
        piFields.innerHTML = `<label>Airtel Money Number:</label><input type="text" name="payment_contact" placeholder="Enter Airtel Money number" required style="border:1px solid #FF4D4F;">`;
        document.getElementById('paymentInterface').style.backgroundColor='#FFEDED';
    } else if(method==='card'){
        piFields.innerHTML = `
            <label>Card Number:</label><input type="text" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" required style="border:1px solid #1E40AF;">
            <label>Expiry Date:</label><input type="month" name="card_expiry" required>
            <label>CVV:</label><input type="text" name="card_cvv" required>`;
        document.getElementById('paymentInterface').style.backgroundColor='#E5F0FF';
    } else if(method==='bank'){
        piFields.innerHTML = `
            <label>Bank Name:</label><input type="text" name="bank_name" placeholder="Enter Bank Name" required style="border:1px solid #059669;">
            <label>Account Number:</label><input type="text" name="bank_account" placeholder="Enter Account Number" required>`;
        document.getElementById('paymentInterface').style.backgroundColor='#E6FFFA';
    } else{
        document.getElementById('paymentInterface').style.backgroundColor='#F9F9FF';
    }

    document.getElementById('paymentInterface').style.display='block';
    window.scrollTo({ top: document.getElementById('paymentInterface').offsetTop, behavior: 'smooth' });
}

// AJAX Add Client
document.getElementById('addClientForm').addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch('{{ route("mediator.clients.store") }}',{
        method:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body: formData
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            const tableBody = document.getElementById('clientsTableBody');
            const newIndex = tableBody.rows.length + 1;
            const client = data.client;
            let row = tableBody.insertRow();
            row.innerHTML = `
                <td>${newIndex}</td>
                <td>${client.name}</td>
                <td>${client.phone}</td>
                <td>${client.email ?? 'N/A'}</td>
                <td>
                    <select onchange="openPaymentInterface(${client.id}, this.value)">
                        <option value="">-- Select Payment Method --</option>
                        <option value="cash">Cash</option>
                        <option value="mtn_momo">MTN MoMo</option>
                        <option value="airtel_money">Airtel Money</option>
                        <option value="card">Card</option>
                        <option value="bank">Bank Transfer</option>
                    </select>
                </td>`;
            closeAddClientModal();
            this.reset();
            showNotification("Client added successfully!", "success");
        }
    })
    .catch(err=>{console.error(err); showNotification("Failed to add client.", "error");});
});

// Optional: AJAX Payment form submit can also show notification
document.getElementById('paymentForm').addEventListener('submit', function(){
    showNotification("Payment processed successfully!", "success");
});
</script>

</body>
</html>

@include('layouts.footer')
