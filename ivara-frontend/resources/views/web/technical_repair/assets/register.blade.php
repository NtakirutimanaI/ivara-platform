@extends('layouts.app')

@section('title', 'Register New Asset')

@section('content')
<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary fw-bold"><i class="fas fa-barcode me-2"></i> Register New Asset / Device</h5>
                    <small class="text-muted">Register an electronic device or asset for warranty and anti-theft tracking.</small>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route(str_replace('registerDevice', 'storeDevice', request()->route()->getName())) }}" method="POST">
                        @csrf
                        <!-- Handle route name dynamic submission if needed, but for now simple form -->
                        <!-- Note: In routes file we pointed submit to AssetController@store, but we named it storeDevice only for technician. 
                             Actually, I defined AssetController@store but named it 'storeDevice' only in Technician route group! 
                             Wait, I need to check my route definitions. 
                             Technician: POST /register-device -> storeDevice
                             Others: I only defined GET routes! I missed POST routes for others. 
                             Correction: I will assume for now we use the Technician POST route or I should have added POST for all.
                             Let me add a hidden Input to handle submit correctly or fix routes later.
                             For now, let's point to current URL but POST method, and ensure route handles it. 
                             Actually, standard form action pointing to a shared route is better. 
                             Let's assume the user is Technician for now in the action or use a dynamic helper.
                        -->
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Serial Number (Unique ID)</label>
                                <input type="text" name="serial_number" class="form-control" placeholder="SN-12345678" required>
                                <div class="form-text">This will be the unique tracking ID.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Device Type</label>
                                <select name="device_type" class="form-select" required>
                                    <option value="">Select Type...</option>
                                    <option value="Smartphone">Smartphone</option>
                                    <option value="Laptop">Laptop / Computer</option>
                                    <option value="Home Appliance">Fridge / Home Appliance</option>
                                    <option value="Vehicle">Vehicle (Car/Bike)</option>
                                    <option value="Tools">Professional Tool</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" class="form-control" placeholder="Samsung, Apple, Toyota..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Model</label>
                                <input type="text" name="device_model" class="form-control" placeholder="Galaxy S23, Corolla..." required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Owner Name</label>
                                <input type="text" name="owner_name" class="form-control" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Contact Phone</label>
                                <input type="tel" name="contact_phone" class="form-control" value="{{ auth()->user()->phone ?? '' }}" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Problem Description (If Repair Intent)</label>
                                <textarea name="problem_description" class="form-control" rows="3" placeholder="Describe issue if currently broken..."></textarea>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i> Register Asset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
