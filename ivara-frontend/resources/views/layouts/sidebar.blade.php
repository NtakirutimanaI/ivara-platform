@php
    $user = auth()->user();
    $role = session('active_role', $user->role ?? 'user');
    $userCategory = session('user_category', $user->category ?? null);
    
    $sidebarConfig = config('sidebar.menus', []);
    $items = $sidebarConfig[$role] ?? $sidebarConfig['user'] ?? [];

    // Category Display Mapping (for label and base icon)
    $categoryMeta = [
        'technical-repair' => ['label' => 'Technical & Repair', 'icon' => 'fas fa-tools'],
        'creative-lifestyle' => ['label' => 'Creative & Lifestyle', 'icon' => 'fas fa-palette'],
        'transport-travel' => ['label' => 'Transport & Travel', 'icon' => 'fas fa-bus'],
        'food-fashion' => ['label' => 'Food & Fashion', 'icon' => 'fas fa-utensils'],
        'education-knowledge' => ['label' => 'Education & Knowledge', 'icon' => 'fas fa-graduation-cap'],
        'agriculture-environment' => ['label' => 'Agriculture & Environment', 'icon' => 'fas fa-leaf'],
        'media-entertainment' => ['label' => 'Media & Entertainment', 'icon' => 'fas fa-film'],
        'legal-professional' => ['label' => 'Legal & Professional', 'icon' => 'fas fa-gavel'],
        'other-services' => ['label' => 'Other Services', 'icon' => 'fas fa-ellipsis-h'],
    ];

    // INJECT CATEGORY MANAGEMENT FOR ADMIN/MANAGER/SUPERVISOR
    if (in_array($role, ['super_admin', 'admin', 'manager', 'supervisor']) && $userCategory && isset($categoryMeta[$userCategory])) {
        $meta = $categoryMeta[$userCategory];
        
        // Override Main Dashboard Link to point to Category Dashboard
        if (isset($items[0]['route']) && in_array($items[0]['route'], ['admin.index', 'manager.index', 'supervisor.index'])) {
            $prefix = 'admin';
            if ($role === 'manager') $prefix = 'manager';
            if ($role === 'supervisor') $prefix = 'supervisor';
            
            $items[0]['route'] = "{$prefix}.{$userCategory}.index";
            $items[0]['label'] = $meta['label'] . ' Dashboard';
            $items[0]['icon'] = $meta['icon'];
        }

        $categoryMenu = [
            ['label' => 'Category Management', 'icon' => $meta['icon'], 'dropdown' => true, 'items' => [
                // Dashboard link is now redundant in dropdown if we replaced the main one, but keeping it for completeness or removing it.
                // keeping it as "Overview" maybe? Or just keep as is.
                ['label' => 'Services', 'icon' => 'fas fa-concierge-bell', 'route' => "admin.{$userCategory}.services"],
                ['label' => 'Bookings', 'icon' => 'fas fa-calendar-check', 'route' => "admin.{$userCategory}.bookings"],
                ['label' => 'Providers', 'icon' => 'fas fa-users-cog', 'route' => "admin.{$userCategory}.providers"],
                ['label' => 'Products', 'icon' => 'fas fa-box', 'route' => "admin.{$userCategory}.products"],
                ['label' => 'Clients', 'icon' => 'fas fa-user-friends', 'route' => "admin.{$userCategory}.clients"],
                ['label' => 'Reports', 'icon' => 'fas fa-chart-line', 'route' => "admin.{$userCategory}.payments"],
                ['label' => 'Settings', 'icon' => 'fas fa-sliders-h', 'route' => "admin.{$userCategory}.settings"],
            ]]
        ];
        
        // Add to the top after the first item
        array_splice($items, 1, 0, $categoryMenu);
    }

    // Helper to check active state
    if (!function_exists('isSidebarItemActive')) {
        function isSidebarItemActive($item) {
            if (isset($item['route']) && request()->routeIs($item['route'])) {
                if (isset($item['params']) && !empty($item['params'])) {
                    foreach($item['params'] as $key => $val) {
                        if (request()->route($key) != $val) return false;
                    }
                }
                return true;
            }
            if (isset($item['items'])) {
                foreach ($item['items'] as $sub) {
                    if (isSidebarItemActive($sub)) return true;
                }
            }
            return false;
        }
    }
@endphp

<nav class="sidebar">
    <div class="sidebar-wrapper">
        <ul class="menu">
            @foreach($items as $item)
                @php $active = isSidebarItemActive($item) ? 'active' : ''; @endphp
                
                @if(isset($item['dropdown']) && $item['dropdown'] && isset($item['items']))
                    <li class="menu-item dropdown {{ $active }}">
                        <a href="#" class="menu-link has-arrow {{ $active }}">
                            <span class="icon-box"><i class="{{ $item['icon'] }}"></i></span>
                            <span class="label">{{ $item['label'] }}</span>
                            <i class="fas fa-chevron-right arrow-icon"></i>
                        </a>
                        <ul class="submenu">
                            @foreach($item['items'] as $sub)
                                @php $subActive = isSidebarItemActive($sub) ? 'active' : ''; @endphp
                                <li class="submenu-item">
                                    <a href="{{ route($sub['route'], $sub['params'] ?? []) }}" class="submenu-link {{ $subActive }}">
                                        <i class="{{ $sub['icon'] ?? 'fas fa-circle' }}"></i> {{ $sub['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="menu-item">
                        <a href="{{ route($item['route'], $item['params'] ?? []) }}" class="menu-link {{ $active }} {{ $loop->first && $role != 'user' ? 'btn-red-style' : '' }}">
                            <span class="icon-box"><i class="{{ $item['icon'] }}"></i></span>
                            <span class="label">{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

            <!-- Marketplace Links for everyone -->
            <li class="menu-item mt-4 pt-2 border-top">
                <small class="text-muted px-3 mb-2 d-block">Marketplace</small>
                <a href="{{ route('marketplace.index') }}" class="menu-link {{ request()->routeIs('marketplace.index') ? 'active' : '' }}">
                    <span class="icon-box"><i class="fas fa-store"></i></span>
                    <span class="label">Public Market</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="menu-item mt-auto pt-4">
                <form action="{{ route('logout') }}" method="POST" id="logout-form-sidebar" class="d-none">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="menu-link btn-logout">
                    <span class="icon-box"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="label">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<style>
    :root {
        --sidebar-width: 215px;
        --sidebar-bg: #0f172a;
        --sidebar-hover: #1e293b;
        --sidebar-text: #94a3b8;
        --primary-brand: #3b82f6; 
        --accent-red: #ef4444;
    }

    .sidebar { 
        width: var(--sidebar-width); 
        background: var(--sidebar-bg); 
        height: calc(100vh - 72px); 
        position: fixed; 
        left: 0; 
        top: 72px; 
        z-index: 1000; 
        transition: all 0.3s ease;
        border-right: 1px solid rgba(255,255,255,0.05);
        overflow: visible; /* Ensure flyouts aren't clipped */
    }

    .sidebar-wrapper { 
        height: 100%;
        overflow: visible; 
        padding: 20px 10px; 
    }


    .menu { 
        list-style: none; 
        padding: 0; 
        margin: 0; 
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .menu-item { margin-bottom: 2px; }
    
    .menu-link { 
        display: flex; 
        align-items: center; 
        color: var(--sidebar-text); 
        text-decoration: none; 
        padding: 10px 12px; 
        border-radius: 8px; 
        transition: all 0.2s ease; 
        font-size: 0.82rem; 
        font-weight: 500; 
    }

    .icon-box { 
        width: 24px; 
        margin-right: 12px; 
        font-size: 0.95rem; 
        display: flex; 
        justify-content: center;
        opacity: 0.8;
    }

    .label { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .arrow-icon { margin-left: auto; font-size: 0.65rem; transition: transform 0.3s; }

    .menu-link:hover { background: var(--sidebar-hover); color: #fff; }
    .menu-link.active { background: var(--primary-brand); color: #fff; }
    .menu-link.active .icon-box { opacity: 1; }

    /* Dropdown Flyout Logic */
    .menu-item.dropdown {
        position: relative;
    }

    .submenu { 
        display: none; 
        position: absolute;
        left: 100%;
        top: 0;
        width: 190px;
        background: var(--sidebar-bg);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        box-shadow: 10px 10px 30px rgba(0,0,0,0.5);
        padding: 8px;
        margin-left: 5px;
        z-index: 1001;
        backdrop-filter: blur(10px);
    }
    
    .menu-item.dropdown:hover > .submenu { 
        display: block; 
        animation: flyIn 0.2s ease-out;
    }

    @keyframes flyIn {
        from { opacity: 0; transform: translateX(10px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .menu-item.dropdown.active .arrow-icon { transform: rotate(0deg); color: #fff; }
    .menu-item.dropdown:hover .arrow-icon { transform: rotate(-90deg); }

    .submenu-item { margin-bottom: 2px; }
    
    .submenu-link {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-size: 0.82rem;
        border-radius: 8px;
        transition: 0.2s;
        white-space: nowrap;
    }
    .submenu-link i { font-size: 0.75rem; margin-right: 12px; opacity: 0.7; }
    .submenu-link:hover, .submenu-link.active { color: #fff; background: var(--sidebar-hover); }
    .submenu-link.active { background: var(--primary-brand); }


    /* Special Styles */
    .btn-red-style {
        background: var(--accent-red) !important;
        color: white !important;
        margin-bottom: 15px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    .btn-red-style:hover { background: #dc2626 !important; transform: translateY(-1px); }

    .btn-logout {
        color: #fca5a5 !important;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    .btn-logout:hover { background: var(--accent-red); color: white !important; }

    .border-top { border-top: 1px solid rgba(255,255,255,0.1) !important; }
</style>
