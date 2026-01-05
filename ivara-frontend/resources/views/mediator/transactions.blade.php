
<div class="container mt-4" style="width:80%; margin-left:240px;">
    <h2>Your Transactions</h2>

    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Job Type</th>
                <th>Amount</th>
                <th>Approved</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $tr)
            <tr>
                <td>{{ $tr->id }}</td>
                <td>{{ $tr->client->name }}</td>
                <td>{{ ucfirst($tr->job_type) }}</td>
                <td>{{ $tr->amount }}</td>
                <td>{{ $tr->approved_by_admin ? 'Yes' : 'Pending' }}</td>
                <td>{{ $tr->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
