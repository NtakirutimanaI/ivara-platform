<!DOCTYPE html>
<html>
<head>
    <title>Manager Bookings PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Manager Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Price</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->client->name ?? 'N/A' }}</td>
                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                <td>{{ $booking->preferred_date }}</td>
                <td>{{ $booking->status }}</td>
                <td>{{ $booking->notes }}</td>
                <td>{{ $booking->price }}</td>
                <td>{{ $booking->duration }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
