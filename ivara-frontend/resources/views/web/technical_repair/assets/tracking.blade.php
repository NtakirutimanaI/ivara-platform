@extends('layouts.app')

@section('title', 'Device Tracking System')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <!-- Search & Status Panel -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-lg mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-search-location"></i> Track Device</h5>
                    <form id="trackForm">
                        <div class="mb-3">
                            <label class="form-label">Enter Serial Number</label>
                            <div class="input-group">
                                <input type="text" id="serialInput" class="form-control" placeholder="SN-XXXXX">
                                <button class="btn btn-primary" type="button" onclick="lookupDevice()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="deviceResult" class="d-none mt-4">
                        <div class="p-3 bg-light rounded border">
                            <h6 class="fw-bold text-primary" id="dName">Device Name</h6>
                            <p class="mb-1 small"><strong>Status:</strong> <span id="dStatus" class="badge bg-success">Active</span></p>
                            <p class="mb-1 small"><strong>Owner:</strong> <span id="dOwner">--</span></p>
                            <p class="mb-2 small"><strong>Last Location:</strong> <span id="timestamp">Just now</span></p>
                            
                            <hr>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-danger btn-sm" onclick="reportStolen()">Report Stolen</button>
                                <button class="btn btn-outline-secondary btn-sm">View History</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Widget -->
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body">
                    <h6 class="text-muted text-uppercase small fw-bold">System Status</h6>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <span class="d-block h4 mb-0 fw-bold">Active</span>
                            <small class="text-success"><i class="fas fa-satellite-dish"></i> GPS Live</small>
                        </div>
                        <div class="text-end">
                            <span class="d-block h4 mb-0 fw-bold">124</span>
                            <small class="text-muted">Tracked Assets</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg h-100" style="min-height: 500px;">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-map-marked-alt text-primary"></i> Live Location Map</h5>
                    <span class="badge bg-light text-dark border">Real-time</span>
                </div>
                <div class="card-body p-0 position-relative">
                    <!-- Map Placeholder -->
                    <div id="map" style="width: 100%; height: 100%; min-height: 500px; background: #e9ecef; display: flex; align-items: center; justify-content: center;">
                        <div class="text-center text-muted">
                            <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                            <h5>Google Maps Integation</h5>
                            <p>Map will render here with API Key.</p>
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=Kigali,Rwanda&zoom=13&size=600x300&maptype=roadmap&key=YOUR_API_KEY_HERE" style="max-width: 100%; opacity: 0.7;">
                        </div>
                    </div>
                    
                    <!-- Overlay Controls -->
                    <div class="position-absolute bottom-0 end-0 p-3">
                        <button class="btn btn-light shadow-sm"><i class="fas fa-crosshairs"></i> My Location</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function lookupDevice() {
        const serial = document.getElementById('serialInput').value;
        if(!serial) return alert('Please enter serial number');

        // Mock lookup simulation
        const btn = document.querySelector('.btn-primary');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        setTimeout(() => {
            document.getElementById('deviceResult').classList.remove('d-none');
            document.getElementById('dName').innerText = 'Samsung Galaxy S23 Ultra';
            document.getElementById('dOwner').innerText = 'John Doe';
            document.getElementById('dStatus').className = 'badge bg-success';
            document.getElementById('dStatus').innerText = 'Active';
            
            btn.innerHTML = originalHtml;
        }, 1000);
        
        // In real app, perform fetch to /api/devices/lookup/{serial}
    }

    function reportStolen() {
        if(confirm('Are you sure you want to report this device as STOLEN? This will alert authorities.')) {
            document.getElementById('dStatus').className = 'badge bg-danger blink';
            document.getElementById('dStatus').innerText = 'STOLEN - TRACKING';
            alert('Status updated. Tracking activated.');
        }
    }
</script>

<style>
    .blink { animation: blinker 1.5s linear infinite; }
    @keyframes blinker { 50% { opacity: 0; } }
</style>
@endsection
