@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - All Bookings</title>
<style>
body { font-family:'Segoe UI', sans-serif; background:#112240; color:white; margin:0; padding:0; }

.content-wrapper {
    width: 80%;
    margin-left: 270px;
    margin-top: 80px;
    padding: 20px;
    box-sizing: border-box;
}

.header-actions { display:flex; justify-content:flex-start; flex-wrap:wrap; margin-bottom:20px; gap:10px; }
.create-btn { background:white; color:black; border:none; padding:8px 16px; border-radius:5px; cursor:pointer; font-weight:bold; }
h2 { color:#FFB600; text-align:center; margin-bottom:20px; }

table { width:100%; border-collapse: collapse; margin-bottom:20px; }
th, td { padding:10px; text-align:center; border-bottom:1px solid #FFB600; }
th { color:#FFB600; }
.action-btn { background:#FFB600; color:black; border:none; padding:6px 12px; border-radius:5px; cursor:pointer; margin:2px; }

.modal { display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.7); }
.modal-content { background:#112240; margin:10% auto; padding:20px; border:1px solid #FFB600; width:60%; max-width:600px; border-radius:8px; color:white; }
.close { color:#FFB600; float:right; font-size:24px; font-weight:bold; cursor:pointer; }
.modal input, .modal textarea, .modal select { width:100%; padding:8px; margin:5px 0 15px 0; border-radius:5px; border:none; }
.modal button { background:#FFB600; color:black; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-weight:bold; }

.overflow-x-auto { overflow-x:auto; max-height:400px; }

@media (max-width: 1200px) {
    .content-wrapper { width: 90%; margin-left: 220px; margin-top:70px; }
    .modal-content { width: 70%; }
}
@media (max-width: 992px) {
    .content-wrapper { width: 95%; margin-left: 200px; margin-top:70px; }
    table { font-size: 14px; }
    .modal-content { width: 80%; }
}
@media (max-width: 768px) {
    .content-wrapper { width: 100%; margin-left: 0; padding:10px; margin-top:70px; }
    table { font-size: 13px; }
    .header-actions { justify-content:center; }
    .modal-content { width: 90%; margin-top:30%; }
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<div class="content-wrapper">

    <div class="header-actions">
        <button class="create-btn" id="openCreateModal">Create Service</button>
        <button class="create-btn" id="openViewModal">View All Services</button>
    </div>

    <h2>All Bookings</h2>

    @if($bookings->isEmpty())
        <p style="text-align:center;">No bookings yet.</p>
    @else
    <table>
        <tr>
            <th>Client Name</th>
            <th>Service Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach($bookings as $booking)
        <tr id="booking-{{ $booking->id }}">
            <td>{{ $booking->client->name }}</td>
            <td>{{ $booking->service->name }}</td>
            <td>{{ $booking->service->description }}</td>
            <td>{{ $booking->service->price }}</td>
            <td id="status-{{ $booking->id }}">{{ $booking->status }}</td>
            <td>
                @if($booking->status !== 'Confirmed')
                <button class="action-btn" onclick="confirmBooking({{ $booking->id }})">Confirm</button>
                @endif
                <button class="action-btn" onclick="editBooking({{ $booking->id }})">Edit</button>
                <button class="action-btn" onclick="deleteBooking({{ $booking->id }})">Delete</button>
            </td>
        </tr>
        @endforeach
    </table>
    @endif

</div> <!-- content-wrapper -->

<!-- Modal: Create Service -->
<div id="createModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeCreateModal">&times;</span>
    <h3 style="color:#FFB600;">Create New Service</h3>
    <form id="createServiceForm">
        @csrf
        <input type="text" name="name" placeholder="Service Name" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="duration" placeholder="Duration (e.g., 30min)">
        <input type="text" name="available_time" placeholder="Available Time (e.g., 9:00-17:00)">
        <select name="is_active">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        <input type="text" name="category" placeholder="Category">
        <button type="submit">Save Service</button>
    </form>
    <div id="serviceMessage" style="margin-top:10px; font-weight:bold; color:#FFB600;"></div>
  </div>
</div>

<!-- Modal: View Services -->
<div id="viewModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeViewModal">&times;</span>
    <h3 style="color:#FFB600;">All Available Services</h3>
    <div class="overflow-x-auto">
      <table id="servicesTable">
        <tr>
          <th>Name</th>
          <th>Duration</th>
          <th>Price</th>
        </tr>
        @foreach($services as $service)
        <tr>
          <td>{{ $service->name }}</td>
          <td>{{ $service->duration ?? '-' }}</td>
          <td>{{ $service->price ?? '-' }}</td>
        </tr>
        @endforeach
      </table>
      {{ $services->links() }}
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    // CSRF setup
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });

    // Open/Close modals
    $('#openCreateModal').click(()=>$('#createModal').show());
    $('#openViewModal').click(()=>$('#viewModal').show());
    $('#closeCreateModal').click(()=>$('#createModal').hide());
    $('#closeViewModal').click(()=>$('#viewModal').hide());
    $(window).click(function(e){
        if(e.target.id=='createModal') $('#createModal').hide();
        if(e.target.id=='viewModal') $('#viewModal').hide();
    });

    // Create Service via AJAX
    $('#createServiceForm').submit(function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: '{{ route("services.store") }}',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res){
                if(res.success){
                    $('#serviceMessage').text(res.message);
                    $('#createServiceForm')[0].reset();

                    // Add new service to the View modal table
                    let newRow = `<tr>
                        <td>${res.service.name}</td>
                        <td>${res.service.duration || '-'}</td>
                        <td>${res.service.price || '-'}</td>
                    </tr>`;
                    $('#servicesTable').append(newRow);
                } else {
                    $('#serviceMessage').text(res.message || 'Failed to create service.');
                }
            },
            error: function(xhr){
                console.log(xhr);
                let errors = xhr.responseJSON?.errors || {};
                let errorMsg = Object.values(errors).map(e=>e[0]).join(' ');
                $('#serviceMessage').text(errorMsg || xhr.responseJSON?.message || 'Something went wrong.');
            }
        });
    });

});

// Booking actions
function confirmBooking(id){
    if(!confirm('Confirm this booking?')) return;
    $.post('/admin/bookings/confirm/' + id, {_token:'{{ csrf_token() }}'}, function(res){
        if(res.success){ $('#status-' + id).text('Confirmed'); alert(res.message); }
        else { alert(res.message); }
    });
}
function deleteBooking(id){
    if(!confirm('Delete this booking?')) return;
    $.ajax({
        url:'/admin/bookings/delete/' + id,
        type:'DELETE',
        data:{_token:'{{ csrf_token() }}'},
        success:function(res){
            if(res.success){ $('#booking-' + id).remove(); alert(res.message); }
            else { alert(res.message); }
        }
    });
}
function editBooking(id){
    let newStatus = prompt('Enter new status (Pending, Confirmed, Cancelled):');
    if(!newStatus) return;
    $.post('/admin/bookings/edit/' + id, {_token:'{{ csrf_token() }}', status:newStatus}, function(res){
        if(res.success){ $('#status-' + id).text(newStatus); alert(res.message); }
        else { alert(res.message); }
    });
}
</script>

</body>
</html>

@include('layouts.footer')
