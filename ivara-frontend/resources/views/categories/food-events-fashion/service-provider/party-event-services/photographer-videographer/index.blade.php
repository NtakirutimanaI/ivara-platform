@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { background-color: #2e2e2e; color: #e0e0e0; font-family: 'Inter', sans-serif; } /* Dark Mode */
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem; }
    .photo-card { height: 200px; background-size: cover; background-position: center; border-radius: 8px; position: relative; transition: 0.3s; cursor: pointer; }
    .photo-card:hover { transform: scale(1.02); z-index: 10; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
    .photo-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); padding: 10px; opacity: 0; transition: 0.3s; }
    .photo-card:hover .photo-overlay { opacity: 1; }
</style>
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">Studio Dashboard 📸</h2>
        <button class="btn btn-light rounded-pill"><i class="fas fa-cloud-upload-alt me-2"></i> Upload Assets</button>
    </div>

    <div class="row mb-5">
        <div class="col-md-3">
             <div class="bg-dark p-3 rounded border border-secondary text-center">
                 <h3 class="fw-bold text-white mb-0">1,240</h3>
                 <small class="text-muted">Photos Processed</small>
             </div>
        </div>
        <div class="col-md-3">
             <div class="bg-dark p-3 rounded border border-secondary text-center">
                 <h3 class="fw-bold text-warning mb-0">3</h3>
                 <small class="text-muted">Pending Edits</small>
             </div>
        </div>
        <div class="col-md-3">
             <div class="bg-dark p-3 rounded border border-secondary text-center">
                 <h3 class="fw-bold text-info mb-0">Sat, Jan 12</h3>
                 <small class="text-muted">Next Shoot</small>
             </div>
        </div>
    </div>

    <h5 class="text-secondary mb-3">Recent Uploads</h5>
    <div class="gallery-grid">
        <div class="photo-card" style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=300&q=80');">
            <div class="photo-overlay"><small>Wedding_01.jpg</small></div>
        </div>
        <div class="photo-card" style="background-image: url('https://images.unsplash.com/photo-1511285560982-1351cdeb9821?auto=format&fit=crop&w=300&q=80');">
            <div class="photo-overlay"><small>Wedding_02.jpg</small></div>
        </div>
        <div class="photo-card" style="background-image: url('https://images.unsplash.com/photo-1520854221256-17451cc330e7?auto=format&fit=crop&w=300&q=80');">
             <div class="photo-overlay"><small>Fashion_Shoot_A.jpg</small></div>
        </div>
        <div class="photo-card" style="background-image: url('https://images.unsplash.com/photo-1470229722913-7ea2d986561d?auto=format&fit=crop&w=300&q=80');">
             <div class="photo-overlay"><small>Concert_Live.jpg</small></div>
        </div>
         <div class="photo-card bg-secondary d-flex align-items-center justify-content-center">
             <span class="text-white-50"><i class="fas fa-plus fa-2x"></i></span>
        </div>
    </div>
</div>
@endsection
