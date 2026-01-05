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
  body { 
    font-family: 'Segoe UI', sans-serif; 
    background: #ffffff; 
    color: black; 
    margin-top: 100px; 
  }
  .container {
    width: 80%;
    margin-left: 240px;
  }
  h2 {
    color: #FFB600; 
    text-align: center; 
    margin-bottom: 20px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
  }
  table th {
    background: #112240;
    color: #FFB600;
  }
  table tr:nth-child(even) {
    background: #f9f9f9;
  }
  table tr:hover {
    background: #f1f1f1;
  }
  .status-pending { color: #FFA500; font-weight: bold; }
  .status-in_progress { color: #007bff; font-weight: bold; }
  .status-completed { color: #28a745; font-weight: bold; }
  .status-cancelled { color: #dc3545; font-weight: bold; }
  .btn-back {
    display: inline-block;
    background: #112240;
    color: #FFB600;
    padding: 10px 20px;
    font-weight: bold;
    border-radius: 8px;
    text-decoration: none;
    margin-top: 20px;
  }
  .btn-back:hover {
    background: #000000;
    color: #FFB600;
  }
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

<table>
    <thead>
        <tr>
            <th>Service</th>
            <th>Assigned To</th>
            <th>Scheduled At</th>
            <th>Status</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $b)
        <tr>
            <td>{{ $b->service_type }}</td>
            <td>{{ $b->assignedUser->name ?? '—' }}</td>
            <td>{{ \Carbon\Carbon::parse($b->scheduled_at)->format('d M Y, H:i') }}</td>
            <td class="status-{{ $b->status }}">{{ ucfirst($b->status) }}</td>
            <td>{{ $b->notes ?? '—' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center;">No bookings found</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div style="text-align:center;">
  <a href="{{ route('client.bookings') }}" class="btn-back">Back to Booking Form</a>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
</html>

@include('layouts.footer')
