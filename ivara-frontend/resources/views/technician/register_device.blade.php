@extends('layouts.app')

@section('title', 'Register Device - Technician')

@section('content')
<div class="register-device-page">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-content">
            <a href="{{ route('technician.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <h1><i class="fas fa-plus-circle"></i> Register New Device</h1>
            <p>Add a new device for repair or maintenance</p>
        </div>
    </div>

    {{-- Registration Form --}}
    <div class="form-container">
        <form action="{{ route('technician.storeDevice') }}" method="POST" enctype="multipart/form-data" class="device-form">
            @csrf

            {{-- Client Selection --}}
            <div class="form-section">
                <h3><i class="fas fa-user"></i> Client Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="client_id">Select Client <span class="required">*</span></label>
                        <select name="client_id" id="client_id" required>
                            <option value="">-- Select a Client --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->phone ?? $client->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn-secondary" onclick="toggleNewClientForm()">
                            <i class="fas fa-user-plus"></i> Add New Client
                        </a>
                    </div>
                </div>

                {{-- New Client Form (Hidden by default) --}}
                <div id="newClientForm" class="new-client-form" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="new_client_name">Client Name</label>
                            <input type="text" id="new_client_name" name="new_client_name" placeholder="Enter client name">
                        </div>
                        <div class="form-group">
                            <label for="new_client_phone">Phone Number</label>
                            <input type="tel" id="new_client_phone" name="new_client_phone" placeholder="+250 xxx xxx xxx">
                        </div>
                        <div class="form-group">
                            <label for="new_client_email">Email Address</label>
                            <input type="email" id="new_client_email" name="new_client_email" placeholder="client@example.com">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Device Information --}}
            <div class="form-section">
                <h3><i class="fas fa-mobile-alt"></i> Device Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="device_type">Device Type <span class="required">*</span></label>
                        <select name="device_type" id="device_type" required>
                            <option value="">-- Select Type --</option>
                            <option value="smartphone">Smartphone</option>
                            <option value="laptop">Laptop</option>
                            <option value="tablet">Tablet</option>
                            <option value="desktop">Desktop Computer</option>
                            <option value="printer">Printer</option>
                            <option value="tv">Television</option>
                            <option value="appliance">Home Appliance</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand <span class="required">*</span></label>
                        <input type="text" id="brand" name="brand" placeholder="e.g. Apple, Samsung, HP" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model <span class="required">*</span></label>
                        <input type="text" id="model" name="model" placeholder="e.g. iPhone 14 Pro, Galaxy S23" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="serial_number">Serial Number / IMEI</label>
                        <input type="text" id="serial_number" name="serial_number" placeholder="Device serial number or IMEI">
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" id="color" name="color" placeholder="e.g. Space Gray, White">
                    </div>
                    <div class="form-group">
                        <label for="condition">Physical Condition</label>
                        <select name="condition" id="condition">
                            <option value="good">Good - Minor scratches</option>
                            <option value="fair">Fair - Visible wear</option>
                            <option value="poor">Poor - Significant damage</option>
                            <option value="broken">Broken - Non-functional</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Problem Description --}}
            <div class="form-section">
                <h3><i class="fas fa-tools"></i> Problem & Repair Details</h3>
                <div class="form-row full-width">
                    <div class="form-group">
                        <label for="problem_description">Problem Description <span class="required">*</span></label>
                        <textarea id="problem_description" name="problem_description" rows="4" placeholder="Describe the issue in detail..." required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="priority">Priority Level <span class="required">*</span></label>
                        <select name="priority" id="priority" required>
                            <option value="normal">Normal - Standard queue</option>
                            <option value="high">High - Expedited service</option>
                            <option value="urgent">Urgent - Same day if possible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estimated_cost">Estimated Cost (RWF)</label>
                        <input type="number" id="estimated_cost" name="estimated_cost" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label for="estimated_days">Estimated Days</label>
                        <input type="number" id="estimated_days" name="estimated_days" placeholder="1" min="1">
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="form-section">
                <h3><i class="fas fa-info-circle"></i> Additional Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="accessories">Accessories Received</label>
                        <input type="text" id="accessories" name="accessories" placeholder="Charger, case, cables, etc.">
                    </div>
                    <div class="form-group">
                        <label for="password">Device Password/PIN</label>
                        <input type="text" id="password" name="device_password" placeholder="If needed for diagnostics">
                    </div>
                </div>
                <div class="form-row full-width">
                    <div class="form-group">
                        <label for="notes">Internal Notes</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Notes for technicians (not visible to client)..."></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="device_images">Device Photos</label>
                        <input type="file" id="device_images" name="device_images[]" multiple accept="image/*">
                        <small>Upload photos of the device condition (max 5 images)</small>
                    </div>
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="form-actions">
                <a href="{{ route('technician.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Register Device
                </button>
            </div>
        </form>
    </div>
</div>

<style>
html, body { margin: 0; padding: 0; overflow-x: hidden; }

.register-device-page {
    font-family: 'Inter', sans-serif;
    background: #f1f5f9;
    min-height: 100vh;
    padding: 12px 16px 20px 16px;
    margin: 0;
    width: 93%;
    margin-left:20px;
}

.page-header {
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    border-radius: 16px;
    padding: 24px 32px;
    color: white;
    margin-bottom: 24px;
}
.back-link {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 8px;
}
.back-link:hover { color: white; }
.page-header h1 {
    font-size: 1.75rem;
    font-weight: 800;
    margin: 0 0 4px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.page-header p {
    opacity: 0.9;
    margin: 0;
}

.form-container {
    background: white;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
}

.form-section {
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid #e2e8f0;
}
.form-section:last-of-type {
    border-bottom: none;
}
.form-section h3 {
    font-size: 1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 20px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-section h3 i {
    color: #6366f1;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 16px;
}
.form-row.full-width {
    grid-template-columns: 1fr;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.form-group label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}
.required {
    color: #ef4444;
}
.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 14px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.form-group small {
    font-size: 11px;
    color: #64748b;
}

.new-client-form {
    background: #f8fafc;
    padding: 20px;
    border-radius: 10px;
    margin-top: 16px;
}

.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 12px 18px;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
    margin-top: 22px;
}
.btn-secondary:hover {
    background: #e2e8f0;
    color: #1e293b;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 24px;
    border-top: 1px solid #e2e8f0;
}
.btn-cancel {
    padding: 14px 24px;
    background: #f1f5f9;
    color: #475569;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-cancel:hover {
    background: #e2e8f0;
}
.btn-submit {
    padding: 14px 28px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99,102,241,0.3);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    .register-device-page {
        padding: 12px;
    }
    .form-container {
        padding: 20px;
    }
}

/* Dark Mode Support */
body.dark-mode .register-device-page {
    background: #0f172a;
}
body.dark-mode .form-container {
    background: #1e293b;
}
body.dark-mode .form-section {
    border-color: #334155;
}
body.dark-mode .form-section h3 {
    color: #f1f5f9;
}
body.dark-mode .form-group label {
    color: #cbd5e1;
}
body.dark-mode .form-group input,
body.dark-mode .form-group select,
body.dark-mode .form-group textarea {
    background: #334155;
    border-color: #475569;
    color: #f1f5f9;
}
body.dark-mode .new-client-form {
    background: #334155;
}
body.dark-mode .btn-secondary {
    background: #334155;
    border-color: #475569;
    color: #cbd5e1;
}
body.dark-mode .btn-cancel {
    background: #334155;
    color: #cbd5e1;
}
body.dark-mode .form-actions {
    border-color: #334155;
}
</style>

<script>
function toggleNewClientForm() {
    const form = document.getElementById('newClientForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
