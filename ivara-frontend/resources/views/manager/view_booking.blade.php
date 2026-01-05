@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager - Bookings</title>
  {!! csrf_field() !!}
  <style>
    body { font-family:'Segoe UI', sans-serif; background:#112240; color:white; margin:0; padding:0; }
    .content-wrapper { width: 80%; margin-left: 240px; margin-top: 80px; padding: 20px; box-sizing: border-box; }
    h1,h2 { color:#FFB600; text-align:center; margin-bottom:20px; }
    .header-actions { display:flex; justify-content:flex-start; flex-wrap:wrap; margin-bottom:20px; gap:10px; }
    .create-btn, .action-btn { border:none; padding:8px 16px; border-radius:5px; cursor:pointer; font-weight:bold; }
    .create-btn { background:white; color:black; }
    .action-btn { background:#FFB600; color:black; margin:2px; }
    table { width:100%; border-collapse: collapse; margin-bottom:20px; }
    th, td { padding:10px; text-align:center; border-bottom:1px solid #FFB600; word-wrap:break-word; }
    th { color:#FFB600; background:#112240; }
    .overflow-x-auto { overflow-x:auto; }
    .modal { display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.7); }
    .modal-content { background:#112240; margin:5% auto; padding:20px; border:1px solid #FFB600; width:50%; max-width:600px; border-radius:8px; color:white; position:relative; }
    .close { color:#FFB600; float:right; font-size:24px; font-weight:bold; cursor:pointer; }
    .modal input, .modal textarea, .modal select { width:100%; padding:8px; margin:5px 0 15px 0; border-radius:5px; border:none; }
    .modal input::placeholder, .modal textarea::placeholder { color:#999; font-style:italic; }
    .modal button { background:#FFB600; color:black; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-weight:bold; }
    @media (max-width: 768px) { .content-wrapper { width:100%; margin-left:0; padding:10px; margin-top:70px; } .modal-content { width:90%; margin-top:30%; } }
  </style>
</head>
<body>
  <div class="content-wrapper">
    <h1>Bookings Management</h1>

    <div class="header-actions">
      <button class="create-btn" onclick="openModal('createServiceModal')">+ Add Service</button>
      <button class="create-btn" onclick="openModal('viewServiceModal')">+ View All Services</button>
    </div>

    <div class="overflow-x-auto">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Service</th>
            <th>Preferred Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $booking)
          <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->client->name ?? 'N/A' }}</td>
            <td>{{ $booking->service->name ?? 'N/A' }}</td>
            <td>{{ $booking->preferred_date ?? '-' }}</td>
            <td>{{ $booking->status ?? '-' }}</td>
            <td>{{ $booking->notes ?? '-' }}</td>
            <td>{{ $booking->price ?? '-' }}</td>
            <td>{{ $booking->duration ?? '-' }}</td>
            <td>
              <button class="action-btn" onclick="openModal('viewBookingModal{{ $booking->id }}')">View</button>
              <button class="action-btn" onclick="openModal('editBookingModal{{ $booking->id }}')">Edit</button>
              <button class="action-btn" onclick="openModal('assignBookingModal{{ $booking->id }}')">Assign</button>
              <button class="action-btn" onclick="openModal('deleteBookingModal{{ $booking->id }}')">Delete</button>
            </td>
          </tr>

          <!-- Assign Modal -->
          <div id="assignBookingModal{{ $booking->id }}" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeModal('assignBookingModal{{ $booking->id }}')">&times;</span>
              <h2>Assign Booking #{{ $booking->id }}</h2>
              <form action="{{ route('manager.assign_booking') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <label>Select Technician</label>
                <select name="technician_id" required>
                  <option value="">-- Choose Technician --</option>
                  @foreach($technicians as $tech)
                    <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                  @endforeach
                </select>
                <button type="submit">Assign</button>
              </form>
            </div>
          </div>

          <!-- View Modal -->
          <div id="viewBookingModal{{ $booking->id }}" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeModal('viewBookingModal{{ $booking->id }}')">&times;</span>
              <h2>Booking Details</h2>
              <p><strong>Client:</strong> {{ $booking->client->name ?? 'N/A' }}</p>
              <p><strong>Service:</strong> {{ $booking->service->name ?? 'N/A' }}</p>
              <p><strong>Preferred Date:</strong> {{ $booking->preferred_date ?? '-' }}</p>
              <p><strong>Status:</strong> {{ $booking->status ?? '-' }}</p>
              <p><strong>Notes:</strong> {{ $booking->notes ?? '-' }}</p>
              <p><strong>Price:</strong> {{ $booking->price ?? '-' }}</p>
              <p><strong>Duration:</strong> {{ $booking->duration ?? '-' }}</p>
            </div>
          </div>

          <!-- Edit Modal -->
          <div id="editBookingModal{{ $booking->id }}" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeModal('editBookingModal{{ $booking->id }}')">&times;</span>
              <h2>Edit Booking</h2>
              <form action="{{ route('manager.update_booking', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label>Preferred Date</label>
                <input type="date" name="preferred_date" value="{{ $booking->preferred_date ?? '' }}" placeholder="Select preferred date">
                <label>Status</label>
                <select name="status">
                  <option value="Pending" {{ ($booking->status ?? '')=='Pending'?'selected':'' }}>Pending</option>
                  <option value="Confirmed" {{ ($booking->status ?? '')=='Confirmed'?'selected':'' }}>Confirmed</option>
                  <option value="Cancelled" {{ ($booking->status ?? '')=='Cancelled'?'selected':'' }}>Cancelled</option>
                </select>
                <label>Notes</label>
                <textarea name="notes" placeholder="Enter booking notes">{{ $booking->notes ?? '' }}</textarea>
                <label>Price</label>
                <input type="number" step="0.01" name="price" value="{{ $booking->price ?? '' }}" placeholder="Enter price">
                <label>Duration</label>
                <input type="text" name="duration" value="{{ $booking->duration ?? '' }}" placeholder="Enter duration (e.g., 2 hours)">
                <button type="submit">Update</button>
              </form>
            </div>
          </div>

          <!-- Delete Modal -->
          <div id="deleteBookingModal{{ $booking->id }}" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeModal('deleteBookingModal{{ $booking->id }}')">&times;</span>
              <h2>Delete Booking</h2>
              <p>Are you sure you want to delete booking #{{ $booking->id }}?</p>
              <form action="{{ route('manager.delete_booking', $booking->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Yes, Delete</button>
              </form>
            </div>
          </div>

          @endforeach
        </tbody>
      </table>
      {{ $bookings->links() }}
    </div>
  </div>

  <!-- Create Service Modal -->
  <div id="createServiceModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('createServiceModal')">&times;</span>
      <h2>New Service</h2>
      <form action="{{ route('manager.store_service') }}" method="POST">
        @csrf
        <label>Name</label>
        <input type="text" name="name" placeholder="Enter service name" required>
        <label>Description</label>
        <textarea name="description" placeholder="Enter service description"></textarea>
        <label>Price</label>
        <input type="number" step="0.01" name="price" placeholder="Enter service price">
        <label>Duration</label>
        <input type="text" name="duration" placeholder="Enter duration (e.g., 1 hour)">
        <label>Available Time</label>
        <input type="text" name="available_time" placeholder="e.g., 9AM - 5PM">
        <label>Status</label>
        <select name="is_active">
          <option value="1" selected>Active</option>
          <option value="0">Inactive</option>
        </select>
        <label>Category</label>
        <input type="text" name="category" placeholder="Enter service category">
        <label>Created By</label>
        <select name="created_by">
          @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
        <button type="submit">Save Service</button>
      </form>
    </div>
  </div>

  <!-- View Services Modal -->
  <div id="viewServiceModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('viewServiceModal')">&times;</span>
      <h2>All Services</h2>
      <table>
        <thead>
          <tr><th>Name</th><th>Duration</th><th>Price</th></tr>
        </thead>
        <tbody>
          @foreach($services as $service)
          <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->duration ?? '-' }}</td>
            <td>{{ $service->price ?? '-' }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function openModal(id) { document.getElementById(id).style.display = 'block'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    window.onclick = function(e) {
      document.querySelectorAll('.modal').forEach(m => { if (e.target == m) m.style.display="none"; });
    }
  </script>
</body>
</html>
