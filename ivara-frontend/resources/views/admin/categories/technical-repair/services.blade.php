@extends('layouts.app')

@section('title', 'Service Management - Technical & Repair')

@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->
    <header class="pro-header">
        <div>
            <h1>Service Registry</h1>
            <p>Define and manage the professional services offered in the Technical & Repair category</p>
        </div>
        <div class="d-flex gap-3 align-items-center">
            <div class="header-stats d-none d-md-flex me-3">
                <div class="stat-pill">
                    <span class="label">Total Services:</span>
                    <span class="value">{{ count($services) }}</span>
                </div>
            </div>
            <a href="{{ route('admin.technical-repair.services.create') }}" class="action-btn btn-primary">
                <i class="fas fa-plus"></i> Create New Service
            </a>
        </div>
    </header>

    <!-- Modernized Filters & Search Bar -->
    <div class="pro-card glass-panel mb-4 animate-up delay-1">
        <div class="card-body p-2">
            <form action="{{ route('admin.technical-repair.services') }}" method="GET" class="d-flex align-items-center flex-row flex-nowrap gap-2">
                <div class="flex-grow-1 min-w-0">
                    <div class="premium-search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" class="pro-input ps-5" 
                               placeholder="Search services..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="flex-shrink-0" style="width: 180px;">
                    <div class="select-wrapper">
                        <i class="fas fa-filter select-icon"></i>
                        <select name="status" class="pro-input ps-5">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="flex-shrink-0" style="width: 150px;">
                    <div class="select-wrapper">
                        <i class="fas fa-list-numeric select-icon"></i>
                        <select name="limit" class="pro-input ps-5" onchange="this.form.submit()">
                            <option value="5" {{ request('limit') == '5' ? 'selected' : '' }}>5 Per Page</option>
                            <option value="10" {{ request('limit') == '10' ? 'selected' : '' || !request('limit') }}>10 Per Page</option>
                            <option value="15" {{ request('limit') == '15' ? 'selected' : '' }}>15 Per Page</option>
                        </select>
                    </div>
                </div>
                <div class="flex-shrink-0" style="width: 110px;">
                    <button type="submit" class="action-btn btn-primary w-100 justify-content-center">
                        <i class="fas fa-sync-alt"></i> Filter
                    </button>
                </div>
                <div class="flex-shrink-0 text-center" style="width: 80px;">
                    <div class="results-badge">
                        <span class="count">{{ $pagination->total ?? count($services) }}</span>
                        <span class="label">Total</span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="pro-card glass-panel animate-up delay-2">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <h3><i class="fas fa-list-ul text-primary"></i> Service List</h3>
            <div class="dropdown">
                <button class="icon-btn" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu shadow border-0">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-export me-2"></i> Export CSV</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i> Print List</a></li>
                </ul>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Service Information</th>
                        <th>Base Price (FRW)</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $index => $item)
                    <tr class="animate-up" style="animation-delay: {{ 0.2 + ($index * 0.05) }}s">
                        <td class="fw-800 text-dark" style="vertical-align: middle; width: 100px;">
                            #SR-{{ substr($item->_id ?? $item->id, -4) }}
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="d-flex align-items-center flex-row flex-nowrap" style="min-width: 300px;">
                                <div class="service-icon-sm me-3 flex-shrink-0" style="background: rgba(59, 130, 246, 0.1); color: var(--primary); width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                                    <i class="fas fa-tools"></i>
                                </div>
                                <div class="service-details flex-grow-1">
                                    <div class="fw-bold text-dark fs-6 text-nowrap" style="line-height: 1.2;">{{ $item->name }}</div>
                                    <div class="text-muted small" style="line-height: 1.3;">{{ substr($item->description ?? 'Professional service', 0, 100) }}...</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-nowrap" style="vertical-align: middle; width: 140px;">
                            <div class="price-display p-2 rounded-3 text-center" style="background: rgba(0,0,0,0.02); display: inline-block; min-width: 100px; border: 1px solid rgba(0,0,0,0.05);">
                                <span class="fw-bold text-dark fs-6">
                                    {{ number_format($item->price ?? 0) }}
                                </span>
                            </div>
                        </td>
                        <td class="text-nowrap" style="vertical-align: middle; width: 120px;">
                            @php $status = $item->status ?? 'active'; @endphp
                            <span class="status-badge {{ $status == 'active' ? 'status-available' : 'status-unavailable' }}">
                                <i class="fas {{ $status == 'active' ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="text-end" style="width: 120px; vertical-align: middle;">
                            <div class="d-flex justify-content-end align-items-center gap-2 flex-row flex-nowrap">
                                <a href="{{ route('admin.technical-repair.services.edit', $item->_id ?? $item->id) }}" class="icon-btn flex-shrink-0" title="Edit Service" style="background: rgba(59, 130, 246, 0.05); border-color: rgba(59, 130, 246, 0.1);">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                <form action="{{ route('admin.technical-repair.services.destroy', $item->_id ?? $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service registry?')" class="m-0 p-0 d-inline-block flex-shrink-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn" title="Delete Service" style="background: rgba(239, 68, 68, 0.05); border-color: rgba(239, 68, 68, 0.1);">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="empty-state animate-up">
                                <div class="empty-icon mb-4" style="font-size: 4rem; color: var(--text-muted); opacity: 0.3;">
                                    <i class="fas fa-concierge-bell"></i>
                                </div>
                                <h4 class="text-dark fw-bold">Registry is Empty</h4>
                                <p class="text-muted mb-4">You haven't added any services to the Technical & Repair catalog yet.</p>
                                <a href="{{ route('admin.technical-repair.services.create') }}" class="action-btn btn-primary px-5 py-3">
                                    <i class="fas fa-plus"></i> Initialize Registry
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pagination && $pagination->totalPages > 1)
        <div class="card-footer bg-transparent py-3 border-top border-light">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center m-0 gap-2">
                    {{-- Previous Page --}}
                    @if($pagination->page > 1)
                        <li class="page-item">
                            <a class="page-link glass-panel" href="{{ request()->fullUrlWithQuery(['page' => $pagination->page - 1]) }}" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @for($i = 1; $i <= $pagination->totalPages; $i++)
                        <li class="page-item {{ $pagination->page == $i ? 'active' : '' }}">
                            <a class="page-link glass-panel {{ $pagination->page == $i ? 'bg-primary text-white border-primary' : '' }}" 
                               href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next Page --}}
                    @if($pagination->page < $pagination->totalPages)
                        <li class="page-item">
                            <a class="page-link glass-panel" href="{{ request()->fullUrlWithQuery(['page' => $pagination->page + 1]) }}" aria-label="Next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>

<style>
    .premium-search-container, .select-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    .search-icon, .select-icon {
        position: absolute;
        left: 15px;
        color: var(--primary);
        font-size: 1rem;
        z-index: 10;
        pointer-events: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
    }
    .premium-search-container .pro-input, 
    .select-wrapper .pro-input {
        padding-left: 45px !important;
    }
    .results-badge {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
        padding-left: 15px;
        border-left: 1px solid var(--glass-border);
        white-space: nowrap;
    }
    .results-badge .count {
        font-size: 1.2rem;
        font-weight: 900;
        color: var(--primary);
    }
    .results-badge .label {
        font-size: 0.65rem;
        text-transform: uppercase;
        font-weight: 800;
        color: var(--secondary);
        letter-spacing: 0.5px;
    }
    .pro-input::placeholder {
        color: var(--text-muted);
        opacity: 0.6;
    }
    /* Hover effects for filters */
    .premium-search-container:focus-within .search-icon {
        transform: scale(1.2);
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    /* Pagination Styles */
    .pagination .page-link {
        border-radius: 10px !important;
        padding: 8px 16px;
        font-weight: 600;
        color: var(--secondary);
        transition: all 0.3s ease;
        border: 1px solid var(--glass-border);
    }
    .pagination .page-item.active .page-link {
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    .pagination .page-link:hover {
        transform: translateY(-2px);
        background: white;
        color: var(--primary);
        border-color: var(--primary);
    }
</style>
@endsection
