@include('layouts.header')
@include('layouts.sidebar')
@include('business.connect')

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
    <h2>Published Meetings</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Link</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Roles</th>
                    <th>Created At</th>
                 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->id }}</td>
                        <td>{{ $meeting->time }}</td>
                        <td>
                            <a href="{{ $meeting->link }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fa fa-link"></i> Join
                            </a>
                        </td>
                        <td>{{ $meeting->description ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-success">{{ $meeting->status }}</span>
                        </td>
                        <td>
                            @if(is_array($meeting->roles))
                                {{ implode(', ', $meeting->roles) }}
                            @elseif($meeting->roles)
                                {{ $meeting->roles }}
                            @else
                                All
                            @endif
                        </td>
                        <td>{{ $meeting->created_at->format('Y-m-d H:i') }}</td>

                        <td>
                            <!-- View Modal Trigger -->
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewMeetingModal{{ $meeting->id }}">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewMeetingModal{{ $meeting->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="fa-solid fa-info-circle"></i> Meeting Details</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><b>Time:</b> {{ $meeting->time }}</p>
                                    <p><b>Link:</b> 
                                        <a href="{{ $meeting->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-video"></i> Join Now
                                        </a>
                                    </p>
                                    <p><b>Description:</b> {{ $meeting->description ?? 'N/A' }}</p>
                                    <p><b>Status:</b> {{ $meeting->status }}</p>
                                    <p><b>Roles:</b>
                                        @if(is_array($meeting->roles))
                                            {{ implode(', ', $meeting->roles) }}
                                        @elseif($meeting->roles)
                                            {{ $meeting->roles }}
                                        @else
                                            All
                                        @endif
                                    </p>
                                    <p><b>Created At:</b> {{ $meeting->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{ $meeting->link }}" target="_blank" class="btn btn-primary">Join Meeting</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No published meetings available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $meetings->links('pagination::bootstrap-5') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')
