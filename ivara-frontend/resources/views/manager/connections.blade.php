@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<style>
  body { font-family: Arial, sans-serif; margin: 0; background: #f7f9fc; color: #333; }
  .container { width: 76%; margin-left: 260px; margin-top: 80px; background: #fff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 20px; }
  h2 { margin-bottom: 8px; }
  .subtitle { color: #924FC2; font-size: 14px; margin-bottom: 20px; }
  .table-responsive { overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; min-width: 600px; }
  th, td { padding: 12px; text-align: left; font-size: 14px; white-space: nowrap; }
  th { color: #555; font-weight: 600; }
  tr { border-bottom: 1px solid #eee; }
  .btn { background: #924FC2; color: #fff; padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer; }
  .avatar { width: 35px; height: 35px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: bold; margin-right: 10px; }
</style>

<div class="container">
  <h2>All Mediator Activities</h2>
  <p class="subtitle">Overview of all mediators and their client transactions</p>

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
        @forelse ($connections as $activity)
        <tr>
          <td>
            <span class="avatar" style="background:#6c5ce7;">
              {{ strtoupper(substr($activity->mediator->name,0,2)) }}
            </span>
            {{ $activity->mediator->name }} <br>
            <small>{{ $activity->mediator->email }}</small>
          </td>
          <td>{{ $activity->client->name ?? '-' }}</td>
          <td>{{ $activity->service_name ?? '-' }}</td>
          <td>${{ number_format($activity->payment_amount,2) }}</td>
          <td>{{ $activity->commission_percentage }}%</td>
          <td>${{ number_format($activity->commission_amount,2) }}</td>
          <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center; padding: 1rem; color: #6b7280;">
            No activities found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $connections->links() }}
</div>

@include('layouts.footer')
