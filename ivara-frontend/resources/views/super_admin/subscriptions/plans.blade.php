@extends('layouts.app')

@section('title', 'Subscription Plans Management')

@section('content')
<div class="unique-subscriptions-wrapper">
    <div class="container-fluid p-0">
        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
            <div>
                <h1 class="sub-page-title mb-1">Subscription Plans</h1>
                <p class="sub-page-subtitle mb-0">Configure pricing tiers, features, and billing cycles for the platform.</p>
            </div>
            
            <button class="sub-btn-primary" onclick="openPlanModal()">
                <i class="fas fa-plus me-2"></i> Create New Plan
            </button>
        </div>

        <!-- Plans Grid -->
        <div class="row g-4" id="plansGrid">
            <!-- Starting Data Rendered via JS for interactivity -->
        </div>

    </div>
</div>

<!-- Plan Modal -->
<div class="modal fade" id="planModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content sub-glass-card border-0">
            <div class="modal-header border-0 pb-0 d-flex align-items-center">
                <h5 class="modal-title fw-bold" id="modalTitle">Create New Plan</h5>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" id="planActive" checked>
                    </div>
                    <button type="button" class="btn btn-sm btn-icon btn-dark rounded-circle shadow-sm border border-secondary" onclick="closeModal()" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body pt-3">
                <input type="hidden" id="planId">
                <div class="row g-2">
                    <div class="col-8">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control form-control-sm rounded-3" id="planName" placeholder="Name">
                    </div>
                    <div class="col-4">
                        <label class="form-label">Theme</label>
                        <select class="form-select form-select-sm rounded-3" id="planColor">
                            <option value="primary">Blue</option>
                            <option value="warning">Gold</option>
                            <option value="success">Green</option>
                        </select>
                    </div>
                </div>

                <div class="row g-2 mt-0">
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0">RWF</span>
                            <input type="number" class="form-control form-control-sm border-start-0" id="planPrice" placeholder="0">
                        </div>
                    </div>
                    <div class="col-6">
                        <select class="form-select form-select-sm rounded-3" id="planCycle">
                            <option value="/mo">Monthly</option>
                            <option value="/yr">Yearly</option>
                        </select>
                    </div>
                </div>

                <div class="mt-2">
                    <textarea class="form-control form-control-sm rounded-3" id="planFeatures" rows="2" placeholder="Features (one per line)..."></textarea>
                </div>

            </div>
            <div class="modal-footer border-0 pt-2">
                <button type="button" class="btn btn-light rounded-pill px-4" onclick="closeModal()">Cancel</button>
                <button type="button" class="sub-btn-primary rounded-pill px-4" onclick="savePlan()">Save Plan</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Namespace */
    .unique-subscriptions-wrapper {
        font-family: 'Inter', sans-serif;
        padding-top: 3rem;
        padding-bottom: 2rem;
    }

    /* Typography */
    .sub-page-title {
        font-weight: 800;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); /* Gold/Orange theme for Subs */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2rem;
    }
    .sub-page-subtitle { color: #64748b; font-size: 1rem; }

    /* Button */
    .sub-btn-primary {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
    }
    .sub-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.4);
        color: white;
    }

    /* Cards */
    .sub-card {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        position: relative;
    }
    .sub-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .sub-card.inactive { opacity: 0.7; filter: grayscale(0.8); }

    .sub-card-header {
        padding: 1.25rem 1.5rem; /* Reduced padding */
        text-align: center;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        position: relative;
    }
    
    .sub-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        font-size: 0.65rem; /* Smaller badge */
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .sub-card-title { font-weight: 800; font-size: 1.1rem; margin-bottom: 0.25rem; } /* Smaller title */
    .sub-price { font-size: 1.75rem; font-weight: 900; color: #1e293b; letter-spacing: -1px; } /* Smaller price */
    .sub-price small { font-size: 0.85rem; font-weight: 500; color: #94a3b8; }
    
    .sub-card-body { padding: 1.5rem; flex: 1; } /* Reduced body padding */
    
    .feature-list { list-style: none; padding: 0; margin: 0; }
    .feature-item { 
        display: flex; 
        align-items: center; 
        gap: 8px; /* Tighter gap */
        margin-bottom: 8px; /* Tighter spacing */
        color: #475569; 
        font-size: 0.85rem; /* Smaller text */
    }
    .feature-icon { color: #10b981; flex-shrink: 0; font-size: 0.8rem; }

    .sub-card-footer {
        padding: 1.5rem;
        background: rgba(248, 250, 252, 0.5);
        border-top: 1px solid rgba(226, 232, 240, 0.6);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Modal Custom Fixes */
    #planModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1060;
        overflow: hidden;
        outline: 0;
        display: flex; /* Ensure Flex is default in CSS too */
        align-items: center;
        justify-content: center;
        padding: 2rem; /* Prevent touching edges */
    }
    
    #planModal .modal-dialog {
        margin: 0; /* Remove Bootstrap margin for perfect centering */
        pointer-events: auto;
        max-width: 400px; /* Force a compact width */
    }
    
    .modal-backdrop {
        z-index: 1050;
        background-color: rgba(15, 23, 42, 0.7); /* Darker, richer backdrop */
    }

    /* Premium Glass Card */
    .sub-glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    
    /* Dark Mode Overrides */
    [data-theme="dark"] .sub-glass-card { 
        background: rgba(30, 41, 59, 0.85); 
        border-color: rgba(255, 255, 255, 0.08); 
    }
    
    /* Input Polish */
    #planModal .form-control-sm,
    #planModal .form-select-sm,
    #planModal .input-group-text {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
    }

    /* Dark Mode */
    /* Dark Mode & Premium Modal Inputs */
    [data-theme="dark"] .sub-page-title { background: linear-gradient(135deg, #fbbf24 0%, #b45309 100%); -webkit-background-clip: text; }
    [data-theme="dark"] .sub-card { background: #1e293b; border-color: #334155; }
    [data-theme="dark"] .sub-price { color: #fff; }
    [data-theme="dark"] .feature-item { color: #cbd5e1; }
    [data-theme="dark"] .sub-card-footer { background: #0f172a; border-color: #334155; }
    
    /* Modal Specifics */
    [data-theme="dark"] .sub-glass-card { background: #1e293b; border-color: #475569; color: #fff; border-radius: 1rem !important; }
    
    #planModal .modal-body {
        padding: 1.5rem !important; /* Compact padding */
    }
    
    #planModal .form-label {
        display: block;
        margin-bottom: 0.2rem; /* Tighter label spacing */
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
    }
    
    #planModal textarea {
        font-family: inherit !important; /* Fix monospace font */
    }

    /* Custom Toggle Switch Style */
    #planModal .form-check-input {
        width: 2.2em;
        height: 1.2em;
        margin-top: 0.1em;
        cursor: pointer;
    }
    
    #planModal .form-check {
        padding-left: 2.8em; /* Space for the toggle */
        display: flex;
        align-items: center;
    }
    
    #planModal .form-check-label {
        font-weight: 600;
        cursor: pointer;
    }
    
    /* Dark Mode Inputs */
    [data-theme="dark"] #planModal .form-control, 
    [data-theme="dark"] #planModal .form-select { 
        background-color: rgba(255, 255, 255, 0.03); 
        border-color: rgba(255, 255, 255, 0.1); 
        color: #f1f5f9;
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
    }
    
    [data-theme="dark"] #planModal .form-control:focus, 
    [data-theme="dark"] #planModal .form-select:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2);
        background-color: rgba(255, 255, 255, 0.05);
    }

    [data-theme="dark"] #planModal .input-group-text { 
        background-color: rgba(255, 255, 255, 0.05); 
        border-color: rgba(255, 255, 255, 0.1); 
        color: #94a3b8;
    }
    
    [data-theme="dark"] .text-muted { color: #94a3b8 !important; }

</style>

<script>
    // Initial Data
    let plans = [
        { 
            id: 1, 
            name: 'Basic Free', 
            price: 0, 
            cycle: '/mo', 
            features: ['Basic Profile', 'Search Access', 'Community Support'], 
            active: true,
            color: 'info'
        },
        { 
            id: 2, 
            name: 'Pro Provider', 
            price: 15000, 
            cycle: '/mo', 
            features: ['Verified Badge', 'Priority Search', 'Analytics Dashboard', 'Direct Messaging', '24/7 Support'], 
            active: true,
            color: 'primary'
        },
        { 
            id: 3, 
            name: 'Business Elite', 
            price: 45000, 
            cycle: '/yr', 
            features: ['Multiple Accounts', 'API Access', 'Featured Listings', 'Dedicated Manager', 'Custom Branding'], 
            active: false,
            color: 'warning'
        }
    ];

    document.addEventListener('DOMContentLoaded', renderPlans);

    function renderPlans() {
        const grid = document.getElementById('plansGrid');
        grid.innerHTML = '';

        plans.forEach(plan => {
            const statusBadge = plan.active 
                ? `<span class="sub-badge bg-success-subtle text-success border border-success-subtle">Active</span>`
                : `<span class="sub-badge bg-secondary-subtle text-secondary border border-secondary-subtle">Inactive</span>`;
            
            const inactiveClass = plan.active ? '' : 'inactive';
            const btnClass = `btn-outline-${plan.color}`;
            
            // Format features
            const featureHtml = plan.features.map(f => `
                <li class="feature-item">
                    <i class="fas fa-check-circle feature-icon text-${plan.color}"></i>
                    ${f}
                </li>
            `).join('');

            const html = `
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="sub-card ${inactiveClass}">
                        ${statusBadge}
                        <div class="sub-card-header">
                            <h3 class="sub-card-title text-${plan.color}">${plan.name}</h3>
                            <div class="sub-price">
                                ${new Intl.NumberFormat().format(plan.price)}
                                <small>${plan.cycle == 'one-time' ? '' : plan.cycle}</small>
                            </div>
                            ${plan.price === 0 ? '<span class="badge bg-light text-dark mt-2">Forever Free</span>' : `<small class="text-muted d-block mt-1">RWF</small>`}
                        </div>
                        <div class="sub-card-body">
                            <ul class="feature-list">
                                ${featureHtml}
                            </ul>
                        </div>
                        <div class="sub-card-footer">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                    onchange="togglePlanStatus(${plan.id})" ${plan.active ? 'checked' : ''}>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="editPlan(${plan.id})" title="Edit">
                                    <i class="fas fa-pencil-alt text-muted"></i>
                                </button>
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="deletePlan(${plan.id})" title="Delete">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            grid.insertAdjacentHTML('beforeend', html);
        });
    }

    // Modal Logic - Robust Implementation
    function openPlanModal() {
        // Reset Form for New Plan
        document.getElementById('planId').value = '';
        document.getElementById('planName').value = '';
        document.getElementById('planPrice').value = '';
        document.getElementById('planFeatures').value = '';
        document.getElementById('planActive').checked = true;
        document.getElementById('planColor').value = 'primary';
        document.getElementById('planCycle').value = '/mo';
        
        document.getElementById('modalTitle').innerText = 'Create New Plan';
        
        // Manual Show
        const modalEl = document.getElementById('planModal');
        modalEl.style.display = 'flex'; // Use Flex for centering
        setTimeout(() => modalEl.classList.add('show'), 10); // Fade in
        
        // Add Backdrop
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.id = 'customBackdrop';
        document.body.appendChild(backdrop);
        document.body.classList.add('modal-open');
    }

    function editPlan(id) {
        const plan = plans.find(p => p.id === id);
        if(!plan) return;

        // Populate Form
        document.getElementById('planId').value = plan.id;
        document.getElementById('planName').value = plan.name;
        document.getElementById('planPrice').value = plan.price;
        document.getElementById('planFeatures').value = plan.features.join('\n');
        document.getElementById('planActive').checked = plan.active;
        document.getElementById('planColor').value = plan.color;
        document.getElementById('planCycle').value = plan.cycle;
        
        document.getElementById('modalTitle').innerText = 'Edit Plan';
        
        // Manual Show
        const modalEl = document.getElementById('planModal');
        modalEl.style.display = 'flex';
        setTimeout(() => modalEl.classList.add('show'), 10);
        
        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.id = 'customBackdrop';
        document.body.appendChild(backdrop);
        document.body.classList.add('modal-open');
    }

    function closeModal() {
        const modalEl = document.getElementById('planModal');
        modalEl.classList.remove('show');
        setTimeout(() => {
            modalEl.style.display = 'none';
        }, 150); // Wait for transition
        
        const backdrop = document.getElementById('customBackdrop');
        if(backdrop) backdrop.remove();
        document.body.classList.remove('modal-open');
    }

    function savePlan() {
        const id = document.getElementById('planId').value;
        const name = document.getElementById('planName').value;
        const price = document.getElementById('planPrice').value;
        const color = document.getElementById('planColor').value;
        const cycle = document.getElementById('planCycle').value;
        const featuresText = document.getElementById('planFeatures').value;
        const active = document.getElementById('planActive').checked;
        
        if(!name || !price) {
            showToast('Please fill in Plan Name and Price', 'error');
            return;
        }

        const features = featuresText.split('\n').filter(line => line.trim() !== '');

        if(id) {
            // Update Existing
            const index = plans.findIndex(p => p.id == id);
            if(index !== -1) {
                plans[index] = { ...plans[index], name, price: parseInt(price), color, cycle, features, active };
            }
        } else {
            // Create New
            const newId = plans.length > 0 ? Math.max(...plans.map(p => p.id)) + 1 : 1;
            plans.push({
                id: newId,
                name,
                price: parseInt(price),
                color,
                cycle,
                features,
                active
            });
        }

        // Close Modal Manually
        closeModal();
        renderPlans();
        
        const actionMsg = id ? 'Plan updated successfully!' : 'New plan created successfully!';
        showToast(actionMsg, 'success');
    }

    function showToast(msg, type = 'success') {
        let container = document.getElementById('custom-toast-container');
        if(!container) {
            container = document.createElement('div');
            container.id = 'custom-toast-container';
            // High Z-Index + Top Padding to avoid Navbar
            container.style.cssText = "position: fixed; top: 80px; right: 20px; z-index: 20000; display: flex; flex-direction: column; gap: 10px;";
            document.body.appendChild(container);
        }
        
        const isError = type === 'error';
        const bgColor = isError ? '#ef4444' : '#10b981'; // Red or Green
        const iconInfo = isError ? 'fa-exclamation-circle' : 'fa-check-circle';
        
        const toast = document.createElement('div');
        
        // Custom Inline Styles for Guaranteed Visibility
        toast.style.cssText = `
            background-color: ${bgColor};
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            min-width: 300px;
            font-weight: 600;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        `;
        
        toast.innerHTML = `
            <i class="fas ${iconInfo} fa-lg me-3"></i>
            <span style="flex:1">${msg}</span>
            <button onclick="this.parentElement.remove()" style="background:none; border:none; color:white; opacity:0.8; font-size:1.2rem; cursor:pointer;">&times;</button>
        `;
        
        container.appendChild(toast);
        
        // Animate In
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        });
        
        // Auto remove
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(20px)';
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }

    function deletePlan(id) {
        if(confirm('Are you sure you want to delete this plan?')) {
            plans = plans.filter(p => p.id !== id);
            renderPlans();
        }
    }

    function togglePlanStatus(id) {
        const plan = plans.find(p => p.id === id);
        if(plan) {
            plan.active = !plan.active;
            renderPlans(); // Re-render to update UI (grayscale effect)
        }
    }
</script>
@endsection
