@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Self Registration</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f4f5f7; font-family: Arial, sans-serif; font-size: 0.85rem; }
.page-container { width: 75%; margin-left: 230px; margin-top: 120px; padding: 10px; }

@media(max-width:1024px){.page-container{width:100%;margin-left:0;}}

/* Card Styling */
.card { background:#fff; padding:15px; margin-bottom:15px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s ease; }
.card:hover { transform: translateY(-2px); }

/* Form Inputs */
.form-control, .form-select, textarea { border-radius:5px; font-size:0.85rem; padding:6px 8px; }
textarea { resize: vertical; }

/* Headings */
.card h3 { margin-bottom:12px; color:#0d6efd; font-size:1rem; }

/* Buttons */
.btn { border-radius:5px; font-size:0.85rem; transition: 0.3s ease; padding:5px 12px; }
.btn-submit { background:#0d6efd; color:#fff; border:none; }
.btn-submit:hover { background:#0b5ed7; transform: scale(1.05); }

/* Choice Buttons */
.choice-container { display:flex; flex-wrap:wrap; justify-content:center; gap:8px; margin-bottom:15px; }
.btn-choice { flex:1 1 150px; max-width:180px; background:#6c757d; color:#fff; border:none; cursor:pointer; border-radius:5px; transition:0.3s ease; text-align:center; }
.btn-choice:hover { background:#5a6268; transform: scale(1.05); }

/* Alerts */
.alert { margin-top:10px; padding:5px 10px; font-size:0.85rem; }

/* Hidden Forms Initially */
.registration-form { display:none; }

/* Responsive */
@media(max-width:576px){
  .page-container { padding:8px; margin-top:180px; }
  .card h3 { font-size:0.95rem; }
  .btn-choice, .btn-submit { font-size:0.8rem; padding:4px 10px; }
  .form-control, .form-select, textarea { font-size:0.8rem; padding:5px 6px; }
  .choice-container { gap:6px; flex-direction:column; align-items:center; }
  .btn-choice { max-width:100%; flex:1; }
}
</style>
</head>
<body>

<div class="page-container">

  {{-- Success/Error Messages --}}
  @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
  @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

  {{-- Choice Section --}}
  <div class="card text-center">
      <h3>What would you like to register?</h3>
      <div class="choice-container">
          <button class="btn-choice" onclick="showForm('vehicle')">Vehicle</button>
          <button class="btn-choice" onclick="showForm('device')">Device / Computer</button>
          <button class="btn-choice" onclick="showForm('tailor')">Tailor Item</button>
          <button class="btn-choice" onclick="showForm('craft')">Craft Repair</button>
      </div>
  </div>

  {{-- Vehicle Form --}}
  <div class="card registration-form" id="vehicle-form">
    <h3>Register Vehicle</h3>
    <form action="{{ route('self-register.vehicle') }}" method="POST">
      @csrf
      <input type="text" name="registration_number" class="form-control mb-2" placeholder="Registration Number" required pattern="[A-Za-z0-9\-]+">
      <input type="text" name="make" class="form-control mb-2" placeholder="Make" required pattern="[A-Za-z\s]+">
      <input type="text" name="model" class="form-control mb-2" placeholder="Model" required>
      <input type="number" name="year" class="form-control mb-2" placeholder="Year" min="1900" max="2099">
      <input type="text" name="color" class="form-control mb-2" placeholder="Color" required>
      <input type="text" name="vehicle_type" class="form-control mb-2" placeholder="Vehicle Type" required>
      <button type="submit" class="btn btn-submit">Register Vehicle</button>
    </form>
  </div>

  {{-- Device Form --}}
  <div class="card registration-form" id="device-form">
    <h3>Register Device / Computer</h3>
    <form action="{{ route('self-register.device') }}" method="POST">
      @csrf
      <input type="text" name="device_type" class="form-control mb-2" placeholder="Device Type" required>
      <input type="text" name="device_name" class="form-control mb-2" placeholder="Device Name" required>
      <input type="text" name="serial_number" class="form-control mb-2" placeholder="Serial Number" required pattern="[A-Za-z0-9\-]+">
      <input type="text" name="brand" class="form-control mb-2" placeholder="Brand" required>
      <input type="text" name="model" class="form-control mb-2" placeholder="Model" required>
      <input type="text" name="operating_system" class="form-control mb-2" placeholder="Operating System">
      <input type="text" name="device_owner" class="form-control mb-2" placeholder="Owner Name" required pattern="[A-Za-z\s]+">
      <input type="text" name="contact_number" class="form-control mb-2" placeholder="Contact Number" required pattern="[0-9]{8,15}">
      <textarea name="problem_description" class="form-control mb-2" placeholder="Problem Description" required></textarea>
      <select name="warranty_status" class="form-select mb-2" required>
        <option value="Under Warranty">Under Warranty</option>
        <option value="Out of Warranty">Out of Warranty</option>
      </select>
      <button type="submit" class="btn btn-submit">Register Device</button>
    </form>
  </div>

  {{-- Tailor Form --}}
  <div class="card registration-form" id="tailor-form">
    <h3>Register Tailor Item</h3>
    <form action="{{ route('self-register.tailor') }}" method="POST">
      @csrf
      <input type="text" name="customer_name" class="form-control mb-2" placeholder="Customer Name" required pattern="[A-Za-z\s]+">
      <input type="text" name="customer_contact" class="form-control mb-2" placeholder="Customer Contact" pattern="[0-9]{8,15}">
      <input type="text" name="item_name" class="form-control mb-2" placeholder="Item Name" required>
      <input type="text" name="item_model" class="form-control mb-2" placeholder="Item Model">
      <textarea name="repair_details" class="form-control mb-2" placeholder="Repair Details" required></textarea>
      <input type="number" step="0.01" min="0" name="price" class="form-control mb-2" placeholder="Price">
      <input type="date" name="date_received" class="form-control mb-2" required>
      <input type="date" name="expected_completion_date" class="form-control mb-2">
      <select name="repair_status" class="form-select mb-2">
        <option value="Pending" selected>Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
        <option value="Collected">Collected</option>
      </select>
      <button type="submit" class="btn btn-submit">Register Tailor Item</button>
    </form>
  </div>

  {{-- Craft Form --}}
  <div class="card registration-form" id="craft-form">
    <h3>Register Craftsperson Repair</h3>
    <form action="{{ route('self-register.craft') }}" method="POST">
      @csrf
      <input type="text" name="craftsperson_name" class="form-control mb-2" placeholder="Craftsperson Name" required pattern="[A-Za-z\s]+">
      <input type="text" name="craft_type" class="form-control mb-2" placeholder="Craft Type" required>
      <input type="text" name="repair_item" class="form-control mb-2" placeholder="Repair Item" required>
      <textarea name="repair_description" class="form-control mb-2" placeholder="Repair Description"></textarea>
      <input type="date" name="repair_date" class="form-control mb-2" required>
      <input type="number" step="0.01" min="0" name="repair_cost" class="form-control mb-2" placeholder="Repair Cost">
      <input type="text" name="client_name" class="form-control mb-2" placeholder="Client Name">
      <input type="text" name="client_contact" class="form-control mb-2" placeholder="Client Contact" pattern="[0-9]{8,15}">
      <select name="status" class="form-select mb-2">
        <option value="Pending" selected>Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
      </select>
      <button type="submit" class="btn btn-submit">Register Craft Repair</button>
    </form>
  </div>

</div>

@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showForm(type){
    document.querySelectorAll('.registration-form').forEach(f => f.style.display='none');
    if(type==='vehicle') document.getElementById('vehicle-form').style.display='block';
    if(type==='device') document.getElementById('device-form').style.display='block';
    if(type==='tailor') document.getElementById('tailor-form').style.display='block';
    if(type==='craft') document.getElementById('craft-form').style.display='block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
</body>
</html>
