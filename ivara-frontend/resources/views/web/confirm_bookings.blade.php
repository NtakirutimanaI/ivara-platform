@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Bookings</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --primary-navy: #0A1128;
  --secondary-navy: #162447;
  --accent-gold: #ffb700;
  --white: #ffffff;
  --bg-light: #f8f9fa;
}

body { 
  font-family: 'Poppins', sans-serif; 
  background: linear-gradient(135deg, var(--bg-light) 0%, #e4e9f2 100%);
  color: var(--primary-navy); 
  text-align: center; 
  margin-top: 80px;
  min-height: 100vh;
  padding-bottom: 50px;
}

h2 {
  background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-size: 2.5rem;
  margin-bottom: 30px;
  font-weight: 800;
}

table { 
  margin: 0 auto; 
  border-collapse: separate;
  border-spacing: 0;
  width: 85%; 
  background: var(--white);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(10, 17, 40, 0.1);
}

th, td { 
  border: none; 
  border-bottom: 1px solid rgba(10, 17, 40, 0.08);
  padding: 16px 20px; 
  text-align: center;
}

th { 
  background: linear-gradient(135deg, rgba(10, 17, 40, 0.95) 0%, rgba(22, 36, 71, 0.95) 100%);
  color: var(--white);
  font-weight: 700;
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

td {
  color: #666;
  font-weight: 500;
}

tr:last-child td {
  border-bottom: none;
}

tr:hover td {
  background: rgba(255, 183, 0, 0.05);
}

.confirm-btn { 
  background: var(--accent-gold);
  color: var(--primary-navy);
  border: 2px solid var(--accent-gold);
  padding: 14px 35px; 
  margin-top: 30px; 
  cursor: pointer; 
  font-weight: 700; 
  border-radius: 50px;
  transition: all 0.3s ease;
  font-size: 1.05rem;
}

.confirm-btn:hover {
  background: rgba(10, 17, 40, 0.9);
  color: var(--white);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(10, 17, 40, 0.3);
}

.action-btn { 
  background: var(--accent-gold);
  color: var(--primary-navy);
  border: 2px solid var(--accent-gold);
  padding: 8px 18px; 
  margin: 3px; 
  cursor: pointer; 
  font-weight: 600; 
  border-radius: 50px;
  transition: all 0.3s ease;
  font-size: 0.85rem;
}

.action-btn:hover {
  background: rgba(10, 17, 40, 0.9);
  color: var(--white);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(10, 17, 40, 0.2);
}

.message { 
  margin-top: 25px; 
  font-weight: 700; 
  color: var(--accent-gold);
  font-size: 1.1rem;
  padding: 15px;
  background: rgba(255, 183, 0, 0.1);
  border-radius: 12px;
  display: inline-block;
  min-width: 300px;
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(10, 17, 40, 0.7);
  backdrop-filter: blur(5px);
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: var(--white);
  padding: 30px;
  border-radius: 20px;
  width: 450px;
  max-width: 90%;
  text-align: left;
  box-shadow: 0 20px 60px rgba(10, 17, 40, 0.3);
  animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-content h3 {
  color: var(--primary-navy);
  margin-bottom: 20px;
  font-weight: 700;
  font-size: 1.5rem;
}

.modal-content label {
  display: block;
  margin-top: 15px;
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--primary-navy);
}

.modal-content input,
.modal-content textarea {
  width: 100%;
  padding: 12px 15px;
  margin-top: 6px;
  border-radius: 10px;
  border: 2px solid rgba(10, 17, 40, 0.1);
  font-family: 'Poppins', sans-serif;
  transition: border-color 0.3s ease;
}

.modal-content input:focus,
.modal-content textarea:focus {
  outline: none;
  border-color: var(--accent-gold);
}

.close-btn {
  background: #dc3545;
  color: var(--white);
  border: none;
  padding: 8px 16px;
  cursor: pointer;
  border-radius: 8px;
  float: right;
  font-weight: 600;
  transition: all 0.3s ease;
}

.close-btn:hover {
  background: #c82333;
  transform: scale(1.05);
}

.save-btn {
  background: var(--accent-gold);
  color: var(--primary-navy);
  border: 2px solid var(--accent-gold);
  padding: 12px 24px;
  border-radius: 50px;
  cursor: pointer;
  margin-top: 20px;
  font-weight: 700;
  width: 100%;
  transition: all 0.3s ease;
}

.save-btn:hover {
  background: rgba(10, 17, 40, 0.9);
  color: var(--white);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(10, 17, 40, 0.3);
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

<!-- Confirm Bookings Form -->
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
