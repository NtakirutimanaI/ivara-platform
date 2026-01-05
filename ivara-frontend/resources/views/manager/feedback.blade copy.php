@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f9fafb;
        color: #333;
        overflow-x: hidden;
    }

    .container {
        width: 80%;
        margin-left: 240px;
        margin-top: 60px;
        padding: 20px;
        box-sizing: border-box;
    }

    h2 {
        color: #924FC2;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .filter-form,
    .table-wrapper,
    .dashboard-widget {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 25px;
    }

    .filter-form .form-group {
        margin-bottom: 15px;
    }

    .form-select,
    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    button,
    .btn {
        background-color: #924FC2;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn:hover {
        background-color: #3730a3;
    }

    .btn-sm {
        padding: 8px 12px;
        font-size: 13px;
    }

    .alert-success {
        background-color: #dcfce7;
        border: 1px solid #bbf7d0;
        padding: 10px 15px;
        border-radius: 5px;
        color: #166534;
        margin-bottom: 15px;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 60px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
        vertical-align: top;
    }

    thead {
        background-color: #f1f5f9;
    }

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
        color: white;
    }

    .bg-low { background-color: #84cc16; }
    .bg-normal { background-color: #3b82f6; }
    .bg-high { background-color: #f59e0b; }
    .bg-critical { background-color: #ef4444; }

    .table-responsive {
        overflow-x: auto;
    }

    .export-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .file-link {
        display: block;
        margin-top: 5px;
        font-size: 13px;
    }

    @media (max-width: 900px) {
        .container {
            width: 100%;
            margin-left: 0;
            padding: 15px;
        }

        .export-buttons {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

<div class="container">
    <h2>Feedback Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Dashboard Widget -->
    <div class="dashboard-widget">
        <h4>Recent Feedback</h4>
        <ul>
            @foreach($recentFeedbacks ?? [] as $recent)
                <li>{{ Str::limit($recent->message, 50) }} - <strong>{{ $recent->user_type }}</strong></li>
            @endforeach
        </ul>
    </div>

    <!-- Filter Form -->
    <div class="filter-form">
        <form class="row g-3" method="GET" action="{{ route('manager.feedback.index') }}" enctype="multipart/form-data">
            <div class="col-md-3 form-group">
                <input type="text" class="form-control" name="search" placeholder="Search message..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2 form-group">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <option value="Bug Report" @if(request('category')=='Bug Report') selected @endif>Bug Report</option>
                    <option value="Suggestion" @if(request('category')=='Suggestion') selected @endif>Suggestion</option>
                    <option value="Appreciation" @if(request('category')=='Appreciation') selected @endif>Appreciation</option>
                    <option value="Complaint" @if(request('category')=='Complaint') selected @endif>Complaint</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="user_type" class="form-select">
                    <option value="">All Users</option>
                        <option value="Manager" @if(request('user_type')=='Manager') selected @endif>Manager</option>
                        <option value="Supervisor" @if(request('user_type')=='Supervisor') selected @endif>Supervisor</option>
                        <option value="Business Person" @if(request('user_type')=='Business Person') selected @endif>Business Person</option>
                        <option value="Crafts Person" @if(request('user_type')=='Crafts Person') selected @endif>Crafts Person</option>
                        <option value="Mechanic" @if(request('user_type')=='Mechanic') selected @endif>Mechanic</option>
                        <option value="Technician" @if(request('user_type')=='Technician') selected @endif>Technician</option>
                        <option value="Mediator" @if(request('user_type')=='Mediator') selected @endif>Mediator</option>
                        <option value="Client" @if(request('user_type')=='Client') selected @endif>Client</option>
                        <option value="Tailor" @if(request('user_type')=='Tailor') selected @endif>Tailor</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <select name="urgency" class="form-select">
                    <option value="">All Urgency</option>
                    <option @if(request('urgency')=='Low') selected @endif>Low</option>
                    <option @if(request('urgency')=='Normal') selected @endif>Normal</option>
                    <option @if(request('urgency')=='High') selected @endif>High</option>
                    <option @if(request('urgency')=='Critical') selected @endif>Critical</option>
                </select>
            </div>
            <div class="col-md-1 form-group">
                <button class="btn w-100"><i class="fa fa-filter"></i></button>
            </div>
            <div class="col-md-2 export-buttons">
                <a href="{{ route('manager.feedback.export', ['type' => 'excel']) }}" class="btn btn-sm btn-success"><i class="fa fa-file-excel"></i> Excel</a>
                <a href="{{ route('manager.feedback.export', ['type' => 'pdf']) }}" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i> PDF</a>
                @if($feedbacks->count() > 0)
                    <a href="{{ route('manager.feedback.print', $feedbacks->first()->id) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Print</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Feedback Table -->
    <div class="table-wrapper">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Category</th>
                        <th>Urgency</th>
                        <th>Module</th>
                        <th>Message</th>
                        <th>Attachment</th>
                        <th>Reply</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                        <tr>
                            <td>
                                <strong>{{ $feedback->user_type }}</strong><br>
                                @if($feedback->name)
                                    <small>{{ $feedback->name }}<br>{{ $feedback->email }}</small>
                                @endif
                            </td>
                            <td>{{ $feedback->category }}</td>
                            <td>
                                <span class="badge bg-{{ strtolower($feedback->urgency) }}">
                                    {{ $feedback->urgency }}
                                </span>
                            </td>
                            <td>{{ $feedback->module }}</td>
                            <td>{{ Str::limit($feedback->message, 120) }}</td>
                            <td>
                                @if($feedback->file_path)
                                    <a href="{{ asset('storage/'.$feedback->file_path) }}" class="file-link" target="_blank">View / Download</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('manager.feedback.reply', $feedback->id) }}">
                                    @csrf
                                    <textarea name="reply" class="form-control mb-2" placeholder="Write reply..." rows="2">{{ old('reply') }}</textarea>
                                    <button class="btn btn-sm w-100">Send</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No feedback found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $feedbacks->withQueryString()->links() }}
        </div>
    </div>
</div>

@include('layouts.footer')
