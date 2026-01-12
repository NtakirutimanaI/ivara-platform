@extends('layouts.app')

@section('content')
<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(0, 0, 0, 0.08);
        --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        --primary: #4F46E5;
    }

    [data-theme="dark"] {
        --glass-bg: rgba(17, 24, 39, 0.8);
        --glass-border: rgba(255, 255, 255, 0.08);
        --text-main: #f8fafc;
        --text-muted: #9ca3af;
    }

    .rules-wrapper {
        padding: 40px 30px;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .rules-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        color: var(--text-main);
    }

    .rules-header p {
        color: var(--text-muted);
        font-weight: 500;
        margin-top: 8px;
    }

    .rules-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        backdrop-filter: blur(20px);
        margin-bottom: 24px;
    }

    .rules-card h4 {
        font-weight: 800;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text-main);
    }

    .slider-group {
        margin-bottom: 24px;
    }

    .slider-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-weight: 600;
        color: var(--text-main);
    }

    .slider-value {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--primary);
    }

    .form-range {
        width: 100%;
        height: 8px;
        background: rgba(79, 70, 229, 0.1);
        border-radius: 10px;
        outline: none;
        -webkit-appearance: none;
    }

    .form-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.4);
    }

    .form-range::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: var(--primary);
        border-radius: 50%;
        cursor: pointer;
        border: none;
    }

    .form-check-input {
        width: 48px;
        height: 24px;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .form-check-label {
        margin-left: 12px;
        font-weight: 600;
        color: var(--text-main);
    }

    .glass-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid var(--glass-border);
        background: rgba(0, 0, 0, 0.02);
        color: var(--text-main);
        font-weight: 600;
        transition: all 0.3s ease;
    }

    [data-theme="dark"] .glass-input {
        background: rgba(255, 255, 255, 0.03);
    }

    .glass-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .glass-select {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid var(--glass-border);
        background: var(--glass-bg);
        color: var(--text-main);
        font-weight: 600;
        cursor: pointer;
    }

    .btn-save {
        width: 100%;
        padding: 14px;
        border-radius: 16px;
        border: none;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .btn-primary-save {
        background: linear-gradient(135deg, #4F46E5 0%, #4338ca 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    }

    .btn-primary-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.5);
    }

    .input-group-text {
        background: rgba(79, 70, 229, 0.1);
        border: 1px solid var(--glass-border);
        color: var(--text-main);
        font-weight: 700;
    }

    .form-label {
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 8px;
        display: block;
    }
</style>

<div class="rules-wrapper">
    <div class="rules-header mb-5">
        <h1>Global Marketplace Rules</h1>
        <p>Configure commission rates, tax policies, and payout schedules for the entire platform</p>
    </div>

    <div class="row">
        <!-- Commission Structure -->
        <div class="col-md-6">
            <div class="rules-card">
                <h4>
                    <i class="fas fa-percentage"></i>
                    Commission Structure
                </h4>

                <form id="commissionForm">
                    @csrf
                    <div class="slider-group">
                        <div class="slider-label">
                            <span>Standard Service Commission</span>
                            <span class="slider-value" id="stdCommValue">{{ session('billing_rules.standard_commission', 15) }}%</span>
                        </div>
                        <input type="range" class="form-range" min="0" max="30" step="1" 
                               id="stdComm" name="standard_commission" 
                               value="{{ session('billing_rules.standard_commission', 15) }}"
                               oninput="updateSliderValue('stdComm', 'stdCommValue')">
                    </div>

                    <div class="slider-group">
                        <div class="slider-label">
                            <span>Premium Provider Commission</span>
                            <span class="slider-value" id="premCommValue">{{ session('billing_rules.premium_commission', 10) }}%</span>
                        </div>
                        <input type="range" class="form-range" min="0" max="30" step="1" 
                               id="premComm" name="premium_commission" 
                               value="{{ session('billing_rules.premium_commission', 10) }}"
                               oninput="updateSliderValue('premComm', 'premCommValue')">
                    </div>

                    <div class="slider-group">
                        <div class="slider-label">
                            <span>Product Sales Commission</span>
                            <span class="slider-value" id="prodCommValue">{{ session('billing_rules.product_commission', 5) }}%</span>
                        </div>
                        <input type="range" class="form-range" min="0" max="30" step="1" 
                               id="prodComm" name="product_commission" 
                               value="{{ session('billing_rules.product_commission', 5) }}"
                               oninput="updateSliderValue('prodComm', 'prodCommValue')">
                    </div>

                    <button type="submit" class="btn-save btn-primary-save">
                        <i class="fas fa-save me-2"></i>Update Commission Rates
                    </button>
                </form>
            </div>
        </div>

        <!-- Tax & Fees -->
        <div class="col-md-6">
            <div class="rules-card">
                <h4>
                    <i class="fas fa-file-invoice-dollar"></i>
                    Tax & Fees Configuration
                </h4>

                <form id="taxForm">
                    @csrf
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="vatToggle" 
                               name="vat_enabled" {{ session('billing_rules.vat_enabled', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="vatToggle">
                            Apply VAT (18%) automatically
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Fixed Transaction Fee (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="glass-input" name="transaction_fee" 
                                   step="0.01" min="0" 
                                   value="{{ session('billing_rules.transaction_fee', 0.50) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Payout Schedule</label>
                        <select class="glass-select" name="payout_schedule">
                            <option value="weekly" {{ session('billing_rules.payout_schedule') == 'weekly' ? 'selected' : '' }}>Weekly (Mondays)</option>
                            <option value="biweekly" {{ session('billing_rules.payout_schedule') == 'biweekly' ? 'selected' : '' }}>Bi-Weekly</option>
                            <option value="monthly" {{ session('billing_rules.payout_schedule') == 'monthly' ? 'selected' : '' }}>Monthly (1st)</option>
                            <option value="instant" {{ session('billing_rules.payout_schedule') == 'instant' ? 'selected' : '' }}>Instant (On Request)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-save btn-primary-save">
                        <i class="fas fa-check me-2"></i>Save Financial Policies
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSliderValue(sliderId, valueId) {
        const slider = document.getElementById(sliderId);
        const valueDisplay = document.getElementById(valueId);
        valueDisplay.textContent = slider.value + '%';
    }

    // Commission Form Handler
    document.getElementById('commissionForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch('/super_admin/billing/rules/commission', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                showNotify('Commission rates updated successfully!', 'success');
            } else {
                showNotify(data.message || 'Failed to update commission rates', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred', 'error');
        }
    });

    // Tax Form Handler
    document.getElementById('taxForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch('/super_admin/billing/rules/tax', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                showNotify('Financial policies saved successfully!', 'success');
            } else {
                showNotify(data.message || 'Failed to save policies', 'error');
            }
        } catch (error) {
            showNotify('Network error occurred', 'error');
        }
    });
</script>
@endsection
