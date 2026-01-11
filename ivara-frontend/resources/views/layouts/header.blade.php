@php
    // Fetch Portfolio Data for Mega Menu (Dynamic)
    $portfolioMenu = [];
    try {
        $pfResponse = \Illuminate\Support\Facades\Http::get('http://localhost:5001/api/portfolio');
        if($pfResponse->successful()) {
            $portfolioMenu = $pfResponse->json();
        }
    } catch(\Exception $e){}
@endphp
@if(Auth::check() && !Route::is('index') && !Route::is('home') && !Route::is('aboutus') && !Route::is('support') && !Route::is('products') && !Route::is('team') && !Route::is('privacy_policy') && !Route::is('terms'))
    {{-- Unified Dashboard Header (Premium Pro System v4.0) --}}
    <header class="topbar">
        {{-- Left: Brand & Search --}}
        <div class="topbar-left" style="flex: 1; display: flex; align-items: center; gap: 20px;">
            <a href="{{ route('dashboard') }}" class="topbar-logo" style="flex-shrink: 0;">
                <img src="{{ asset('images/logo.jpg') }}" alt="IVARA">
            </a>
            
            {{-- Mega Search (Wide & Global) --}}
            <div class="mega-search-container" style="width: 100%; max-width: 500px;">
                <div class="mega-search" style="width: 100%;">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search everywhere..." class="search-input" id="globalSearch" style="width: 100%;">
                    <span class="search-kdb">/</span>
                </div>
                <div class="search-results" id="searchResults"></div>
            </div>
        </div>

        {{-- Right: Actions & Profile --}}
        <div class="topbar-right">
            {{-- Quick Create (+) Moved Here --}}
            <div class="dropdown-wrapper">
                <button class="icon-btn plus-btn" id="plusDropdownBtn" title="Quick Actions" style="width: 35px; height: 35px; border-radius: 50%;">
                    <i class="fas fa-plus"></i>
                </button>
                <div class="dropdown-menu" id="plusDropdownContent" style="margin-top: 10px;">
                    <div class="dropdown-header"><span>Quick Actions</span></div>
                    <a href="{{ route('manager.create_products.index') }}" class="dropdown-item"><i class="fas fa-box"></i> New Product</a>
                    <a href="{{ route('manager.clients.index') }}" class="dropdown-item"><i class="fas fa-user-plus"></i> New Client</a>
                    <a href="{{ route('manager.devices.index') }}" class="dropdown-item"><i class="fas fa-tools"></i> New Repair</a>
                </div>
            </div>

            {{-- Dark Mode Toggle --}}
            <button class="icon-btn theme-toggle" id="themeToggle" title="Toggle Theme">
                <i class="fas fa-moon moon-icon"></i>
                <i class="fas fa-sun sun-icon" style="display:none; color: #924FC2;"></i>
            </button>
            
            {{-- ... other icons ... --}}

            {{-- Orders Icon --}}
            <a href="{{ route('orders.index') }}" class="icon-btn" title="Orders">
                <i class="fas fa-shopping-bag"></i>
                <span class="badge" id="authOrderCount" style="display:none;">0</span>
            </a>

            {{-- Cart Icon --}}
            <a href="{{ route('cart.index') }}" class="icon-btn" title="Cart">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge" id="authCartCount" style="display:none;">0</span>
            </a>

            {{-- Inbox Messages --}}
            <div class="dropdown-wrapper">
                <button class="icon-btn" id="msgDropdownBtn" title="Messages">
                    <i class="fas fa-envelope"></i>
                    <span class="badge"></span>
                </button>
                <div class="dropdown-menu" id="msgDropdownContent">
                    <div class="dropdown-header">
                        <span>Messages</span>
                        <a href="#">View All</a>
                    </div>
                    <div class="dropdown-body empty-state">
                        <i class="fas fa-envelope-open"></i>
                        <p>No new messages</p>
                    </div>
                </div>
            </div>

            {{-- Notifications --}}
            <div class="dropdown-wrapper">
                <button class="icon-btn" id="notifDropdownBtn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                <div class="dropdown-menu" id="notifDropdownContent">
                    <div class="dropdown-header">
                        <span>Notifications</span>
                        <a href="{{ route('notifications.index') }}">View All</a>
                    </div>
                    <div class="notif-item unread">
                        <div class="notif-icon bg-soft-primary"><i class="fas fa-info-circle"></i></div>
                        <div class="notif-text">
                            <strong>System Update</strong>
                            <p>Version 4.0 is now live!</p>
                            <small>Just now</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Languages --}}
            <div class="dropdown-wrapper">
                <button class="icon-btn" id="langDropdownBtn" title="Language">
                    <i class="fas fa-globe"></i>
                </button>
                <div class="dropdown-menu lang-dropdown" id="langDropdownContent" style="width: 200px;">
                    <div class="dropdown-header"><span>Select Language</span></div>
                    <div class="p-3">
                        @include('components.language-selector', ['mode' => 'list'])
                    </div>
                </div>
            </div>

            <div class="v-divider"></div>

            {{-- User Profile --}}
            <div class="dropdown-wrapper">
                <div class="profile-trigger" id="profileDropdownBtn">
                    <div class="role-avatar-box">
                        <span class="role-initial">{{ strtoupper(substr(auth()->user()->role, 0, 1)) }}</span>
                        <div class="avatar-img-wrap">
                            @php
                                $profilePhoto = Auth::user()->profile_photo;
                                if ($profilePhoto && !str_starts_with($profilePhoto, 'http')) {
                                    $backendUrl = rtrim(env('BACKEND_API_URL', 'http://localhost:5001'), '/');
                                    if (str_ends_with($backendUrl, '/api')) { $backendUrl = substr($backendUrl, 0, -4); }
                                    $profilePhoto = $backendUrl . '/' . ltrim($profilePhoto, '/');
                                }
                            @endphp
                            @if($profilePhoto)
                                <img src="{{ $profilePhoto }}" alt="Avatar">
                            @endif
                        </div>
                    </div>
                    <i class="fas fa-chevron-down u-arrow" style="margin-left: 5px;"></i>
                </div>
                
                <div class="dropdown-menu" id="profileDropdownContent" style="right: 0; min-width: 200px;">
                    <a href="{{ route('profile.show') }}" class="dropdown-item"><i class="fas fa-user-circle"></i> Profile</a>
                    <a href="{{ route('admin.settings') }}" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                    <div class="menu-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Dropdown Logic ---
            const triggers = [
                { btn: 'plusDropdownBtn', content: 'plusDropdownContent' },
                { btn: 'msgDropdownBtn', content: 'msgDropdownContent' },
                { btn: 'notifDropdownBtn', content: 'notifDropdownContent' },
                { btn: 'langDropdownBtn', content: 'langDropdownContent' },
                { btn: 'profileDropdownBtn', content: 'profileDropdownContent' }
            ];

            triggers.forEach(t => {
                const button = document.getElementById(t.btn);
                const menu = document.getElementById(t.content);

                if(button && menu) {
                    button.addEventListener('click', (e) => {
                        e.stopPropagation();
                        // Close others
                        triggers.forEach(other => {
                            if(other.btn !== t.btn) {
                                const el = document.getElementById(other.content);
                                if(el) el.classList.remove('show');
                            }
                        });
                        menu.classList.toggle('show');
                    });
                }
            });

            // Close all on click outside
            window.addEventListener('click', () => {
                triggers.forEach(t => {
                    const el = document.getElementById(t.content);
                    if(el) el.classList.remove('show');
                });
            });

            // --- Dark Mode Logic ---
            const themeBtn = document.getElementById('themeToggle');
            const currentTheme = localStorage.getItem('theme');
            const root = document.documentElement;

            // Apply saved theme immediately
            if(currentTheme === 'dark') {
                root.setAttribute('data-theme', 'dark');
            }

            if(themeBtn) {
                const moonIcon = themeBtn.querySelector('.moon-icon');
                const sunIcon = themeBtn.querySelector('.sun-icon');

                const updateIcons = (isDark) => {
                    if (moonIcon && sunIcon) {
                        moonIcon.style.display = isDark ? 'none' : 'block';
                        sunIcon.style.display = isDark ? 'block' : 'none';
                    }
                };

                updateIcons(currentTheme === 'dark');

                themeBtn.addEventListener('click', () => {
                    if (root.getAttribute('data-theme') === 'dark') {
                        root.removeAttribute('data-theme');
                        localStorage.setItem('theme', 'light');
                        updateIcons(false);
                    } else {
                        root.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                        updateIcons(true);
                    }
                });
            }

            // --- Global Search Shortcut ---
            document.addEventListener('keydown', (e) => {
                if(e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
                    e.preventDefault();
                    const searchBox = document.getElementById('globalSearch');
                    if(searchBox) searchBox.focus();
                }
            });

            // --- Fetch Order Count ---
            @auth
            const userId = '{{ auth()->id() }}';
            if (userId) {
                fetch('{{ rtrim(env("BACKEND_API_URL", "http://localhost:5001"), "/") }}/api/orders/buyer/' + userId)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.pagination) {
                            const orderCount = data.pagination.total;
                            const orderBadge = document.getElementById('authOrderCount');
                            if (orderCount > 0 && orderBadge) {
                                orderBadge.textContent = orderCount;
                                orderBadge.style.display = 'block';
                            }
                        }
                    })
                    .catch(err => console.error('Failed to fetch order count:', err));

                // Fetch Cart Count
                fetch('{{ rtrim(env("BACKEND_API_URL", "http://localhost:5001"), "/") }}/api/cart/' + userId)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.data) {
                            // Sum quantities for total items count, or just use items.length
                            const items = data.data.items || [];
                            const cartCount = items.reduce((sum, item) => sum + (item.quantity || 1), 0);
                            
                            const cartBadge = document.getElementById('authCartCount');
                            if (cartCount > 0 && cartBadge) {
                                cartBadge.textContent = cartCount;
                                cartBadge.style.display = 'flex';
                                cartBadge.style.alignItems = 'center';
                                cartBadge.style.justifyContent = 'center';
                            }
                        }
                    })
                    .catch(err => console.error('Failed to fetch cart count:', err));

                // --- Fetch Notifications (Internal) ---
                fetch('/api/header/notifications', {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                    const notifBadge = document.querySelector('#notifDropdownBtn .badge');
                    const notifContent = document.getElementById('notifDropdownContent');

                    if (data.unread_count > 0 && notifBadge) {
                        notifBadge.textContent = data.unread_count;
                        notifBadge.style.display = 'flex';
                    } else if (notifBadge) {
                        notifBadge.style.display = 'none';
                    }

                    if (data.latest && data.latest.length > 0 && notifContent) {
                        // Preserve header
                        const header = notifContent.querySelector('.dropdown-header');
                        notifContent.innerHTML = '';
                        if (header) notifContent.appendChild(header);

                        data.latest.forEach(n => {
                            const item = document.createElement('div');
                            item.className = 'notif-item ' + (n.is_read ? '' : 'unread');
                            const time = new Date(n.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                            item.innerHTML = `
                                <div class="notif-icon bg-soft-primary"><i class="fas fa-info-circle"></i></div>
                                <div class="notif-text">
                                    <strong>${n.type || 'Notification'}</strong>
                                    <p>${n.message}</p>
                                    <small>${time}</small>
                                </div>
                            `;
                            notifContent.appendChild(item);
                        });
                    }
                })
                .catch(err => console.error('Failed to fetch notifications:', err));

                // --- Fetch Messages (Internal) ---
                fetch('/api/header/messages', {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(data => {
                     const msgBadge = document.querySelector('#msgDropdownBtn .badge');
                     if (data.unread_count > 0 && msgBadge) {
                        msgBadge.textContent = data.unread_count;
                        msgBadge.style.display = 'flex';
                     } else if (msgBadge) {
                        msgBadge.style.display = 'none';
                     }
                })
                .catch(err => console.error('Failed to fetch messages:', err));
            }
            @endauth
        });
    </script>
@else
    {{-- High-End Public Web Header --}}
    <header class="web-header-premium">
        <div class="iv-header-container">
            <a href="{{ route('home') }}" class="iv-header-logo">
                <img src="{{asset('images/logo.jpg')}}" alt="IVARA Logo">
                <span class="logo-text">IVARA</span>
            </a>

            <nav class="iv-main-nav">
                <div class="nav-item-dropdown">
                    <a href="#" class="nav-link-toggle" id="solutionsToggle">
                        Solutions <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
                    </a>
                </div>
                <a href="{{ (Route::is('home') || Route::is('index')) ? '#why' : route('home') . '#why' }}">{{ __("messages.why_ivara") }}</a>
                <a href="{{ (Route::is('home') || Route::is('index')) ? '#services' : route('home') . '#services' }}">{{ __("messages.services") }}</a>
                <div class="nav-item-dropdown marketplace-trigger">
                    <a href="{{ route('market.category', 'all') }}" class="nav-link-toggle" id="marketplaceToggle">
                        Marketplace <span class="badge-new">NEW</span>
                    </a>
                    
                    {{-- NEW MARKETPLACE MEGA MENU (Yo!Kart Style) --}}
                    <div class="market-mega-menu">
                        <div class="market-menu-header">
                            <div class="market-logo">
                                <img src="{{ asset('images/logo.jpg') }}" alt="IVARA">
                                <span>IVARA</span>
                            </div>
                            <a href="{{ route('home') }}" class="btn-back-home"><i class="fas fa-undo"></i> Back to Home</a>
                        </div>
                        
                        {{-- VIEW 1: MAIN FEATURED --}}
                        {{-- MAIN FEATURED CONTENT (Always Visible underneath) --}}
                        <div id="marketMainContent">
                            <h3 class="market-main-title">{{ __("messages.explore_marketplaces") }}</h3>
                            
                            <div class="market-switch-container">
                                <a href="{{ route('marketplace.index') }}" class="market-switch active" style="text-decoration: none; color: white;">{{ __("messages.public_market") }}</a>
                                <a href="{{ route('b2b.index') }}" class="market-switch" style="text-decoration: none; color: #0A1128 !important;">{{ __("messages.b2b_wholesale") }}</a>
                            </div>
                            
                            <div class="market-grid">
                                <a href="{{ route('market.category', 'technical') }}" class="market-card">
                                    <div class="m-card-img technical-bg"><i class="fas fa-tools"></i></div>
                                    <div class="m-card-btn">{{ __("messages.technical_repair") }}</div>
                                </a>
                                <a href="{{ route('market.category', 'fashion') }}" class="market-card">
                                    <div class="m-card-img fashion-bg"><i class="fas fa-tshirt"></i></div>
                                    <div class="m-card-btn">{{ __("messages.food_fashion") }}</div>
                                </a>
                                <a href="{{ route('market.category', 'transport') }}" class="market-card">
                                    <div class="m-card-img transport-bg"><i class="fas fa-truck"></i></div>
                                    <div class="m-card-btn">{{ __("messages.transport_travel") }}</div>
                                </a>
                                <a href="{{ route('market.category', 'education') }}" class="market-card">
                                    <div class="m-card-img education-bg"><i class="fas fa-graduation-cap"></i></div>
                                    <div class="m-card-btn">{{ __("messages.education_knowledge") }}</div>
                                </a>
                            </div>
                            
                            <div style="text-align: center; margin-top: 15px;">
                                <button type="button" id="btnShowAllMarkets" class="view-all-markets" style="background:transparent; border:none; border-bottom: 2px solid #000; color: #000; font-weight: 800; cursor:pointer;">View All 9 Categories <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>

                        {{-- VIEW 2: MODAL OVERLAY (Initially Hidden) --}}
                        <div id="marketAllModal" class="market-all-modal-overlay">
                            <div class="market-all-modal-content">
                                {{-- Header inside Modal as requested --}}
                                <div class="market-menu-header" style="margin-bottom: 20px;">
                                    <div class="market-logo">
                                        <img src="{{ asset('images/logo.jpg') }}" alt="IVARA">
                                        <span>IVARA</span>
                                    </div>
                                    <a href="{{ route('home') }}" class="btn-back-home"><i class="fas fa-undo"></i> Back to Home</a>
                                </div>
                                <button type="button" id="btnCloseAllModal" class="btn-close-modal"><i class="fas fa-times"></i></button>

                                <h3 class="market-main-title" style="text-align: left; font-size: 1.3rem; margin-bottom: 15px;">{{ __("messages.all_categories") }}</h3>
                                
                                <div class="all-markets-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                                    <a href="{{ route('market.category', 'technical') }}" class="mini-market-item"><i class="fas fa-tools"></i> Technical & Repair</a>
                                    <a href="{{ route('market.category', 'fashion') }}" class="mini-market-item"><i class="fas fa-tshirt"></i> Food & Fashion</a>
                                    <a href="{{ route('market.category', 'transport') }}" class="mini-market-item"><i class="fas fa-truck"></i> Transport & Travel</a>
                                    <a href="{{ route('market.category', 'education') }}" class="mini-market-item"><i class="fas fa-graduation-cap"></i> Knowledge</a>
                                    <a href="{{ route('market.category', 'agriculture') }}" class="mini-market-item"><i class="fas fa-leaf"></i> Agriculture</a>
                                    <a href="{{ route('market.category', 'creative') }}" class="mini-market-item"><i class="fas fa-palette"></i> Creative</a>
                                    <a href="{{ route('market.category', 'media') }}" class="mini-market-item"><i class="fas fa-film"></i> Media</a>
                                    <a href="{{ route('market.category', 'legal') }}" class="mini-market-item"><i class="fas fa-balance-scale"></i> Legal</a>
                                    <a href="{{ route('market.category', 'other') }}" class="mini-market-item"><i class="fas fa-ellipsis-h"></i> Other</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ (Route::is('home') || Route::is('index')) ? '#pricing' : route('home') . '#pricing' }}">{{ __("messages.pricing") }}</a>
                


                <div class="nav-item-dropdown">
                    <a href="#" class="nav-link-toggle" id="portfolioToggle">
                        Portfolio <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
                    </a>
                </div>
                
                <div class="nav-item-dropdown">
                    <a href="#" class="nav-link-toggle" id="resourcesToggle">
                        Resources <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
                    </a>
                </div>

                <div class="nav-item-dropdown">
                    <a href="#" class="nav-link-toggle" id="supportToggle">
                        Support <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
                    </a>
                </div>
            </nav>

            <div class="auth-actions" style="display: flex; align-items: center; gap: 15px;">
                @include('components.language-selector')

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-dashboard">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="link-signin">{{ __('messages.sign_in') }}</a>
                    {{-- Get Started Button Removed --}}
                @endauth
            </div>
        </div>

        {{-- SOLUTIONS MEGA MENU --}}
        <div class="iv-mega-menu" id="megaMenu">
            <div class="iv-mega-content-wrapper">
                {{-- Column 1: Essential Services --}}
                <div class="iv-mega-col feature-col">
                    <h4 class="mega-title">Essential Services</h4>
                    
                    <a href="{{ route('solutions.technical') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-tools"></i></div>
                        <div>
                            <strong>{{ __("messages.technical_repair") }}</strong>
                            <p>Device repairs & maintenance services</p>
                        </div>
                    </a>

                    <a href="{{ route('solutions.transport') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-truck"></i></div>
                        <div>
                            <strong>{{ __("messages.transport_travel") }}</strong>
                            <p>Logistics, ride-hailing & travel</p>
                        </div>
                    </a>

                    <a href="{{ route('solutions.agriculture') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-leaf"></i></div>
                        <div>
                            <strong>Agriculture & Enviro</strong>
                            <p>Farming supplies & eco-solutions</p>
                        </div>
                    </a>
                </div>

                {{-- Column 2: Lifestyle & Growth --}}
                <div class="iv-mega-col feature-col">
                    <h4 class="mega-title">Lifestyle & Growth</h4>
                    
                    <a href="{{ route('solutions.fashion') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-tshirt"></i></div>
                        <div>
                            <strong>{{ __("messages.food_fashion") }}</strong>
                            <p>Restaurants, boutiques & tailors</p>
                        </div>
                    </a>

                    <a href="{{ route('solutions.creative') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-palette"></i></div>
                        <div>
                            <strong>Creative & Lifestyle</strong>
                            <p>Art, design & wellness services</p>
                        </div>
                    </a>

                    <a href="{{ route('solutions.education') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div>
                            <strong>Education & Knowledge</strong>
                            <p>Tutoring, courses & training</p>
                        </div>
                    </a>
                </div>

                {{-- Column 3: Professional & Other --}}
                <div class="iv-mega-col feature-col">
                    <h4 class="mega-title">Professional & Other</h4>
                    
                    <a href="{{ route('solutions.media') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-film"></i></div>
                        <div>
                            <strong>Media & Entertainment</strong>
                            <p>Events, streaming & content</p>
                        </div>
                    </a>

                    <a href="{{ route('solutions.legal') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-balance-scale"></i></div>
                        <div>
                            <strong>Legal & Professional</strong>
                            <p>Consultancy, legal & business</p>
                        </div>
                    </a>

                    <a href="{{ route('solutions.other') }}" class="feature-item">
                        <div class="f-icon"><i class="fas fa-ellipsis-h"></i></div>
                        <div>
                            <strong>Other Services</strong>
                            <p>Specialized niche services</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- CASE STUDIES MEGA MENU (Click to Toggle, MouseLeave to Close) --}}


        {{-- PORTFOLIO MEGA MENU --}}
        <div class="iv-mega-menu portfolio-menu-style" id="portfolioMenu">
            <div class="iv-portfolio-wrapper">
                {{-- Left Side: Categories List --}}
                <div class="port-left">
                    <a href="{{ route('portifolio.clients') }}" class="port-item">
                        <div class="port-img-box">
                             <img src="{{ asset('images/client.png') }}" alt="Clients">
                        </div>
                        <div class="port-text">
                            <h5>Clients</h5>
                            <p>5000+ projects delivered worldwide. Explore how we helped entrepreneurs.</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('portifolio.success-stories') }}" class="port-item">
                        <div class="port-img-box">
                             <img src="{{ asset('images/founders.png') }}" alt="Success">
                        </div>
                        <div class="port-text">
                            <h5>Success Stories</h5>
                            <p>Learn how our clients climbed the ladder of success by choosing IVARA.</p>
                        </div>
                    </a>

                    <a href="{{ route('portifolio.testimonial-reviews') }}" class="port-item">
                        <div class="port-img-box">
                             <img src="{{ asset('images/support.png') }}" style="object-fit: contain;" alt="Reviews">
                        </div>
                        <div class="port-text">
                            <h5>Testimonials & Reviews</h5>
                            <p>See what our clients say about our team and IVARA Ecosystem.</p>
                        </div>
                    </a>
                </div>

                {{-- Right Side: Feature --}}
                <div class="port-right">
                    <div class="port-feature-img">
                        <img src="{{ asset('images/desktop.png') }}" alt="IVARA Dashboard">
                    </div>
                    <h4>Reduce the Time-to-Market with our Agile and Flexible Development Process</h4>
                    <div class="port-actions">
                        <a href="{{ route('register') }}" class="btn-demo">{{ __("messages.book_demo") }}</a>
                        <a href="#" class="btn-learn">{{ __("messages.learn_more") }}</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- PORTFOLIO MEGA MENU (Updated with Clients, Success, Reviews) --}}
        <div class="iv-mega-menu portfolio-menu-style" id="portfolioMenu">
            <div class="iv-res-wrapper">
                {{-- Left: Main Sections --}}
                <div class="res-left" style="flex: 2;">
                    <h4 class="mega-title">Explore Our Work</h4>
                    <div class="res-grid" style="grid-template-columns: 1fr !important;">
                        {{-- Clients Section --}}
                        <a href="/portfolio#clients" class="res-item">
                            <div class="f-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-right: 15px;">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <strong style="font-size: 1.1rem;">Clients</strong>
                                <p style="margin-top: 5px; color: #666;">5000+ projects delivered worldwide. Explore how we helped entrepreneurs.</p>
                            </div>
                        </a>

                        {{-- Success Stories Section --}}
                        <a href="/portfolio#success-stories" class="res-item">
                            <div class="f-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-right: 15px;">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div>
                                <strong style="font-size: 1.1rem;">Success Stories</strong>
                                <p style="margin-top: 5px; color: #666;">Learn how our clients climbed the ladder of success by choosing IVARA.</p>
                            </div>
                        </a>

                        {{-- Testimonials & Reviews Section --}}
                        <a href="/portfolio#testimonials" class="res-item">
                            <div class="f-icon" style="background: rgba(146, 79, 194, 0.1); color: #924FC2; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-right: 15px;">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <strong style="font-size: 1.1rem;">Testimonials & Reviews</strong>
                                <p style="margin-top: 5px; color: #666;">See what our clients say about our team and IVARA Ecosystem.</p>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="res-divider"></div>

                {{-- Right: Featured Showcase --}}
                <div class="res-right" style="flex: 1.2;">
                    <h4 class="mega-title">Featured Project</h4>
                    @php 
                        $featured = collect($portfolioMenu)->where('isFeatured', true)->first(); 
                        if(!$featured && count($portfolioMenu) > 0) $featured = $portfolioMenu[0];
                    @endphp

                    @if($featured)
                        <div class="iv-insight-list">
                            <a href="{{ route('portfolio.index') }}#project-{{ $featured['slug'] ?? $featured['_id'] }}" class="insight-item" style="display: block; text-decoration: none;">
                                <div class="insight-thumb" style="width: 100%; height: 180px; border-radius: 12px; overflow: hidden; margin-bottom: 15px;">
                                    <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div>
                                    <span class="badge-tag" style="background: #924FC2; color: #fff;">{{ $featured['category'] }}</span>
                                    <h6 style="margin-top: 10px; font-size: 1.1rem;">{{ $featured['title'] }}</h6>
                                    <p style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">{{ Str::limit($featured['description'], 80) }}</p>
                                    <span class="read-more">View Details <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    @else
                         <div style="padding: 20px; text-align: center; border: 2px dashed #eee; border-radius: 10px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 2rem; color: #ddd; margin-bottom: 10px;"></i>
                            <p style="color: #999;">No featured projects yet.</p>
                         </div>
                    @endif
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 20px; border-top: 1px solid #eee; padding-top: 15px;">
                <a href="{{ route('portfolio.index') }}" class="btn-learn" style="color: #0A1128; font-weight: 700;">View All Portfolios <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        {{-- RESOURCES MEGA MENU (New) --}}
        <div class="iv-mega-menu resources-menu-style" id="resourcesMenu">
            <div class="iv-res-wrapper">
                {{-- Left: Get to know us --}}
                <div class="res-left">
                    <h4 class="mega-title">Learn & Grow</h4>
                    <div class="res-grid">
                        <a href="{{ route('resource.index', 'blog') }}" class="res-item">
                            <i class="fas fa-blog res-icon code-red"></i>
                            <div><strong>Blog</strong><p>Latest tips, trends & strategies.</p></div>
                        </a>
                        <a href="{{ route('resource.index', 'how-to-start') }}" class="res-item">
                            <i class="fas fa-rocket res-icon code-red"></i>
                            <div><strong>How to Start</strong><p>Start your marketplace in days.</p></div>
                        </a>
                        <a href="{{ route('resource.index', 'user-guide') }}" class="res-item">
                            <i class="fas fa-user-check res-icon code-red"></i>
                            <div><strong>User Guide</strong><p>Guides to help you start easily.</p></div>
                        </a>
                         <a href="{{ route('resource.index', 'documentation') }}" class="res-item">
                            <i class="fas fa-file-code res-icon code-red"></i>
                            <div><strong>Documentation</strong><p>Detailed resources for setup.</p></div>
                        </a>
                        <a href="{{ route('resource.index', 'updates') }}" class="res-item">
                            <i class="fas fa-sync res-icon code-red"></i>
                            <div><strong>Version Updates</strong><p>Explore the latest updates.</p></div>
                        </a>
                        <a href="{{ route('resource.index', 'video-tutorials') }}" class="res-item">
                            <i class="fas fa-play-circle res-icon code-red"></i>
                            <div><strong>Video Tutorials</strong><p>Learn key features visually.</p></div>
                        </a>
                        <a href="{{ route('resource.index', 'faqs') }}" class="res-item">
                            <i class="fas fa-question-circle res-icon code-red"></i>
                            <div><strong>FAQs</strong><p>Common questions answered.</p></div>
                        </a>
                        <a href="{{ route('aboutus') }}" class="res-item">
                            <i class="fas fa-users res-icon code-red"></i>
                            <div><strong>About Us</strong><p>Our core values & history.</p></div>
                        </a>
                    </div>
                </div>

                {{-- Vertical Line Separator --}}
                <div class="res-divider"></div>

                {{-- Right: Insights --}}
                <div class="res-right">
                    <h4 class="mega-title">Insights</h4>
                    <div class="iv-insight-list">
                        @foreach($latestResources as $resource)
                            <a href="{{ route('resource.show', $resource['slug']) }}" class="insight-item">
                                <div class="insight-thumb">
                                    <img src="{{ $resource['image'] ?? 'https://placehold.co/100x70/ccc/333?text=Img' }}" alt="{{ $resource['title'] }}">
                                </div>
                                <div>
                                    @php
                                        $type = $resource['type'] ?? 'Article';
                                        $badgeStyle = '';
                                        if($type == 'Guide') $badgeStyle = 'background:#e74c3c; color:white;';
                                        elseif($type == 'Tutorial') $badgeStyle = 'background:#2ecc71; color:white;';
                                    @endphp
                                    <span class="badge-tag" style="{{ $badgeStyle }}">{{ $type }}</span>
                                    <h6>{{ Str::limit($resource['title'], 45) }}</h6>
                                    <span class="read-more">Read Now <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- SUPPORT MEGA MENU --}}
        <div class="iv-mega-menu support-menu-style" id="supportMenu">
            <div class="iv-support-wrapper">
                {{-- Left: Contact Info --}}
                <div class="support-left">
                    <h4 class="mega-title">Get in Touch</h4>
                    <p class="support-desc">Have questions? We're here to help. Reach out to our team for support or partnership inquiries.</p>
                    
                    <div class="contact-list">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i> <span>support@ivara.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i> <span>+250 788 446 936</span>
                        </div>
                    </div>

                    <a href="https://wa.me/250788446936" target="_blank" class="btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                </div>

                {{-- Right: Contact Form --}}
                <div class="support-right">
                    <form action="{{ route('contact.send') }}" method="POST" class="mega-contact-form">
                        @csrf
                        <input type="hidden" name="subject" value="Support Menu Inquiry">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="email" placeholder="john@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" rows="3" placeholder="How can we help?" required></textarea>
                        </div>
                        <button type="submit" class="btn-send">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

    </header>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        /* Prevent layout shift due to scrollbar toggling */
        html { overflow-y: scroll; }

        .web-header-premium {
            font-family: 'Poppins', sans-serif !important; /* Force consistency */
            position: fixed;
            top: 0; left: 0; 
            width: 100%; /* Ensure full width */
            height: 72px;
            background: rgba(10, 17, 40, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 5000;
            transition: all 0.3s;
            box-sizing: border-box; /* Strict sizing */
        }

        /* Prevent content from hiding behind fixed header on non-landing pages */
        @if(!Route::is('index') && !Route::is('home'))
            body { padding-top: 72px; }
        @endif

        .web-header-premium .iv-header-container {
            width: 100%; max-width: 1600px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 30px; height: 100%;
        }

        .web-header-premium .iv-header-logo {
            display: flex; align-items: center; gap: 10px; text-decoration: none; min-width: 150px;
        }
        .web-header-premium .iv-header-logo img { height: 38px; border-radius: 8px; }
        .web-header-premium .iv-header-logo .logo-text { font-size: 22px; font-weight: 800; color: #fff; }

        .web-header-premium .iv-main-nav { 
            display: flex; gap: 20px; align-items: center;
        }
        
        .web-header-premium .iv-main-nav a, .nav-link-toggle {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none; font-size: 14px; font-weight: 600;
            transition: all 0.3s; padding: 10px 0; position: relative;
            cursor: pointer;
        }
        .web-header-premium .iv-main-nav a:hover, .nav-link-toggle:hover, .nav-link-toggle.active {
            color: #fff;
        }

        /* 
        ========================================
        MEGA MENU ANIMATIONS
        "Falling down and floating left to right"
        ========================================
        */
        .iv-mega-menu {
            position: absolute;
            top: 85px; left: 0; right: 0;
            background: #fff;
            border-top: 1px solid #eee;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            display: none; 
            padding: 40px 0;
            opacity: 0;
            transform-origin: top;
        }

        .iv-mega-menu.open { 
            display: block; 
            animation: menuFall 0.5s ease-out forwards;
        }
        
        /* 1. Container Falls Down */
        @keyframes menuFall {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Support Menu specific animation: Float from Right to Center */
        #supportMenu.open {
            animation: supportFloatIn 0.5s ease-out forwards;
        }
        @keyframes supportFloatIn {
            0% { opacity: 0; transform: translateX(50px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* 2. Content Floats Left to Right (Only for Solutions Menu columns) */
        .iv-mega-menu.open .iv-mega-col {
            opacity: 0;
            transform: translateX(-40px);
            animation: floatRight 0.6s ease-out forwards;
        }

        /* Staggered Delay for wave effect */
        .iv-mega-menu.open .iv-mega-col:nth-child(1) { animation-delay: 0.1s; }
        .iv-mega-menu.open .iv-mega-col:nth-child(2) { animation-delay: 0.25s; }
        .iv-mega-menu.open .iv-mega-col:nth-child(3) { animation-delay: 0.4s; }

        @keyframes floatRight {
            0% { opacity: 0; transform: translateX(-40px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        /* Nav Icon Rotation */
        .nav-link-toggle i { transition: transform 0.3s; }
        .nav-link-toggle.active i { transform: rotate(180deg); }


        /* SOLUTIONS MENU CONTENT */
        .iv-mega-content-wrapper {
            max-width: 1400px; margin: 0 auto; padding: 0 30px;
            display: grid; grid-template-columns: 1.2fr 1.5fr 1fr;
            gap: 60px;
        }

        .mega-title {
            color: #0A1128; font-size: 1.1rem; font-weight: 700;
            margin-bottom: 25px; display: block;
        }

        /* Col 1 */
        #megaMenu .feature-item {
            display: flex; gap: 15px; margin-bottom: 25px;
            text-decoration: none; transition: 0.2s;
        }
        #megaMenu .feature-item:hover .f-icon { background: #924FC2; color: #fff; }
        #megaMenu .f-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: rgba(10, 17, 40, 0.05); color: #0A1128;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; transition: 0.2s;
            margin: 0; /* Strict Reset */
        }
        #megaMenu .feature-item strong { display: block; color: #333; font-size: 0.95rem; }
        #megaMenu .feature-item p { color: #666; font-size: 0.85rem; margin: 0; line-height: 1.4; }

        /* Col 2 */
        .niche-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
        }
        .niche-item {
            display: flex; flex-direction: column; text-decoration: none;
        }
        .niche-item i { color: #0A1128; font-size: 1.2rem; margin-bottom: 5px; }
        .niche-item span { color: #333; font-weight: 600; font-size: 0.95rem; }
        .niche-item small { color: #888; font-size: 0.8rem; }
        .niche-item:hover i { color: #924FC2; }
        .niche-item:hover span { color: #000; }

        /* Col 3 */
        .sim-item { margin-bottom: 20px; }
        .sim-item h5 { font-size: 1rem; color: #0A1128; margin: 0 0 5px; font-weight: 700; }
        .sim-item p { color: #666; font-size: 0.85rem; margin: 0; }


        /* 
        ========================================
        CASE STUDIES & PORTFOLIO MENU STYLES
        ========================================
        */
        .case-content-wrapper {
            max-width: 1400px; margin: 0 auto; padding: 0 30px;
            display: grid; 
            grid-template-columns: repeat(3, 1fr); /* 3 Columns for 9 items */
            gap: 0;
        }
        
        .case-item {
            padding: 25px; /* Spacing inside cells */
        }
        
        .border-right-item { border-right: 1px solid #eee; }
        .border-bottom-item { border-bottom: 1px solid #eee; }
        
        .mt-30 { margin-top: 0; } /* Reset */

        .case-logo {
            display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: #0A1128;
        }
        .case-logo i { font-size: 1.5rem; color: #0A1128; }
        .case-logo span { font-weight: 800; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.5px; }

        .case-item p { font-size: 0.85rem; color: #666; line-height: 1.5; margin: 0; }

        .view-more-link {
            color: #924FC2; text-decoration: none; font-weight: 700; font-size: 1rem;
            border-bottom: 2px solid #924FC2; padding-bottom: 5px; transition: 0.3s;
        }
        .view-more-link:hover { color: #0A1128; border-color: #0A1128; }
        
        /* Portfolio Menu Specifics */
        .iv-portfolio-wrapper {
            max-width: 1400px; margin: 0 auto; padding: 0 30px;
            display: flex; gap: 50px;
        }
        .port-left { flex: 1.2; display: flex; flex-direction: column; gap: 30px; }
        .port-item { display: flex; gap: 20px; text-decoration: none; align-items: flex-start; }
        .port-item:hover .port-text h5 { color: #924FC2; }

        .port-img-box {
            width: 120px; height: 80px; overflow: hidden; border-radius: 8px; flex-shrink: 0;
            background: #f8f9fa; display: flex; align-items: center; justify-content: center;
        }
        .port-img-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .port-text h5 { margin: 0 0 5px; font-weight: 700; color: #0A1128; font-size: 1.1rem; transition: 0.2s; }
        .port-text p { margin: 0; color: #666; font-size: 0.9rem; line-height: 1.5; }

        .port-right {
            flex: 1; background: #f8f9fa; border-radius: 12px; padding: 30px;
            display: flex; flex-direction: column; align-items: center; text-align: center;
        }
        .port-feature-img { width: 100%; max-width: 400px; margin-bottom: 20px; border-radius: 8px; overflow: hidden; }
        .port-feature-img img { width: 100%; height: auto; }
        .port-right h4 { font-size: 1.2rem; margin-bottom: 20px; color: #0A1128; font-weight: 700; }
        
        .port-actions { display: flex; gap: 15px; }
        .btn-demo { background: #924FC2; color: #fff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: 0.3s; }
        .btn-demo:hover { background: #7b3fa8; transform: translateY(-2px); }
        .btn-learn { border: 2px solid #0A1128; color: #0A1128; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: 0.3s; }
        .btn-learn:hover { background: #0A1128; color: white; transform: translateY(-2px); }
        
        /* 
        ========================================
        RESOURCES MENU UNIQUE STYLES
        ========================================
        */
        .iv-res-wrapper {
            max-width: 1400px; margin: 0 auto; padding: 0 30px;
            display: flex; gap: 0; /* Gap handled by internal padding/margins */
        }
        
        .iv-res-wrapper .res-left { flex: 2; padding-right: 40px; }
        .iv-res-wrapper .res-right { flex: 1; padding-left: 40px; }
        
        /* Vertical Separator */
        .iv-res-wrapper .res-divider {
            width: 2px;
            background: #e2e8f0; 
            box-shadow: 2px 0 0 #924FC2; /* Gold highlight for visibility */
            align-self: stretch;
        }
        
        .iv-res-wrapper .res-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 30px;
        }
        
        .iv-res-wrapper .res-item { display: flex; gap: 15px; text-decoration: none; align-items: flex-start; }
        .iv-res-wrapper .res-icon { 
            font-size: 1.5rem; color: #0A1128; /* Ivara Navy */
            width: 25px; text-align: center; flex-shrink: 0;
            transition: 0.3s;
        }
        .code-red { color: #0A1128; } /* Rebranded to Navy */

        .iv-res-wrapper .res-item:hover strong { color: #924FC2; }
        .iv-res-wrapper .res-item:hover .res-icon { color: #924FC2; transform: scale(1.1); }

        .iv-res-wrapper .res-item strong { display: block; color: #0A1128; font-size: 1rem; margin-bottom: 3px; transition: 0.3s; }
        .iv-res-wrapper .res-item p { margin: 0; color: #666; font-size: 0.85rem; line-height: 1.4; }
        
        /* Insights */
        .iv-insight-list { display: flex; flex-direction: column; gap: 25px; }
        .iv-insight-list .insight-item { display: flex; gap: 15px; text-decoration: none; align-items: center; }
        .iv-insight-list .insight-thumb { 
            width: 100px; height: 70px; border-radius: 8px; overflow: hidden; flex-shrink: 0;
            background: #f1f5f9;
        }
        .iv-insight-list .insight-thumb img { width: 100%; height: 100%; object-fit: cover; transition: 0.3s; }
        .iv-insight-list .insight-item:hover .insight-thumb img { transform: scale(1.05); }
        
        .badge-tag { 
            font-size: 0.7rem; font-weight: 700; color: #000; background: #924FC2; /* Purple Badge */
            padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 5px;
        }
        .iv-insight-list .insight-item h6 { font-size: 0.95rem; font-weight: 700; color: #0A1128; margin: 0 0 5px; line-height: 1.3; transition: 0.3s; }
        .iv-insight-list .insight-item:hover h6 { color: #924FC2; }

        .iv-insight-list .read-more { font-size: 0.8rem; color: #0A1128; font-weight: 700; display: flex; align-items: center; gap: 5px; transition: 0.3s; }
        .iv-insight-list .insight-item:hover .read-more { color: #924FC2; margin-left: 5px; }

        /* SUPPORT MENU STYLES */
        .iv-support-wrapper {
            max-width: 1000px; margin: 0 auto; padding: 0 30px;
            display: flex; gap: 60px;
        }
        .iv-support-wrapper .support-left { flex: 1; }
        .iv-support-wrapper .support-right { flex: 1; }
        
        .iv-support-wrapper .support-desc { color: #666; font-size: 0.95rem; margin-bottom: 25px; line-height: 1.6; }
        
        .iv-support-wrapper .contact-list { display: flex; flex-direction: column; gap: 15px; margin-bottom: 30px; }
        .contact-item { display: flex; align-items: center; gap: 12px; font-size: 1rem; color: #0A1128; font-weight: 600; }
        .contact-item i { color: #0A1128; font-size: 1.2rem; width: 20px; text-align: center; }
        
        .btn-whatsapp {
            display: inline-flex; align-items: center; gap: 10px;
            background: #25D366; color: white;
            padding: 12px 24px; border-radius: 8px;
            font-weight: 700; text-decoration: none;
            transition: 0.3s;
        }
        .btn-whatsapp:hover { background: #1ebc57; transform: translateY(-2px); }
        .btn-whatsapp i { font-size: 1.2rem; }
        
        .iv-support-wrapper .mega-contact-form {
            background: #f8f9fa; padding: 30px; border-radius: 12px;
            border: 1px solid #eee;
        }
        .iv-support-wrapper .mega-contact-form .form-group { margin-bottom: 15px; }
        .iv-support-wrapper .mega-contact-form label { display: block; font-size: 0.85rem; font-weight: 700; color: #0A1128; margin-bottom: 5px; }
        .iv-support-wrapper .mega-contact-form input, .iv-support-wrapper .mega-contact-form textarea {
            width: 100%; padding: 10px 15px; border-radius: 6px;
            border: 1px solid #ddd; font-family: inherit; font-size: 0.9rem;
            transition: 0.3s;
        }
        .iv-support-wrapper .mega-contact-form input:focus, .iv-support-wrapper .mega-contact-form textarea:focus {
            outline: none; border-color: #0A1128;
        }
        .btn-send {
            width: 100%; background: #0A1128; color: #924FC2;
            border: none; padding: 12px; border-radius: 6px;
            font-weight: 700; cursor: pointer; transition: 0.3s;
        }
        .btn-send:hover { background: #000; }


        .web-header-premium .auth-actions { display: flex; align-items: center; gap: 15px; min-width: 250px; justify-content: flex-end; }
        
        .link-signin { 
            background: #ffffff; color: #0A1128; /* White BG, Navy Text */
            text-decoration: none; font-weight: 700; font-size: 14px; 
            padding: 10px 24px; border-radius: 50px;
            transition: all 0.3s; border: 2px solid #ffffff; /* Border matches BG to hold space */
        }
        .link-signin:hover { 
            background: #0A1128; color: #ffffff; /* Dark Blue BG, White Text */
            border-color: #924FC2; /* Purple Border */
            transform: translateY(-2px);
        }

        .btn-signup, .btn-dashboard {
            background: #924FC2; color: #fff;
            text-decoration: none; padding: 10px 24px;
            border-radius: 50px; font-weight: 700; font-size: 14px;
            transition: all 0.3s; text-align: center; border: 2px solid #924FC2;
        }
        .btn-signup:hover, .btn-dashboard:hover { 
            background: transparent; color: #924FC2;
            transform: translateY(-2px); box-shadow: 0 4px 15px rgba(146, 79, 194, 0.3);
        }



        @media (max-width: 1100px) {
            .web-header-premium .main-nav { display: none; }
            .mega-menu { display: none !important; } /* Hide on mobile for now */
        }
        /* 
        ========================================
        NEW MARKETPLACE MENU (Yo!Kart Style)
        ========================================
        */
        .badge-new {
            background: #924FC2; color: #fff; font-size: 9px; font-weight: 800;
            padding: 2px 5px; border-radius: 4px; margin-left: 5px; vertical-align: middle;
        }

        .marketplace-trigger { 
            height: 100%; 
            display: flex; 
            align-items: center; 
            position: relative;
        }
        
        .market-mega-menu {
            position: fixed;
            top: 95px; /* Slightly lower to allow arrow space and bridge gap */
            left: 50%;
            transform: translateX(-50%) translateY(-200%);
            width: 900px;
            max-width: 95vw;
            max-height: 85vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 12px; /* Full rounded corners */
            /* Removed Top Border */
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
            padding: 40px;
            z-index: 6000;
            
            scrollbar-width: thin;
            scrollbar-color: #924FC2 #f1f5f9;
            
            display: none;
            opacity: 0;
            pointer-events: none;
        }

        /* Transparent Bridge on Trigger to ensure mouse path */
        .marketplace-trigger::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 30px; /* Connects header to menu top */
            background: transparent;
            z-index: 5999;
        }

        /* Purple Arrow (Triangle) */
        .market-mega-menu::before {
            content: "";
            position: absolute;
            top: -10px; /* Poke out exactly above */
            left: 50%;
            transform: translateX(-50%);
            border-width: 0 10px 10px 10px; /* Triangle pointing Up */
            border-style: solid;
            border-color: transparent transparent #924FC2 transparent;
            z-index: 6001;
            filter: drop-shadow(0 -1px 1px rgba(0,0,0,0.05));
        }

        /* Hover Trigger */
        .marketplace-trigger:hover .market-mega-menu, 
        .market-mega-menu:hover {
            display: block;
            pointer-events: auto;
            animation: fallBounce 1.2s ease-out forwards;
        }

        /* 4-Stage Fall Down Bounce Animation */
        @keyframes fallBounce {
            0% { opacity: 1; transform: translateX(-50%) translateY(-150%); }
            30% { transform: translateX(-50%) translateY(0); }
            45% { transform: translateX(-50%) translateY(-100px); }
            60% { transform: translateX(-50%) translateY(0); }
            75% { transform: translateX(-50%) translateY(-50px); }
            85% { transform: translateX(-50%) translateY(0); }
            93% { transform: translateX(-50%) translateY(-15px); }
            100% { opacity: 1; transform: translateX(-50%) translateY(0); }
        }

        /* Header Area */
        .market-menu-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 30px;
        }
        .market-logo { display: flex; align-items: center; gap: 10px; }
        .market-logo img { height: 35px; }
        .market-logo span { font-weight: 800; font-size: 1.2rem; color: #0A1128; }
        
        .btn-back-home {
            background: #0A1128; /* Dark Navy */
            color: #fff; /* White Text */
            padding: 10px 20px;
            border-radius: 6px; text-decoration: none; font-size: 0.9rem; font-weight: 700;
            transition: 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-back-home:hover { background: #924FC2; color: #fff; }

        .market-main-title {
            text-align: center; font-size: 1.4rem; font-weight: 700; color: #0A1128;
            margin-bottom: 20px;
        }

        /* Switcher */
        .market-switch-container {
            display: flex; justify-content: center; gap: 0;
            background: #fff; border: 1px solid #e74c3c;
            border-radius: 6px; width: fit-content; margin: 0 auto 25px;
            overflow: hidden;
        }
        .market-switch {
            padding: 7px 25px; font-weight: 700; cursor: pointer; transition: 0.3s;
            color: #e74c3c; font-size: 0.9rem;
        }
        .market-switch.active {
            background: #e74c3c; color: #fff;
        }

        /* Grid */
        .market-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px;
        }
        
        .market-card {
            text-decoration: none; display: flex; flex-direction: column;
            border-radius: 8px; overflow: hidden; height: 180px; /* Reduced Height */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s;
            position: relative;
        }
        .market-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }

        .m-card-img {
            flex: 1; background: #eee; display: flex; align-items: center; justify-content: center;
            font-size: 2rem; color: rgba(255,255,255,0.6);
            background-size: cover; background-position: center;
        }
        
        .technical-bg { background: linear-gradient(135deg, #0A1128, #2c3e50); }
        .fashion-bg { background: linear-gradient(135deg, #e74c3c, #c0392b); }
        .transport-bg { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .education-bg { background: linear-gradient(135deg, #3498db, #2980b9); }

        .m-card-btn {
            background: #e74c3c; color: #fff; text-align: center;
            padding: 8px; font-weight: 700; font-size: 0.85rem;
        }
        
        .market-mega-menu .view-all-markets {
            color: #000 !important; font-weight: 800; text-decoration: none; 
            border-bottom: 2px solid #000; padding-bottom: 2px; transition: 0.2s;
            font-size: 0.95rem;
        }
        .market-mega-menu .view-all-markets:hover { color: #924FC2 !important; border-color: #924FC2; }

        /* Modal Overlay for All Categories */
        .market-all-modal-overlay {
            display: none; /* Hidden by default */
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255,255,255,0.8); /* Light overlay over main menu */
            backdrop-filter: blur(4px);
            z-index: 6050;
            border-radius: 12px;
            /* Flex centering */
            display: none; 
            justify-content: center; align-items: center;
        }
        /* The smaller internal popup */
        .market-all-modal-content {
            background: #fff;
            width: 100%; max-width: 700px; /* Smaller than parent (900px) */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(10, 17, 40, 0.25);
            position: relative;
            border: 1px solid #e2e8f0;
            margin: auto;
        }
        
        .btn-close-modal {
            position: absolute; top: -15px; right: -15px;
            background: #fff; border: 1px solid #eee; /* White bg with border since it's outside */
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #333; cursor: pointer; transition: 0.2s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); /* Shadow for floating effect */
            z-index: 10;
        }
        .btn-close-modal:hover { 
            background: #e74c3c; color: #fff; transform: rotate(90deg); border-color: #e74c3c;
        }

        /* Mini Market Items (List View) - Dark Blue Text */
        .mini-market-item {
            display: flex; align-items: center; gap: 8px;
            padding: 10px; background: #f8f9fa; border-radius: 6px;
            text-decoration: none; 
            color: #0A1128 !important; /* FORCE Dark Blue */
            font-weight: 700; font-size: 0.85rem;
            transition: 0.2s; border: 1px solid transparent;
        }
        .mini-market-item i { color: #0A1128 !important; } /* Force Icon Dark */
        
        .mini-market-item:hover {
            background: #0A1128; color: #fff !important; /* Invert on hover */
            border-color: #0A1128; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .mini-market-item:hover i { color: #fff !important; } /* Force icons white on hover */
        .mini-market-item i { width: 20px; text-align: center; transition: 0.2s; }
        
        /* Cart Button Public */
        .header-cart-btn {
            position: relative;
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            color: #0A1128;
            border-radius: 50%;
            transition: 0.3s;
            text-decoration: none;
            background: rgba(255,255,255,0.8);
            margin-right: 10px;
        }
        .header-cart-btn:hover { background: white; transform: scale(1.1); color: #924FC2; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .cart-badge {
            position: absolute; top: -5px; right: -5px;
            background: #924FC2; color: #0A1128;
            font-size: 0.7rem; font-weight: 800;
            width: 18px; height: 18px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper: Manage Toggle
            function setupToggle(toggleId, menuId, closeOnMouseLeave = false) {
                const toggle = document.getElementById(toggleId);
                const menu = document.getElementById(menuId);
                if(!toggle || !menu) return;

                // Click to toggle
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Close other menus first
                    const allMenus = document.querySelectorAll('.iv-mega-menu');
                    const allToggles = document.querySelectorAll('.nav-link-toggle');
                    
                    allMenus.forEach(m => { if(m !== menu) m.classList.remove('open'); });
                    allToggles.forEach(t => { if(t !== toggle) t.classList.remove('active'); });

                    menu.classList.toggle('open');
                    toggle.classList.toggle('active');
                });

                // Mouse Leave behavior (Requested for Case Studies)
                if(closeOnMouseLeave) {
                    menu.addEventListener('mouseleave', function() {
                        menu.classList.remove('open');
                        toggle.classList.remove('active');
                    });
                }
            }

            // Setup Solutions (Standard Toggle)
            setupToggle('solutionsToggle', 'megaMenu', false);

            
            // Setup Portfolio (Toggle + Close on Leave)
            setupToggle('portfolioToggle', 'portfolioMenu', true);
            
            // Setup Resources (Toggle + Close on Leave)
            setupToggle('resourcesToggle', 'resourcesMenu', true);
            
            // Setup Support
            setupToggle('supportToggle', 'supportMenu', false);

            // Close when clicking outside everything
            document.addEventListener('click', function(e) {
                const menus = document.querySelectorAll('.iv-mega-menu');
                const toggles = document.querySelectorAll('.nav-link-toggle');
                
                let clickedInside = false;
                menus.forEach(m => { if(m.contains(e.target)) clickedInside = true; });
                toggles.forEach(t => { if(t.contains(e.target)) clickedInside = true; });

                if(!clickedInside) {
                    menus.forEach(m => m.classList.remove('open'));
                    toggles.forEach(t => t.classList.remove('active'));
                }
            });

            // Smooth scrolling for anchor links (kept from previous code)
            document.querySelectorAll('.main-nav a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                     // Check if it's the toggle button
                    if(this.classList.contains('nav-link-toggle')) return;

                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 85,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            // Marketplace View Switcher
            const btnShow = document.getElementById('btnShowAllMarkets');
            // Marketplace Modal Logic
            // We use 'var' or 'let' to avoid re-declaration errors if script runs twice, or ensure unique names
            // Clearing out old logic vars
            const btnShowMarket = document.getElementById('btnShowAllMarkets');
            const btnCloseMarket = document.getElementById('btnCloseAllModal');
            const modalMarketOverlay = document.getElementById('marketAllModal');

            if(btnShowMarket && btnCloseMarket && modalMarketOverlay) {
                console.log('Marketplace Modal Logic Initialized');
                btnShowMarket.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation(); // Stop bubbling
                    modalMarketOverlay.style.display = 'flex'; 
                });
                
                btnCloseMarket.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    modalMarketOverlay.style.display = 'none';
                });
            } else {
                console.error('Marketplace modal elements not found:', {btnShowMarket, btnCloseMarket, modalMarketOverlay});
            }

            // --- Cart Count Logic ---
            const userId = '{{ auth()->id() ?? "" }}';
            if(userId) {
                fetch(`http://127.0.0.1:5001/api/cart/${userId}`)
                .then(r => r.json())
                .then(d => {
                    if(d.success && d.data && d.data.items && d.data.items.length > 0) {
                        const count = d.data.items.length;
                        
                        // Auth Header badge
                        const authBadge = document.getElementById('authCartCount');
                        if(authBadge) {
                            authBadge.innerText = count;
                            authBadge.style.display = 'block';
                        }
                        
                        // Public Header badge
                        const pubBadge = document.getElementById('publicCartCount');
                        if(pubBadge) {
                            pubBadge.innerText = count;
                            pubBadge.style.display = 'flex';
                        }
                    }
                })
                .catch(e => console.error('Cart fetch error', e));
            }
            
            // --- Live Global Search Logic ---
            const globalSearch = document.getElementById('globalSearch');
            const searchResults = document.getElementById('searchResults');
            let searchTimeout = null;

            if(globalSearch && searchResults) {
                // Style the results container
                Object.assign(searchResults.style, {
                    position: 'absolute',
                    top: '100%',
                    left: '0',
                    width: '100%',
                    backgroundColor: 'var(--dropdown-bg)', // Use theme var
                    border: '1px solid var(--header-border)',
                    borderRadius: '0 0 12px 12px',
                    boxShadow: '0 10px 30px rgba(0,0,0,0.1)',
                    zIndex: '1000',
                    maxHeight: '400px',
                    overflowY: 'auto',
                    display: 'none',
                    marginTop: '5px'
                });

                globalSearch.addEventListener('input', function(e) {
                    const query = e.target.value.trim();
                    
                    // Clear previous timeout
                    if(searchTimeout) clearTimeout(searchTimeout);

                    // Hide if empty
                    if(query.length < 2) {
                        searchResults.style.display = 'none';
                        searchResults.innerHTML = '';
                        return;
                    }

                    // Debounce fetch
                    searchTimeout = setTimeout(() => {
                        searchResults.innerHTML = '<div style="padding:15px; text-align:center; color:var(--text-muted);"><i class="fas fa-spinner fa-spin"></i> Searching...</div>';
                        searchResults.style.display = 'block';

                        fetch(`{{ route('global.search') }}?query=${encodeURIComponent(query)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.results && data.results.length > 0) {
                                let html = '';
                                data.results.forEach(item => {
                                    html += `
                                        <a href="${item.url}" style="display:flex; align-items:center; gap:12px; padding:12px 15px; text-decoration:none; border-bottom:1px solid var(--header-border); transition:0.2s; color: var(--text-main);">
                                            <div style="width:32px; height:32px; background:rgba(59,130,246,0.1); color:var(--primary); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                <i class="${item.icon}"></i>
                                            </div>
                                            <div style="flex:1;">
                                                <div style="font-weight:600; font-size:14px;">${item.title}</div>
                                                <div style="font-size:12px; color:var(--text-muted);">${item.category} • ${item.description || ''}</div>
                                            </div>
                                            <i class="fas fa-chevron-right" style="font-size:10px; color:var(--text-muted);"></i>
                                        </a>
                                    `;
                                });
                                // Add hover effect via JS since inline styles are hard for hover
                                searchResults.innerHTML = html;
                                
                                // Attach hover listeners for cleaner UX
                                const resultLinks = searchResults.querySelectorAll('a');
                                resultLinks.forEach(link => {
                                    link.addEventListener('mouseenter', () => link.style.background = 'rgba(0,0,0,0.03)');
                                    link.addEventListener('mouseleave', () => link.style.background = 'transparent');
                                });

                            } else {
                                searchResults.innerHTML = '<div style="padding:15px; text-align:center; color:var(--text-muted);">No results found.</div>';
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            searchResults.innerHTML = '<div style="padding:15px; text-align:center; color:red;">Error processing search.</div>';
                        });
                    }, 300); // 300ms debounce
                });

                // Close on click outside
                document.addEventListener('click', function(e) {
                    if (!globalSearch.contains(e.target) && !searchResults.contains(e.target)) {
                        searchResults.style.display = 'none';
                    }
                });

                // Focus back opens results if text is there
                globalSearch.addEventListener('focus', function() {
                    if(this.value.trim().length >= 2 && searchResults.children.length > 0) {
                        searchResults.style.display = 'block';
                    }
                });
            }
        });
    </script>
@endif
