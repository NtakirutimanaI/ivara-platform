@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Bookings</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #112240;
      color: white;
    }
    table {
      width: 80%;
      margin: 30px auto;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #FFB600;
      padding: 10px;
      text-align: center;
    }
    th {
      background: #FFB600;
      color: black;
    }
    td {
      background: #1c2a48;
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;color:#FFB600;">My Bookings</h2>
  @if($bookings->isEmpty())
    <p style="text-align:center;color:#FFB600;">You have no bookings yet.</p>
  @else
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Service Name</th>
          <th>Description</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bookings as $index => $booking)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $booking->service->name ?? 'N/A' }}</td>
            <td>{{ $booking->service->description ?? 'N/A' }}</td>
            <td>{{ $booking->service->price ?? 'N/A' }} RWF</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</body>
</html>


