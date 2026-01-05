<link rel="stylesheet" href="{{ asset('css/umurinzi-header.css') }}">

<div class="umurinzi-topbar">
    {{-- Logo --}}
    <div class="umurinzi-topbar-logo">
        <img src="{{ asset('images/UMURINZI.png') }}" alt="UMURINZI Logo">
        <span>UMURINZI</span>
    </div>

    {{-- Mega Search --}}
    <div class="umurinzi-mega-search">
        <button class="umurinzi-search-icon" id="umurinzi-search-btn" aria-label="Search">🔍</button>
        <input type="text" placeholder="Search Everything" class="umurinzi-search-input" id="umurinzi-search-input">
    </div>

    {{-- Icons --}}
    <div class="umurinzi-topbar-icons">
        <button class="umurinzi-btn-circle umurinzi-btn-blue" aria-label="Add New">+</button>

        <button class="umurinzi-icon-button" aria-label="Toggle Theme">🌗</button>

        <button class="umurinzi-icon-button" aria-label="Notifications">🔔</button>

        <button class="umurinzi-icon-button" aria-label="Messages">✉️</button>

        <a href="{{ route('profile.show') }}">
            @auth
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" alt="User Avatar" class="umurinzi-avatar-img">
                @else
                    <div class="umurinzi-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                @endif
            @else
                <div class="umurinzi-avatar">👤</div>
            @endauth
        </a>
    </div>
</div>

<script>
    document.getElementById('umurinzi-search-btn').addEventListener('click', function (e) {
        e.preventDefault();
        const query = document.getElementById('umurinzi-search-input').value.trim();

        if (query) {
            console.log('Searching for:', query);
            // Example: window.location.href = `/search?q=${encodeURIComponent(query)}`;
        } else {
            alert('Please enter a search term.');
        }
    });
</script>

<style>
    .umurinzi-topbar {
        background-color: #ffffff;
        border-bottom: 1px solid #ddd;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        z-index: 1000;
        flex-wrap: wrap;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
    }

    .umurinzi-topbar-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: bold;
        font-size: 18px;
        color: #333;
    }

    .umurinzi-topbar-logo img {
        height: 32px;
    }

    .umurinzi-mega-search {
        display: flex;
        align-items: center;
        flex: 1;
        max-width: 400px;
        margin: 10px;
    }

    .umurinzi-search-icon {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        margin-right: 10px;
        color: #333;
    }

    .umurinzi-search-input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 14px;
    }

    .umurinzi-topbar-icons {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .umurinzi-btn-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 18px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .umurinzi-btn-blue {
        background-color: #4f46e5;
        color: white;
    }

    .umurinzi-icon-button {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: #333;
    }

    .umurinzi-avatar-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .umurinzi-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #4f46e5;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 14px;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .umurinzi-topbar {
            flex-direction: column;
            align-items: flex-start;
            padding: 15px;
        }

        .umurinzi-mega-search {
            width: 100%;
            margin-top: 10px;
        }

        .umurinzi-topbar-icons {
            width: 100%;
            justify-content: flex-start;
            margin-top: 10px;
        }
    }

    body {
        padding-top: 70px; /* adjust if needed depending on header height */
    }
</style>
