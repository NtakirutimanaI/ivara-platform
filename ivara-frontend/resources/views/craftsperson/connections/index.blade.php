@include('layouts.header')
@include('layouts.sidebar')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
    body { font-family:'Segoe UI', sans-serif; background:#f0f2f8; color:#333; }
    h2 { color:#4f46e5; text-align:center; margin-bottom:20px; }
    .profile-form-container {
        background:#fff; padding:20px; border-radius:12px;
        max-width:100%; margin-left:270px; margin-top:50px;
        box-shadow:0 6px 20px rgba(0,0,0,0.08);
    }
    table thead { background:#4f46e5; color:#fff; }
    table tbody tr:hover { background:#f9f9f9; }
    .btn-sm { padding:4px 10px; font-size:13px; }
    .pagination { justify-content:center; margin-top:20px; }

    @media(max-width: 991px){
        .profile-form-container { margin:100px auto; width:95%; }
        table { font-size: 13px; }
        .btn-sm { font-size:12px; padding:3px 8px; }
    }
    @media(max-width: 576px){
        h2 { font-size:18px; }
        table { font-size:12px; }
        .profile-form-container { padding:10px; }
    }
</style>

<div class="profile-form-container">
    <h2>Nearby Mediators</h2>

    <!-- Location Filter Form -->
    <form method="GET" action="{{ route('craftsperson.connections.index') }}" class="mb-4 d-flex gap-2 flex-wrap">
        <select name="location" class="form-select" style="max-width: 250px;">
            <option value="">Select Location</option>
            @foreach($locations as $loc)
                <option value="{{ $loc }}" @if(request('location') == $loc) selected @endif>{{ $loc }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Filter</button>
        <a href="{{ route('craftsperson.connections.index') }}" class="btn btn-secondary btn-sm">Reset</a>
    </form>

    <!-- Mediators Table -->
    @if(request()->filled('location'))
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
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
                    @forelse($mediators as $mediator)
                        <tr>
                            <td>{{ $mediator->id }}</td>
                            <td>{{ $mediator->fullname }}</td>
                            <td>{{ $mediator->email }}</td>
                            <td>{{ $mediator->phone }}</td>
                            <td>{{ $mediator->location }}</td>
                            <td>{{ $mediator->total_clients }}</td>
                            <td>{{ $mediator->total_transactions }}</td>
                            <td>{{ ucfirst($mediator->level) }}</td>
                            <td>
                                @if($mediator->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No mediators found in this location.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $mediators->withQueryString()->links() }}
        </div>
    @endif
</div>
