@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Bookings</title>
<style>
body { 
    font-family:'Segoe UI', sans-serif; 
    background:#112240; 
    color:white; 
    text-align:center; 
    margin-top:100px;
}

table { 
    margin:0 auto; 
    border-collapse:collapse; 
    width:80%; 
}

th, td { 
    border: none; 
    border-bottom: 1px solid #FFB600; 
    padding:10px; 
    text-align:center;
}

th { 
    background:#FFB600; 
    color:black; 
    border-bottom: 2px solid #FFB600; 
}

.confirm-btn { 
    background:#FFB600; 
    color:black; 
    border:none; 
    padding:10px 20px; 
    margin-top:20px; 
    cursor:pointer; 
    font-weight:bold; 
    border-radius:6px; 
}

.action-btn { 
    background:#FFB600; 
    color:black; 
    border:none; 
    padding:6px 12px; 
    margin:2px; 
    cursor:pointer; 
    font-weight:bold; 
    border-radius:6px; 
}

.message { 
    margin-top:20px; 
    font-weight:bold; 
    color:#FFB600; 
}

/* Modal Styles */
.modal {
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.6);
    justify-content:center;
    align-items:center;
}
.modal-content {
    background:#1c2b4d;
    padding:20px;
    border-radius:8px;
    width:400px;
    text-align:left;
}
.modal-content h3 {
    color:#FFB600;
    margin-bottom:15px;
}
.modal-content label {
    display:block;
    margin-top:10px;
    font-size:14px;
}
.modal-content input, .modal-content textarea {
    width:100%;
    padding:8px;
    margin-top:5px;
    border-radius:4px;
    border:1px solid #FFB600;
}
.close-btn {
    background:red;
    color:white;
    border:none;
    padding:6px 12px;
    cursor:pointer;
    border-radius:4px;
    float:right;
}
.save-btn {
    background:#FFB600;
    color:black;
    border:none;
    padding:8px 16px;
    border-radius:4px;
    cursor:pointer;
    margin-top:15px;
}
</style>
</head>
<body>

<h2 style="color:#FFB600;margin-bottom:20px;">Confirm Your Bookings</h2>

@if($services->isEmpty())
    <p>No bookings added yet.</p>
@else
<table>
<tr>
    <th>Service Name</th>
    <th>Description</th>
    <th>Price (RWF)</th>
    <th>Actions</th>
</tr>
@php $total = 0; @endphp
@foreach($services as $service)
@php $total += $service->price; @endphp
<tr>
    <td>{{ $service->name }}</td>
    <td>{{ $service->description }}</td>
    <td>{{ number_format($service->price) }}</td>
    <td>
        <button class="action-btn" onclick="openEditModal({{ $service->id }}, '{{ $service->name }}', '{{ $service->description }}', '{{ $service->price }}')">Edit</button>
        <form action="{{ route('bookings.delete', $service->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn">Delete</button>
        </form>
    </td>
</tr>
@endforeach
<tr>
    <th colspan="2" style="text-align:right;">Total</th>
    <th colspan="2">{{ number_format($total) }} RWF</th>
</tr>
</table>

<form action="{{ route('bookings.confirm.submit') }}" method="POST" id="confirmForm">
    @csrf
    <button type="submit" class="confirm-btn">Confirm Bookings</button>
</form>
@endif

@if(session('success'))
<div class="message">{{ session('success') }}</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            document.querySelector('table')?.remove();
            document.getElementById('confirmForm')?.remove();
        }, 500);
    });
</script>
@endif

@if(session('error'))
<div class="message">{{ session('error') }}</div>
@endif

<!-- Edit Modal -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" onclick="closeModal()">X</button>
    <h3>Edit Booking</h3>
    <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="editId" name="id">
        
        <label>Service Name</label>
        <input type="text" id="editName" name="name" required>

        <label>Description</label>
        <textarea id="editDescription" name="description" required></textarea>

        <label>Price (RWF)</label>
        <input type="number" id="editPrice" name="price" required>

        <button type="submit" class="save-btn">Save Changes</button>
    </form>
  </div>
</div>

<script>
function openEditModal(id, name, description, price) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editPrice').value = price;

    let form = document.getElementById('editForm');
    form.action = '/bookings/update/' + id;

    document.getElementById('editModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>

</body>
</html>
