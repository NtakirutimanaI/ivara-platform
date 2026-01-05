@include('layouts.header')
@include('layouts.sidebar')
@include('craftsperson.connect')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
    body { font-family:'Segoe UI', sans-serif; background:#f0f2f8; color:#333; }
    h2 { color:#4f46e5; text-align:center; margin-bottom:20px; }
    .profile-form-container {
        background:#fff; padding:20px; border-radius:12px;
        max-width:78%; margin-left:270px; margin-top:100px;
        box-shadow:0 6px 20px rgba(0,0,0,0.08);
    }
    table thead { background:#4f46e5; color:#fff; }
    table tbody tr:hover { background:#f9f9f9; }
    .btn-sm { padding:4px 10px; font-size:13px; }
    .pagination { justify-content:center; margin-top:20px; }

    /* Responsive */
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
    <h2><i class="fa-solid fa-handshake"></i> My Meetings</h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($meetings as $index => $meeting)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td><i class="fa-regular fa-clock text-primary"></i> {{ $meeting->time }}</td>
                        <td>{{ $meeting->description ?? 'No description' }}</td>
                        <td>
                            <a href="{{ $meeting->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-video"></i> Join
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-success">{{ $meeting->status }}</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewMeeting{{ $meeting->id }}">
                                <i class="fa-solid fa-eye"></i> View
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewMeeting{{ $meeting->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="fa-solid fa-info-circle"></i> Meeting Details</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Time:</strong> {{ $meeting->time }}</p>
                                    <p><strong>Description:</strong> {{ $meeting->description ?? 'No description available' }}</p>
                                    <p><strong>Status:</strong> {{ $meeting->status }}</p>
                                    <p><strong>Meeting Link:</strong> 
                                        <a href="{{ $meeting->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-video"></i> Join Now
                                        </a>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No meetings available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div>
        {{ $meetings->links('pagination::bootstrap-5') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')