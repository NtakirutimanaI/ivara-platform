<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bookings PDF</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #112240; color: #FFB600; }
        h2 { text-align: center; color: #112240; }
    </style>
</head>
<body>
    <h2>All Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Service</th>
                <th>Price (RWF)</th>
                <th>Status</th>
                <th>Technician</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->client->name ?? 'N/A' }}</td>
                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                <td>{{ $booking->service->price ?? 0 }}</td>
                <td>{{ $booking->status }}</td>
                <td>{{ $booking->technician->name ?? '-' }}</td>
                <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
