<link rel="stylesheet" href="{{ asset('css/ivara-header.css') }}">

<div class="ivara-topbar">
    {{-- Logo --}}
    <div class="ivara-topbar-logo">
        <img src="{{ asset('images/logo.jpg') }}" alt="IVARA">
        <span>IVARA </span>
    </div>

    {{-- Mega Search --}}
    <div class="ivara-mega-search">
        <button class="ivara-search-icon" id="ivara-search-btn" aria-label="Search">🔍</button>
        <input type="text" placeholder="Search Everything" class="ivara-search-input" id="ivara-search-input">
    </div>

    {{-- Icons --}}
    <div class="ivara-topbar-icons">
        <button class="ivara-btn-circle ivara-btn-blue" aria-label="Add New">+</button>

        <button class="ivara-icon-button" aria-label="Toggle Theme">🌗</button>

        <button class="ivara-icon-button" aria-label="Notifications">🔔</button>

        <button class="ivara-icon-button" aria-label="Messages">✉️</button>

        <a href="{{ route('profile.show') }}">
            @auth
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" alt="User Avatar" class="ivara-avatar-img">
                @else
                    <div class="ivara-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                @endif
            @else
                <div class="ivara-avatar">👤</div>
            @endauth
        </a>
    </div>
</div>

<script>
    document.getElementById('ivara-search-btn').addEventListener('click', function (e) {
        e.preventDefault();
        const query = document.getElementById('ivara-search-input').value.trim();

        if (query) {
            console.log('Searching for:', query);
            // Example: window.location.href = `/search?q=${encodeURIComponent(query)}`;
        } else {
            alert('Please enter a search term.');
        }
    });
</script>

<style>
    .ivara-topbar {
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

    .ivara-topbar-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: bold;
        font-size: 18px;
        color: #333;
    }

    .ivara-topbar-logo img {
        height: 32px;
    }

    .ivara-mega-search {
        display: flex;
        align-items: center;
        flex: 1;
        max-width: 400px;
        margin: 10px;
    }

    .ivara-search-icon {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        margin-right: 10px;
        color: #333;
    }

    .ivara-search-input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        font-size: 14px;
    }

    .ivara-topbar-icons {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .ivara-btn-circle {
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

    .ivara-btn-blue {
        background-color: #4f46e5;
        color: white;
    }

    .ivara-icon-button {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: #333;
    }

    .ivara-avatar-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .ivara-avatar {
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
        .ivara-topbar {
            flex-direction: column;
            align-items: flex-start;
            padding: 15px;
        }

        .ivara-mega-search {
            width: 100%;
            margin-top: 10px;
        }

        .ivara-topbar-icons {
            width: 100%;
            justify-content: flex-start;
            margin-top: 10px;
        }
    }

    body {
        padding-top: 70px; /* adjust if needed depending on header height */
    }
</style>
