@extends('layouts.app')

@section('title', 'My Schedule')

@section('content')
<div class="technician-page-container">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-primary">Availability & Schedule</h1>
                <p class="text-muted">Manage your working hours and dispatch availability.</p>
            </div>
            <div class="d-flex gap-2">
                <div class="form-check form-switch bg-white rounded-pill p-2 px-4 shadow-sm">
                    <input class="form-check-input" type="checkbox" id="dispatchActive" checked>
                    <label class="form-check-label fw-bold ms-2" for="dispatchActive">Accepting New Jobs</label>
                </div>
                <button class="btn btn-primary rounded-pill px-4"><i class="fas fa-save me-2"></i> Update Hours</button>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <div class="glass-card p-4 h-100">
                    <h5 class="fw-bold mb-4">Weekly Time Blocking</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered border-light align-middle">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th>Time</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(['08:00', '10:00', '12:00', '14:00', '16:00', '18:00'] as $time)
                                <tr class="text-center">
                                    <td class="small fw-bold">{{ $time }}</td>
                                    @for($i=0; $i<6; $i++)
                                    <td class="p-1">
                                        @if(rand(0,3) > 1)
                                        <div class="schedule-block available rounded-3 py-2 small">Available</div>
                                        @else
                                        <div class="schedule-block busy rounded-3 py-2 small">Busy</div>
                                        @endif
                                    </td>
                                    @endfor
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="glass-card p-4">
                    <h5 class="fw-bold mb-3">Holiday & Day Off</h5>
                    <div class="calendar-mini p-3 bg-light rounded-4 mb-4">
                        <div class="text-center fw-bold mb-2">DECEMBER 2025</div>
                        <div class="row g-2 text-center small text-muted">
                            @for($i=1; $i<=31; $i++)
                            <div class="col-1-7 p-1 border rounded @if($i==25 || $i==27) bg-primary text-white @endif">{{ $i }}</div>
                            @endfor
                        </div>
                    </div>
                    <div class="alert alert-info border-0 rounded-4">
                        <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i> Note</h6>
                        <p class="small mb-0">You have set 25th Dec (Christmas) and 27th Dec (Maintenance Day) as unavailable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .technician-page-container { width: 96%; margin-left: 15px; }
    .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .schedule-block { font-weight: bold; text-transform: uppercase; font-size: 0.65rem; letter-spacing: 0.5px; }
    .schedule-block.available { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px dashed #10b981; }
    .schedule-block.busy { background: rgba(239, 68, 68, 0.05); color: #ef4444; opacity: 0.5; }
    .col-1-7 { width: calc(100% / 7); }
</style>
@endsection
