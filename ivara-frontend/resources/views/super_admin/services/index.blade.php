@extends('layouts.app')

@section('title', 'Service Registry Management')

@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid p-0">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
            <div>
                <h1 class="premium-title mb-1">Service Registry</h1>
                <p class="premium-subtitle mb-0">Platform-wide catalog of professional service offerings.</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="premium-search-wrapper d-none d-md-block">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="srvSearch" class="glass-input" placeholder="Search service name..." oninput="debounceSrvSearch(this.value)" value="{{ request('search') }}" style="margin-top: 0; width: 280px; padding: 12px 20px 12px 45px;">
                </div>
                <button class="btn-glass primary" onclick="openAddSrvModal()">
                    <i class="fas fa-plus"></i> Add New Service
                </button>
            </div>
        </div>

        <!-- Category Groups -->
        @php
            $groupedServices = collect($services)->groupBy('category');
            $categories = [
                'technical-repair' => 'Technical & Repair',
                'creative-lifestyle' => 'Creative & Lifestyle',
                'transport-travel' => 'Transport & Travel',
                'food-fashion' => 'Food, Events & Fashion',
                'legal-professional' => 'Legal & Professional',
                'education-knowledge' => 'Education & Knowledge',
                'construction-maintenance' => 'Construction & Maintenance',
                'digital-technology' => 'Digital & Technology',
                'health-wellness' => 'Health & Wellness'
            ];
        @endphp

        <div class="services-container">
            @forelse($categories as $slug => $label)
                @if(isset($groupedServices[$slug]))
                    <div class="category-separator">
                        <h3>{{ $label }}</h3>
                        <div class="category-line"></div>
                        <span class="role-badge" style="background: var(--p-indigo-light); color: var(--p-indigo);">{{ count($groupedServices[$slug]) }} Services</span>
                    </div>

                    <div class="employee-grid">
                        @foreach($groupedServices[$slug] as $srv)
                            <div class="employee-card text-center">
                                <div class="card-menu">
                                    <button class="menu-dots"><i class="fas fa-ellipsis-h" style="font-size: 0.8rem;"></i></button>
                                    <div class="dropdown-menu-custom text-start">
                                        @if($srv->status !== 'active')
                                            <button class="text-success fw-bold" onclick="publishService('{{ $srv->_id }}')"><i class="fas fa-check-circle me-2"></i> Publish Now</button>
                                        @endif
                                        <button onclick='openEditSrvModal(@json($srv))'><i class="fas fa-edit me-2"></i> Edit</button>
                                        <button class="text-danger" onclick="deleteServiceRecord('{{ $srv->_id }}')"><i class="fas fa-trash-alt me-2"></i> Remove</button>
                                    </div>
                                </div>
                                
                                <div class="service-media mb-3">
                                    <div class="service-img-wrapper">
                                        <img src="{{ $srv->imageUrl ?? 'https://images.unsplash.com/photo-1550684848-fac1c5b4e853?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $srv->name }}" class="service-img">
                                    </div>
                                </div>

                                <div class="d-flex flex-column align-items-center mb-3">
                                    <h4 class="mb-1 w-100 px-3" style="font-size: 1rem; letter-spacing: -0.4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $srv->name }}</h4>
                                    <span class="badge rounded-pill bg-{{ $srv->status === 'active' ? 'success' : ($srv->status === 'review' ? 'warning' : 'secondary') }}-subtle text-{{ $srv->status === 'active' ? 'success' : ($srv->status === 'review' ? 'warning' : 'secondary') }} border-0 px-2 py-1" style="font-size: 0.55rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">
                                        {{ $srv->status }}
                                    </span>
                                </div>
                                
                                <p class="mb-3 description-text px-2" style="line-height: 1.5; font-size: 0.8rem; height: 36px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $srv->description ?? 'No description provided.' }}
                                </p>

                                <div class="row g-0 pt-3 border-top mx-1" style="border-color: var(--glass-border) !important;">
                                    <div class="col-6 border-end" style="border-color: var(--glass-border) !important;">
                                        <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.55rem; letter-spacing: 0.5px;">Base Price</div>
                                        <div class="fw-bold small mb-0" style="color: var(--p-indigo);">{{ number_format($srv->basePrice) }}<br>RWF</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 0.55rem; letter-spacing: 0.5px;">Providers</div>
                                        <div class="fw-bold small mb-0 text-dynamic">{{ $srv->providerCount }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @empty
                <div class="text-center py-5 opacity-50">
                    <i class="fas fa-concierge-bell fa-3x mb-3 text-muted"></i>
                    <h5 class="text-muted">No Services Registered</h5>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($pagination['pages'] > 1)
        <div class="d-flex justify-content-center mt-5">
            <nav>
                <ul class="pagination pagination-rounded gap-2">
                    <li class="page-item {{ $pagination['page'] <= 1 ? 'disabled' : '' }}">
                        <a class="page-link bg-glass border-glass text-main px-4" href="?page={{ $pagination['page']-1 }}&search={{ request('search') }}"><i class="fas fa-chevron-left me-1"></i> Prev</a>
                    </li>
                    @for($i = 1; $i <= $pagination['pages']; $i++)
                    <li class="page-item {{ $i == $pagination['page'] ? 'active' : '' }}">
                        <a class="page-link {{ $i == $pagination['page'] ? 'btn-glass primary' : 'bg-glass border-glass text-main' }} py-2" href="?page={{ $i }}&search={{ request('search') }}" style="border-radius: 12px; min-width: 45px; text-align: center;">{{ $i }}</a>
                    </li>
                    @endfor
                    <li class="page-item {{ $pagination['page'] >= $pagination['pages'] ? 'disabled' : '' }}">
                        <a class="page-link bg-glass border-glass text-main px-4" href="?page={{ $pagination['page']+1 }}&search={{ request('search') }}">Next <i class="fas fa-chevron-right ms-1"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        @endif
    </div>

    <!-- Add/Edit Service Modal (Shorter & Optimized) -->
    <div class="modal-overlay" id="srvModalOverlay">
        <div class="modal-glass modal-sm-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-black mb-0" id="modalTitle" style="font-weight: 900; letter-spacing: -0.5px; color: var(--text-main);">Service Profile</h4>
                </div>
                <button class="btn-close-glass" onclick="closeSrvModal()" style="border: none; background: var(--p-indigo-light); color: var(--p-indigo); width: 30px; height: 30px; border-radius: 8px; cursor: pointer; display: grid; place-items: center;"><i class="fas fa-times" style="font-size: 0.8rem;"></i></button>
            </div>
            
            <form id="srvForm" onsubmit="handleSrvSubmit(event)">
                <input type="hidden" id="srvId">
                
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <label class="label-tiny">Official Name</label>
                        <input type="text" id="srvName" class="glass-input-sm" required placeholder="Service Name">
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <label class="label-tiny">Sector Category</label>
                        <select id="srvCategory" class="glass-input-sm" required>
                            <option value="technical-repair">Technical</option>
                            <option value="creative-lifestyle">Creative</option>
                            <option value="transport-travel">Transport</option>
                            <option value="food-fashion">Food & Fashion</option>
                            <option value="legal-professional">Legal</option>
                            <option value="education-knowledge">Education</option>
                            <option value="construction-maintenance">Construction</option>
                            <option value="digital-technology">Digital</option>
                            <option value="health-wellness">Wellness</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="label-tiny">Registry Status</label>
                        <select id="srvStatus" class="glass-input-sm">
                            <option value="active">Active</option>
                            <option value="review">Review</option>
                            <option value="inactive">Hidden</option>
                        </select>
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <label class="label-tiny">Base Price (RWF)</label>
                        <input type="number" id="srvPrice" class="glass-input-sm" required>
                    </div>
                    <div class="col-6">
                        <label class="label-tiny">Icon Class</label>
                        <input type="text" id="srvIcon" class="glass-input-sm" placeholder="fas fa-box">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="label-tiny">Display Image URL</label>
                    <input type="text" id="srvImageUrl" class="glass-input-sm" placeholder="https://unsplash.com/...">
                </div>

                <div class="mb-3">
                    <label class="label-tiny">Description</label>
                    <textarea id="srvDesc" class="glass-input-sm" rows="2" placeholder="Brief scoop..."></textarea>
                </div>

                <div class="pt-1">
                    <button type="submit" class="btn-glass primary w-100 justify-content-center py-2" id="srvSubmitBtn">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    :root {
        --p-indigo: #6366f1;
        --p-indigo-light: #eef2ff;
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(0, 0, 0, 0.08);
        --card-shadow: 0 15px 30px rgba(0, 0, 0, 0.04);
        --premium-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        --text-main: #1e293b;
        --text-muted: #64748b;
    }

    [data-theme="dark"] {
        --glass-bg: #111827;
        --glass-border: rgba(255, 255, 255, 0.08);
        --p-indigo-light: rgba(99, 102, 241, 0.1);
        --text-main: #f8fafc;
        --text-muted: #9ca3af;
        --card-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .dashboard-wrapper { 
        padding-top: 40px !important; 
        padding-bottom: 60px;
        animation: fadeIn 0.8s ease-out;
    }
    
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .premium-title { font-weight: 900; font-size: 2.5rem; letter-spacing: -1.5px; color: var(--text-main); }
    .premium-subtitle { color: var(--text-muted); font-size: 1.1rem; }

    /* Modal Optimization */
    .modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.6); z-index: 11000;
        display: none; align-items: center; justify-content: center;
        backdrop-filter: blur(12px);
    }
    .modal-overlay.active { display: flex; }
    .modal-glass {
        background: var(--glass-bg); padding: 25px; border-radius: 20px;
        width: 440px; max-width: 95%;
        border: 1px solid var(--glass-border);
        box-shadow: var(--premium-shadow);
        animation: modalEntrance 0.3s ease-out;
    }
    @keyframes modalEntrance { from{opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }

    .glass-input-sm {
        width: 100%; padding: 10px 15px; border-radius: 12px; border: 1px solid var(--glass-border);
        background: rgba(0,0,0,0.02); color: var(--text-main);
        font-size: 0.85rem; outline: none; transition: 0.3s;
    }
    [data-theme="dark"] .glass-input-sm { background: rgba(255, 255, 255, 0.03); }
    .glass-input-sm:focus { border-color: var(--p-indigo); box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1); }
    
    .label-tiny { font-size: 0.6rem; font-weight: 800; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.5px; display: block; margin-bottom: 2px; }

    .btn-glass {
        padding: 14px 28px; border-radius: 18px; font-weight: 800; 
        border: none; cursor: pointer; transition: all 0.3s ease;
        display: inline-flex; align-items: center; gap: 10px; font-size: 0.9rem;
    }
    .btn-glass:hover { transform: translateY(-3px); }
    .btn-glass.primary { background: var(--p-indigo); color: #fff; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3); }

    /* Grid & Cards */
    .employee-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); 
        gap: 20px; 
    }
    
    .employee-card {
        background: var(--glass-bg); border: 1px solid var(--glass-border);
        border-radius: 0px; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative; overflow: hidden; height: 100%;
        backdrop-filter: blur(20px); box-shadow: var(--card-shadow);
        padding: 25px 20px;
    }
    .employee-card:hover { transform: translateY(-8px); box-shadow: var(--premium-shadow); border-color: var(--p-indigo); }
    
    .service-img-wrapper {
        width: 100%; height: 120px; border-radius: 0px; overflow: hidden; margin-bottom: 15px; border: 1px solid var(--glass-border);
    }
    .service-img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
    .employee-card:hover .service-img { transform: scale(1.1); }

    .description-text { font-size: 0.8rem; color: var(--text-main); opacity: 0.85; }
    [data-theme="dark"] .description-text { color: #e2e8f0; opacity: 0.9; }
    [data-theme="dark"] .text-muted { color: #cbd5e1 !important; }
    
    .category-separator { grid-column: 1 / -1; margin-top: 50px; margin-bottom: 20px; display: flex; align-items: center; gap: 15px; }
    .category-separator h3 { font-size: 1.25rem; font-weight: 950; color: var(--text-main); margin: 0; letter-spacing: -0.5px; }
    .category-line { flex: 1; height: 1px; background: var(--glass-border); }

    .role-badge { display: inline-block; padding: 5px 12px; border-radius: 50px; font-weight: 800; font-size: 0.6rem; text-transform: uppercase; }

    /* Dropdown Actions */
    .card-menu { position: absolute; top: 15px; right: 15px; z-index: 10; }
    .menu-dots { 
        width: 32px; height: 32px; border: none; background: rgba(255,255,255,0.8); 
        color: var(--text-muted); border-radius: 10px; cursor: pointer; transition: 0.3s;
        display: grid; place-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    [data-theme="dark"] .menu-dots { background: rgba(0,0,0,0.4); }
    .menu-dots:hover { background: var(--p-indigo); color: #fff; transform: rotate(90deg); }

    .dropdown-menu-custom {
        position: absolute; right: 0; top: 40px; background: var(--glass-bg); 
        border-radius: 14px; width: 150px; display: none; 
        border: 1px solid var(--glass-border);
        box-shadow: var(--premium-shadow); z-index: 50;
        overflow: hidden; backdrop-filter: blur(20px);
    }
    .card-menu:hover .dropdown-menu-custom { display: block; animation: slideIn 0.2s ease; }
    @keyframes slideIn { from{opacity:0; transform:translateY(-5px);} to{opacity:1; transform:translateY(0);} }

    .dropdown-menu-custom button {
        display: block; width: 100%; padding: 10px 15px; text-align: left; background: none; 
        border: none; font-size: 0.8rem; color: var(--text-main); font-weight: 600;
        transition: 0.2s; border-bottom: 1px solid var(--glass-border);
    }
    .dropdown-menu-custom button:last-child { border-bottom: none; }
    .dropdown-menu-custom button:hover { background: var(--p-indigo-light); color: var(--p-indigo); }
    
    .pagination .page-link { box-shadow: none; border-radius: 12px; font-weight: 700; background: var(--glass-bg); border-color: var(--glass-border); color: var(--text-main); }
    .pagination .active .page-link { background: var(--p-indigo) !important; border-color: var(--p-indigo) !important; }

    .premium-search-wrapper { position: relative; }
    .search-icon { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--p-indigo); }
</style>

<script>
let srvTimeout;
function debounceSrvSearch(val) {
    clearTimeout(srvTimeout);
    
    // Immediate visual feedback - optional: could add a spinner to the search icon
    const searchWrapper = document.querySelector('.premium-search-wrapper');
    const searchIcon = searchWrapper.querySelector('.search-icon');
    searchIcon.classList.remove('fa-search');
    searchIcon.classList.add('fa-circle-notch', 'fa-spin');

    srvTimeout = setTimeout(async () => {
        const url = new URL(window.location.href);
        url.searchParams.set('search', val);
        url.searchParams.set('page', 1);
        
        try {
            // Fetch the page but only for the services container part
            const response = await fetch(url.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const html = await response.text();
            
            // Parse the response to extract the services container and pagination
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            const newContent = doc.querySelector('.services-container');
            const newPagination = doc.querySelector('.pagination-wrapper'); // We'll wrap the pagination in this
            
            if (newContent) {
                document.querySelector('.services-container').innerHTML = newContent.innerHTML;
            }
            
            // Handle pagination update if exists
            const existingPagination = document.querySelector('.pagination-wrapper');
            if (existingPagination && newPagination) {
                existingPagination.innerHTML = newPagination.innerHTML;
            } else if (newPagination) {
                // If it didn't exist but now does, we need to handle that, but usually it's there
            }

            // Sync URL without reload
            window.history.pushState({}, '', url.toString());
            
        } catch (err) {
            console.error('Search failed:', err);
        } finally {
            searchIcon.classList.remove('fa-circle-notch', 'fa-spin');
            searchIcon.classList.add('fa-search');
        }
    }, 400); // Faster debounce for "on typing" feel
}

function openAddSrvModal() {
    document.getElementById('srvForm').reset();
    document.getElementById('srvId').value = '';
    document.getElementById('modalTitle').innerText = 'New Service Registry';
    document.getElementById('srvModalOverlay').classList.add('active');
}

function openEditSrvModal(srv) {
    document.getElementById('srvId').value = srv._id;
    document.getElementById('srvName').value = srv.name;
    document.getElementById('srvCategory').value = srv.category;
    document.getElementById('srvPrice').value = srv.basePrice;
    document.getElementById('srvIcon').value = srv.icon || '';
    document.getElementById('srvImageUrl').value = srv.imageUrl || '';
    document.getElementById('srvStatus').value = srv.status;
    document.getElementById('srvDesc').value = srv.description || '';
    document.getElementById('modalTitle').innerText = 'Edit Service Profile';
    document.getElementById('srvModalOverlay').classList.add('active');
}

function closeSrvModal() { document.getElementById('srvModalOverlay').classList.remove('active'); }

async function handleSrvSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('srvId').value;
    const btn = document.getElementById('srvSubmitBtn');
    
    const payload = {
        name: document.getElementById('srvName').value,
        category: document.getElementById('srvCategory').value,
        basePrice: document.getElementById('srvPrice').value,
        icon: document.getElementById('srvIcon').value,
        imageUrl: document.getElementById('srvImageUrl').value,
        status: document.getElementById('srvStatus').value,
        description: document.getElementById('srvDesc').value,
    };

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';

    try {
        const url = id ? `/super_admin/services/${id}` : '/super_admin/services';
        const method = id ? 'PUT' : 'POST';
        const response = await fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify(payload)
        });
        const result = await response.json();
        if (result.success) {
            window.showNotify('success', 'Registry updated successfully!');
            setTimeout(() => location.reload(), 1000);
        } else {
            window.showNotify('error', 'Operation Failed.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save me-2"></i> Save Changes';
        }
    } catch (err) {
        window.showNotify('error', 'Network Error.');
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save me-2"></i> Save Changes';
    }
}

async function publishService(id) {
    if (!confirm('Are you ready to publish this service to the public registry?')) return;
    try {
        const response = await fetch(`/super_admin/services/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ status: 'active' })
        });
        const result = await response.json();
        if (result.success) {
            window.showNotify('success', 'Service is now LIVE!');
            setTimeout(() => location.reload(), 800);
        } else {
            window.showNotify('error', 'Publishing Failed.');
        }
    } catch (err) {
        window.showNotify('error', 'Comm Link Failure.');
    }
}

async function deleteServiceRecord(id) {
    if (!confirm('Are you sure you want to remove this service from the registry?')) return;
    try {
        const response = await fetch(`/super_admin/services/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        const result = await response.json();
        if (result.success) {
            window.showNotify('success', 'Service removed from registry.');
            setTimeout(() => location.reload(), 1000);
        } else {
            window.showNotify('error', 'Deletion Failed.');
        }
    } catch (err) {
        window.showNotify('error', 'Communication Failure.');
    }
}
</script>
@endsection
