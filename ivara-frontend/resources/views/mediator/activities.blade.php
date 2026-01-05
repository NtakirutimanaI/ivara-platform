@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Activities</title>
<style>
  body { font-family: Arial, sans-serif; margin: 0; background: #f7f9fc; color: #333; }
  .container { width: 80%; margin-left: 250px; margin-top: 20px; background: #fff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; }
  h2 { margin-bottom: 8px; }
  .subtitle { color: #00b894; font-size: 14px; margin-bottom: 20px; }
  .table-responsive { overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; min-width: 600px; }
  th, td { padding: 12px; text-align: left; font-size: 14px; white-space: nowrap; }
  th { color: #555; font-weight: 600; }
  tr { border-bottom: 1px solid #eee; }
  .avatar { width: 35px; height: 35px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: bold; margin-right: 10px; background:#6c5ce7; }
</style>
</head>
<body>
<div class="container">
  <h2>My Activities</h2>
  <p class="subtitle">Track clients you brought, commissions earned, and payments received</p>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>Mediator</th>
          <th>Client</th>
          <th>Service/Product</th>
          <th>Payment</th>
          <th>Commission %</th>
          <th>Commission Earned</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($connections as $connection)
        <tr>
          <td>
            <span class="avatar">{{ strtoupper(substr($connection->mediator->name ?? '-',0,2)) }}</span>
            {{ $connection->mediator->name ?? '-' }} <br><small>{{ $connection->mediator->email ?? '-' }}</small>
          </td>
          <td>{{ $connection->client->name ?? '-' }}</td>
          <td>{{ $connection->service_name ?? '-' }}</td>
          <td>${{ number_format($connection->payment_amount ?? 0, 2) }}</td>
          <td>{{ $connection->commission_percentage ?? 0 }}%</td>
          <td>${{ number_format($connection->commission_amount ?? 0, 2) }}</td>
          <td>{{ $connection->created_at->format('Y-m-d H:i') ?? '-' }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center; padding: 1rem; color: #6b7280;">No connections found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $connections->links() }}
</div>
</body>
</html>
