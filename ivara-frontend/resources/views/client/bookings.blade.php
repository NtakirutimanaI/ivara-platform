@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Bookings History</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #ffffff; color: black; margin: 0; padding-top: 80px; }
  .container { width: 80%; margin-left: 240px; max-width: 1200px; padding: 0 15px; }
  h2 { color: black; text-align: center; margin-bottom: 20px; font-size: 1.8rem; }
  .summary-bar { margin-bottom: 15px; font-weight: bold; }
  .filter-bar { display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 15px; }
  .filter-bar input, .filter-bar select { padding: 6px 10px; margin: 5px 0; border-radius: 5px; border: 1px solid #ccc; }
  .table-wrapper { overflow-x: auto; width: 100%; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; table-layout: auto; }
  table th, table td { padding: 12px 10px; text-align: left; border-bottom: 1px solid #ddd; white-space: nowrap; }
  table th { background: #4f46e5; color: white; font-weight: bold; }
  table tr:nth-child(even) { background: #f9f9f9; }
  table tr:hover { background: #f1f1f1; }
  .status-Pending { color: #FFA500; font-weight: bold; }
  .status-Confirmed { color: #007bff; font-weight: bold; }
  .status-Cancelled { color: #dc3545; font-weight: bold; }
  .btn-back, .btn-action { display: inline-block; background: #4f46e5; color: white; padding: 8px 16px; font-weight: bold; border-radius: 8px; text-decoration: none; margin: 2px; transition: all 0.3s ease; }
  .btn-back:hover, .btn-action:hover { background: #000000; color: #FFB600; }
  .modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); padding-top: 60px; }
  .modal-content { background-color: #fff; margin: 5% auto; padding: 20px; width: 90%; max-width: 600px; border-radius: 8px; }
  .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
  .close:hover { color: black; }
  @media (max-width: 1024px) { .container { width: 90%; margin-top: 40px; margin-left: 5px; } }
  @media (max-width: 768px) { .container { width: 95%; margin-top: 40px; margin-left: 5px; } table th, table td { padding: 8px 6px; font-size: 0.9rem; } h2 { font-size: 1.5rem; } }
  @media (max-width: 480px) { .container { margin-left: 0; } .table-wrapper { overflow-x: auto; } table th, table td { padding: 6px 4px; font-size: 0.85rem; } h2 { font-size: 1.3rem; } }
</style>
</head>
<body>

<div class="container">

<h2>My Bookings History</h2>

@if(session('success'))
    <div style="color: green; font-weight: bold; margin-bottom:10px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div style="color: red; font-weight: bold; margin-bottom:10px;">{{ session('error') }}</div>
@endif

<!-- Summary -->
<div class="summary-bar">
  Total Bookings: {{ $bookings->total() }} | 
  Pending: {{ $bookings->where('status', 'Pending')->count() }} | 
  Confirmed: {{ $bookings->where('status', 'Confirmed')->count() }} | 
  Cancelled: {{ $bookings->where('status', 'Cancelled')->count() }}
</div>

<!-- Filter & Search -->
<div class="filter-bar">
    <form method="GET" action="{{ route('client.bookings.history') }}">
        <select name="status">
            <option value="">All Statuses</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <input type="date" name="from_date" value="{{ request('from_date') }}">
        <input type="date" name="to_date" value="{{ request('to_date') }}">
        <input type="text" name="search" placeholder="Search Service/Technician" value="{{ request('search') }}">
        <button type="submit" class="btn-action">Filter</button>
    </form>
</div>

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>Service</th>
            <th>Technician</th>
            <th>Preferred Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $b)
        <tr>
            <td>{{ $b->service->name ?? '—' }}</td>
            <td>{{ $b->assigned_name ?? '—' }}</td>
            <td>{{ \Carbon\Carbon::parse($b->preferred_date)->format('d M Y') }}</td>
            <td class="status-{{ $b->status }}">{{ $b->status }}</td>
            <td>{{ $b->notes ?? '—' }}</td>
            <td>{{ $b->price ?? '—' }}</td>
            <td>{{ $b->duration ?? '—' }}</td>
            <td>
                <a href="#" class="btn-action view-details" data-id="{{ $b->id }}">View</a>
                @if($b->status == 'Confirmed')
                    <a href="{{ route('client.bookings.reschedule', $b->id) }}" class="btn-action">Reschedule</a>
                    <a href="{{ route('client.bookings.cancel', $b->id) }}" class="btn-action">Cancel</a>
                @endif
                @if($b->status == 'Cancelled')
                    <span class="btn-action" style="background:#6c757d;">Cancelled</span>
                @endif
                @if($b->status == 'Completed')
                    <a href="{{ route('client.bookings.feedback', $b->id) }}" class="btn-action">Feedback</a>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center;">No bookings found</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

<div style="text-align:center; margin-top:15px;">
  {{ $bookings->links() }}
  <a href="{{ route('web.bookings') }}" class="btn-back">Back to Booking Form</a>
</div>

<!-- Booking Details Modal -->
<div id="detailsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modal-body">
            Loading details...
        </div>
    </div>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Open modal and load booking details
    $('.view-details').click(function(e){
        e.preventDefault();
        var bookingId = $(this).data('id');
        $('#modal-body').html('Loading details...');
        $('#detailsModal').show();

        $.ajax({
            url: '/client/bookings/' + bookingId,
            type: 'GET',
            success: function(data){
                $('#modal-body').html(data);
            },
            error: function(){
                $('#modal-body').html('Failed to load booking details.');
            }
        });
    });

    // Close modal
    $('.close').click(function(){ $('#detailsModal').hide(); });
    $(window).click(function(e){ if($(e.target).is('#detailsModal')){ $('#detailsModal').hide(); } });
});
</script>

</body>
</html>

@include('layouts.footer')
