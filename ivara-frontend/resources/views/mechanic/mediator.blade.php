@include('layouts.header')
@include('layouts.sidebar')

<div class="mechanic-mediator-body">
    <h2>Nearby Mediators</h2>

    <!-- Location Search -->
    <form method="GET" action="{{ route('mechanic.mediator') }}" class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <label for="location" class="form-label">Select Location:</label>
        <select name="location" id="location" class="form-select" style="width:220px;">
            <option value="">-- Select a location --</option>
            @foreach($locations as $loc)
                <option value="{{ $loc }}" {{ (isset($location) && $location == $loc) ? 'selected' : '' }}>
                    {{ $loc }}
                </option>
            @endforeach
        </select>

        <label for="per_page" class="form-label">Rows per page:</label>
        <select name="per_page" id="per_page" class="form-select" style="width:80px;">
            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
        </select>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Mediators Table -->
    @if(isset($mediators) && $mediators->count() > 0)
    <div class="mediator-table table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Total Clients</th>
                    <th>Total Transactions</th>
                    <th>Level</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mediators as $mediator)
                <tr>
                    <td>{{ $mediator->id }}</td>
                    <td>{{ $mediator->fullname }}</td>
                    <td>{{ $mediator->email }}</td>
                    <td>{{ $mediator->phone }}</td>
                    <td>{{ $mediator->location }}</td>
                    <td>{{ $mediator->total_clients }}</td>
                    <td>{{ $mediator->total_transactions }}</td>
                    <td>{{ ucfirst($mediator->level) }}</td>
                    <td>{{ ucfirst($mediator->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-end">
            {{ $mediators->links() }}
        </div>
    </div>
    @elseif(isset($location))
        <p>No mediators found for the selected location.</p>
    @endif
</div>

<!-- Styles -->
<style>
.mechanic-mediator-body {
    width: 80%;
    margin-left: 240px;
    margin-top: 40px;
    font-family: 'Segoe UI', sans-serif;
}
.mechanic-mediator-body h2 {
    margin-bottom: 20px;
    color: #2c3e50;
}
form select, form input[type=text] {
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
}
.btn-primary {
    background: #3498db;
    color: #fff;
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.btn-primary:hover {
    background: #2980b9;
}
table.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
table.table th, table.table td {
    text-align: center;
    border: none;
    border-bottom: 1px solid #ddd;
    padding: 10px;
}
table.table th {
    background: #f4f6f8;
}
@media (max-width: 992px){
    .mechanic-mediator-body { width: 95%; margin: 20px auto; }
    table, thead, tbody, th, td, tr { display: block; }
    th { position: absolute; top: -9999px; left: -9999px; }
    td { position: relative; padding-left: 50%; margin-bottom: 10px; text-align: left; }
    td:before {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 45%;
        white-space: nowrap;
        font-weight: bold;
    }
    td:nth-of-type(1):before { content: "ID"; }
    td:nth-of-type(2):before { content: "Full Name"; }
    td:nth-of-type(3):before { content: "Email"; }
    td:nth-of-type(4):before { content: "Phone"; }
    td:nth-of-type(5):before { content: "Location"; }
    td:nth-of-type(6):before { content: "Total Clients"; }
    td:nth-of-type(7):before { content: "Total Transactions"; }
    td:nth-of-type(8):before { content: "Level"; }
    td:nth-of-type(9):before { content: "Status"; }
}
</style>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
