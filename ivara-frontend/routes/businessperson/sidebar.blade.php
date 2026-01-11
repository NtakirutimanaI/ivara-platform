<!-- Hamburger Toggle Button -->
<button id="adminSidebarToggle" class="admin-sidebar-toggle-btn">
    ☰
</button>

<aside class="admin-sidebar" id="adminSidebar">
    <nav class="admin-menu">
        <a href="#" class="admin-menu-item active">
            <i class="fa fa-dashboard"></i>
            <span class="admin-label">Dashboard</span>
        </a>
        <a href="{{ url('technician/register_repair') }}" class="admin-menu-item">
            <i class="fa fa-tools"></i>
            <span class="admin-label">Register & Repair</span>
        </a>
        <a href="/clients" class="admin-menu-item">
            <i class="fa fa-user"></i>
            <span class="admin-label">Clients</span>
        </a>
         <a href="/businessperson/meetings" class="admin-menu-item">
            <i class="fa fa-calendar-alt"></i>
            <span class="admin-label">Meetings</span>
        </a>
        <a href="/stock" class="admin-menu-item">
            <i class="fa fa-boxes"></i>
            <span class="admin-label">Stock Management</span>
        </a>
        <a href="/transactions" class="admin-menu-item">
            <i class="fa fa-file-invoice-dollar"></i>
            <span class="admin-label">Invoices & Transactions</span>
        </a>
        <a href="/bookings" class="admin-menu-item">
            <i class="fa fa-calendar-check"></i>
            <span class="admin-label">Bookings & Services</span>
        </a>
        <a href="/learning" class="admin-menu-item">
            <i class="fa fa-graduation-cap"></i>
            <span class="admin-label">Online Learning</span>
        </a>
        <a href="/notifications" class="admin-menu-item">
            <i class="fa fa-bell"></i>
            <span class="admin-label">Notifications / SMS</span>
        </a>
        <a href="/connections" class="admin-menu-item">
            <i class="fa fa-network-wired"></i>
            <span class="admin-label">Connections</span>
        </a>
        <a href="/reports" class="admin-menu-item">
            <i class="fa fa-trophy"></i>
            <span class="admin-label">Reports & Analytics</span>
        </a>

        @if(auth()->user()->role !== 'mediator')
        <a href="{{ route(strtolower(auth()->user()->role) . '.switch-account') }}" class="admin-menu-item">
            <i class="fa fa-exchange"></i>
            <span class="admin-label">Switch Account</span>
        </a>
        @endif

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="admin-menu-item bg-transparent border-0 text-left w-full">
                <i class="fas fa-sign-out-alt"></i>
                <span class="admin-label">Logout</span>
            </button>
        </form>
    </nav>
</aside>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Styles -->
<style>
.admin-sidebar {
    width: 80px;
    background: #0A1128;
    position: fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: width 0.3s ease;
    overflow-x: hidden;
    z-index: 1000;
    top: 80px;
    left: 0; /* 👈 Fix sidebar to the left */
    height: 525px;
    margin-left: 0px;
}

.admin-sidebar-toggle-btn {
    position: fixed;
    top: 105px;
    left: 90px; /* 👈 Adjusted so it's outside collapsed sidebar */
    z-index: 1100;
    font-size: 26px;
    background: #0A1128;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    display: none;
}

.admin-sidebar:hover {
    width: 250px;
}

.admin-menu {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-top: 20px;
}

.admin-menu-item {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    color: #ffff;
    text-decoration: none;
    transition: background 0.3s, color 0.3s;
    position: relative;
    background: none;
    border: none;
}

.admin-menu-item i.fa,
.admin-menu-item i.fas {
    font-size: 18px;
    margin-left: 0px;
    color: #924FC2;
    width: 24px;
    text-align: center;
}

.admin-menu-item .admin-label {
    margin-left: 20px;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.3s, margin-left 0.3s;
    color: #ffff;
}

.admin-sidebar:hover .admin-menu-item .admin-label {
    opacity: 1;
}

.admin-menu-item.active {
    background-color: #00c060;
    color: white;
}

.admin-menu-item.active i.fa,
.admin-menu-item.active .admin-label {
    color: white;
}

.admin-menu-item:hover {
    background: #ebe9ff;
    color: #4f46e5;
}

.admin-menu-item:hover i.fa,
.admin-menu-item:hover .admin-label {
    color: #4f46e5;
}

/* Hamburger button */

/* Mobile responsive sidebar */
@media (max-width: 768px) {
    .admin-sidebar {
        transform: translateX(-100%);
        width: 250px;
        transition: transform 0.3s ease;
    }

    .admin-sidebar.show {
        transform: translateX(0);
    }

    .admin-sidebar-toggle-btn {
        display: block;
    }
}
</style>

<!-- JS Toggle Script -->
<script>
document.getElementById('adminSidebarToggle').addEventListener('click', function () {
    document.getElementById('adminSidebar').classList.toggle('show');
});
</script>
