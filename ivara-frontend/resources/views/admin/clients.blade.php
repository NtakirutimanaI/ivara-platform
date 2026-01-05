@include('layouts.header')
@include('layouts.sidebar')

<div class="client-management-panel">
    {{-- Stats Bento Grid --}}
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
            <div class="stat-content">
                <span class="stat-label">Total Clients</span>
                <h2 class="stat-value">{{ $clients->total() }}</h2>
            </div>
            <div class="stat-trend"><i class="fas fa-arrow-up"></i> +5.4%</div>
        </div>
        <div class="stat-card success">
            <div class="stat-icon"><i class="fas fa-check-double"></i></div>
            <div class="stat-content">
                <span class="stat-label">Active Partners</span>
                <h2 class="stat-value">{{ \App\Models\Client::where('status', 'active')->count() }}</h2>
            </div>
        </div>
        <div class="stat-card warning">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-content">
                <span class="stat-label">Pending Approval</span>
                <h2 class="stat-value">{{ \App\Models\Client::where('status', 'pending')->count() }}</h2>
            </div>
        </div>
        <div class="stat-card info">
            <div class="stat-icon"><i class="fas fa-globe"></i></div>
            <div class="stat-content">
                <span class="stat-label">Service Cities</span>
                <h2 class="stat-value">{{ \App\Models\Client::distinct('city')->count() }}</h2>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search clients by name, email or city...">
        </div>
        
        <div class="action-buttons">
            <button class="btn-primary" onclick="openModal('addClientModal')">
                <i class="fas fa-plus"></i> Register New Client
            </button>
        </div>
    </div>

    {{-- Error/Success Alerts --}}
    @if(session('success'))
        <div class="premium-alert success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="premium-alert danger">{{ $error }}</div>
        @endforeach
    @endif

    {{-- Table Container --}}
    <div class="table-container">
        <table class="premium-table">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Client Profile</th>
                    <th>Contact Information</th>
                    <th>Location</th>
                    <th>Relationship</th>
                    <th>Member Since</th>
                    <th class="text-right">Manage</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($clients as $key => $client)
                <tr>
                    <td>{{ $clients->firstItem() + $key }}</td>
                    <td>
                        <div class="user-profile-cell">
                            <div class="user-avatar">{{ strtoupper(substr($client->name, 0, 1)) }}</div>
                            <div class="user-meta">
                                <span class="name">{{ $client->name }}</span>
                                <span class="status-indicator {{ $client->status == 'active' ? 'active' : 'inactive' }}">
                                    {{ ucfirst($client->status) }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="contact-info">
                            <span><i class="far fa-envelope"></i> {{ $client->email ?? 'N/A' }}</span>
                            <span><i class="fas fa-mobile-alt"></i> {{ $client->phone }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="location-info">
                            <span class="city">{{ $client->city ?? 'Central' }}</span>
                            <span class="country">{{ $client->country ?? 'Rwanda' }}</span>
                        </div>
                    </td>
                    <td>
                         <span class="badge-relationship {{ $client->status }}">Partner</span>
                    </td>
                    <td>{{ $client->created_at->format('M d, Y') }}</td>
                    <td class="text-right">
                        <div class="dropdown-actions">
                            <button class="btn-icon" onclick="toggleDropdown({{ $client->id }})">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div id="dropdown-{{ $client->id }}" class="dropdown-menu">
                                <a href="javascript:void(0)" onclick="viewClient({{ $client }})"><i class="far fa-eye"></i> Full Overview</a>
                                <a href="javascript:void(0)" onclick="editClient({{ $client }})"><i class="far fa-edit"></i> Edit Details</a>
                                @if($client->status == 'active')
                                    <form action="{{ route('admin.clients.deactivate', $client->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"><i class="fas fa-ban"></i> Suspend Partnership</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.clients.activate', $client->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-success"><i class="fas fa-check-circle"></i> Activate Partner</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.clients.delete', $client->id) }}" method="POST" class="delete-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-danger"><i class="far fa-trash-alt"></i> Terminate Account</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $clients->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- Modals --}}
@include('admin.clients_modals')

<style>
    :root {
        --primary: #924FC2;
        --success: #00C853;
        --warning: #FFAB00;
        --danger: #FF1744;
        --bg-panel: #f8f9fa;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --card-bg: #ffffff;
        --border-color: #e2e8f0;
    }

    /* Dark Mode Variables */
    body.dark-theme {
        --bg-panel: #0f172a !important;
        --text-primary: #f8fafc !important;
        --text-secondary: #cbd5e1 !important;
        --card-bg: rgba(30, 41, 59, 0.6) !important;
        --border-color: rgba(255, 255, 255, 0.1) !important;
    }

    body {
        background: var(--bg-panel) !important;
        color: var(--text-primary) !important;
        transition: background 0.3s, color 0.3s;
    }

    .client-management-panel {
        width: 80%;
        margin-left: 270px;
        padding: 40px 20px;
        margin-top: 20px;
    }

    /* Stats Bento Grid */
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
    .stat-card { 
        background: var(--card-bg); 
        border-radius: 20px; 
        padding: 25px; 
        display: flex; 
        align-items: center; 
        gap: 20px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        border: 1px solid var(--border-color);
    }
    .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .primary .stat-icon { background: rgba(146, 79, 194, 0.1); color: var(--primary); }
    .success .stat-icon { background: rgba(0, 200, 83, 0.1); color: var(--success); }
    .warning .stat-icon { background: rgba(255, 171, 0, 0.1); color: var(--warning); }
    .info .stat-icon { background: rgba(33, 150, 243, 0.1); color: #2196F3; }
    .stat-label { font-size: 13px; color: var(--text-secondary); font-weight: 600; }
    .stat-value { font-size: 28px; font-weight: 800; margin: 0; color: var(--text-primary); }

    /* Toolbar */
    .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .search-bar { 
        background: var(--card-bg); 
        border-radius: 12px; 
        height: 50px; 
        display: flex; 
        align-items: center; 
        padding: 0 20px; 
        gap: 12px; 
        width: 400px; 
        border: 1px solid var(--border-color); 
    }
    .search-bar input { 
        border: none; 
        outline: none; 
        width: 100%; 
        font-size: 14px; 
        background: transparent;
        color: var(--text-primary);
    }

    /* Table & Profiles */
    .table-container { 
        background: var(--card-bg); 
        border-radius: 20px; 
        overflow: hidden; 
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); 
        border: 1px solid var(--border-color);
    }
    .premium-table { width: 100%; border-collapse: collapse; }
    .premium-table th { 
        background: rgba(248, 250, 252, 0.5); 
        padding: 18px 25px; 
        font-size: 12px; 
        text-transform: uppercase; 
        color: var(--text-secondary); 
        text-align: left; 
    }
    .premium-table td { 
        padding: 15px 25px; 
        border-bottom: 1px solid var(--border-color); 
        color: var(--text-primary);
    }

    body.dark-theme .premium-table th {
        background: rgba(15, 23, 42, 0.6);
        color: var(--text-secondary);
    }

    body.dark-theme .premium-table td {
        color: var(--text-primary);
    }

    .user-profile-cell { display: flex; align-items: center; gap: 15px; }
    .user-avatar { 
        width: 45px; 
        height: 45px; 
        border-radius: 12px; 
        background: #f1f5f9; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-weight: 700; 
        color: var(--primary); 
    }
    .user-meta .name { display: block; font-weight: 700; color: var(--text-primary); }

    .contact-info, .location-info { 
        display: flex; 
        flex-direction: column; 
        font-size: 13px; 
        color: var(--text-secondary); 
    }
    .contact-info i { width: 20px; color: #94a3b8; }
    .location-info .city { font-weight: 600; color: var(--text-primary); }

    .status-indicator { font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
    .status-indicator.active { color: var(--success); }
    .status-indicator.inactive { color: #94a3b8; }

    .badge-relationship { padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }
    .badge-relationship.active { background: #dcfce7; color: #166534; }
    .badge-relationship.inactive { background: #f1f5f9; color: #475569; }

    /* Buttons & Dropdowns */
    .btn-primary { 
        background: var(--primary); 
        color: white; 
        border: none; 
        padding: 12px 24px; 
        border-radius: 12px; 
        font-weight: 700; 
        cursor: pointer; 
    }
    .dropdown-actions { position: relative; }
    .btn-icon { background: none; border: none; cursor: pointer; color: #94a3b8; font-size: 18px; }
    .dropdown-menu { 
        position: absolute; 
        right: 0; 
        top: 100%; 
        background: var(--card-bg); 
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); 
        border-radius: 12px; 
        padding: 8px; 
        z-index: 100; 
        min-width: 200px; 
        display: none;
        border: 1px solid var(--border-color);
    }
    .dropdown-menu a, .dropdown-menu button { 
        display: flex; 
        align-items: center; 
        gap: 10px; 
        padding: 10px 15px; 
        color: var(--text-primary); 
        text-decoration: none; 
        font-size: 13px; 
        font-weight: 500;
        border-radius: 8px; 
        width: 100%; 
        border: none; 
        background: none; 
        text-align: left;
    }
    .dropdown-menu a:hover, .dropdown-menu button:hover { 
        background: rgba(146, 79, 194, 0.1); 
        color: var(--primary); 
    }

    .premium-alert { padding: 15px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; }
    .premium-alert.success { background: #dcfce7; color: #166534; }
    .premium-alert.danger { background: #fee2e2; color: #991b1b; }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }
    .page-item { list-style: none; }
    .page-link {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 8px;
        background: var(--card-bg);
        color: var(--text-primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: 0.2s;
        border: 1px solid var(--border-color);
    }
    .page-item.active .page-link {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(146, 79, 194, 0.4);
    }
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .page-link:hover:not(.active) {
        background: rgba(146, 79, 194, 0.1);
        color: var(--primary);
    }
</style>

<script>
    function toggleDropdown(id) {
        const menu = document.getElementById('dropdown-' + id);
        const isOpen = menu.style.display === 'block';
        document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
        if (!isOpen) menu.style.display = 'block';
    }

    window.onclick = function(event) {
        if (!event.target.matches('.btn-icon, .btn-icon *')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
        }
    }

    // Client action triggers
    function viewClient(client) {
        document.getElementById('view_name').innerText = client.name;
        document.getElementById('view_phone').innerText = client.phone;
        document.getElementById('view_email').innerText = client.email || 'N/A';
        document.getElementById('view_city').innerText = client.city || 'N/A';
        document.getElementById('view_country').innerText = client.country || 'N/A';
        document.getElementById('view_status').innerText = client.status;
        openModal('viewClientModal');
    }

    function editClient(client) {
        document.getElementById('edit_name').value = client.name;
        document.getElementById('edit_phone').value = client.phone;
        document.getElementById('edit_email').value = client.email || '';
        document.getElementById('edit_city').value = client.city || '';
        document.getElementById('edit_status').value = client.status;
        document.getElementById('editClientForm').action = "/admin/clients/update/" + client.id;
        openModal('editClientModal');
    }

    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

@include('layouts.footer')