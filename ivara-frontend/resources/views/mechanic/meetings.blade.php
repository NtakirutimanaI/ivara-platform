@include('layouts.header')
@include('layouts.sidebar')

<div class="mechanic-meetings-body">
    <h2>Published Meetings</h2>

    @if($meetings->isEmpty())
        <p class="no-meetings">No published meetings available.</p>
    @else
        <div class="meeting-list">
            @foreach($meetings as $meeting)
                @php
                    // Ensure roles is an array
                    $roles = is_string($meeting->roles) ? json_decode($meeting->roles, true) : $meeting->roles;
                @endphp
                <div class="meeting-card">
                    <div class="meeting-time">
                        <strong>Time:</strong> {{ $meeting->time }}
                    </div>
                    <div class="meeting-description">
                        {{ $meeting->description ?? 'No description provided.' }}
                    </div>
                    <div class="meeting-link">
                        <a href="{{ $meeting->link }}" target="_blank">Join Meeting</a>
                    </div>
                    <div class="meeting-roles">
                        <small>Visible to: {{ is_array($roles) ? implode(', ', $roles) : $roles }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.mechanic-meetings-body {
    width: 80%;
    margin-left: 240px;
    margin-top: 40px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.mechanic-meetings-body h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #2c3e50;
}

.no-meetings {
    padding: 15px;
    background: #f8d7da;
    color: #721c24;
    border-radius: 8px;
}

.meeting-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.meeting-card {
    background: #fff;
    border: 1px solid #e0e0e0;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.meeting-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.meeting-time {
    font-size: 16px;
    margin-bottom: 8px;
    color: #34495e;
}

.meeting-description {
    font-size: 14px;
    margin-bottom: 12px;
    color: #555;
}

.meeting-link a {
    display: inline-block;
    padding: 8px 12px;
    background: #3498db;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.2s ease;
}

.meeting-link a:hover {
    background: #2980b9;
}

.meeting-roles {
    margin-top: 10px;
    font-size: 12px;
    color: #888;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .mechanic-meetings-body {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
    }
}
</style>

@include('layouts.footer')
