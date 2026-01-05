<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Subscriptions</title>
    <style>
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #333; padding:5px; text-align:center; }
        th { background:#924FC2; color:white; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Subscriptions / Upgrades</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Plan</th>
                <th>Price</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $index => $sub)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $sub->user->name ?? '-' }}</td>
                <td>{{ $sub->email }}</td>
                <td>{{ $sub->plan }}</td>
                <td>${{ $sub->price }}</td>
                <td>{{ ucfirst($sub->status) }}</td>
                <td>{{ $sub->start_date }}</td>
                <td>{{ $sub->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
