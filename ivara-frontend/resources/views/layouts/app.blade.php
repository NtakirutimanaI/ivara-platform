@php
    // Detect if current route is a public/landing page
    $publicRoutes = [
        'home', 'index', 
        'aboutus', 'support', 'contact.index', 'contact.send', 
        'products', 'team', 
        'privacy_policy', 'terms', 'web.privacy-policy', 'web.terms', 'web.updates',
        'login', 'register', 'password.request', 'password.reset', 'verification.notice', 'verification.verify',
        'quick.access', 'subscribe',
        'market.*', 'resource.*', 'solutions.*',
        'auth.select-category', 'auth.select-user'
    ];
    $isPublic = !Auth::check() || Request::routeIs($publicRoutes);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IVARA')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Unified Design System -->
    <link rel="stylesheet" href="{{ asset('css/dashboard-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    
    @section('styles')
    @show
</head>
<body class="{{ !$isPublic && Auth::check() ? 'dashboard-page' : 'public-page' }}">

@include('layouts.header')

<main>
    {{-- Only include sidebar if NOT public page and User IS logged in --}}
    @if(!$isPublic && Auth::check())
        @include('layouts.sidebar')
    @endif

    <div class="content {{ $isPublic ? 'content-public' : '' }}">
        @yield('content')
    </div>
</main>

@yield('scripts')

<!-- Toastr & Jquery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "2000"
    };

    // Global Notification Helper
    window.showNotify = function(message, type = 'success') {
        if (!message) return;
        switch(type) {
            case 'success': toastr.success(message); break;
            case 'error': toastr.error(message); break;
            case 'info': toastr.info(message); break;
            case 'warning': toastr.warning(message); break;
            default: toastr.success(message);
        }
    };

    @if(Session::has('success')) showNotify("{{ Session::get('success') }}", 'success'); @endif
    @if(Session::has('error')) showNotify("{{ Session::get('error') }}", 'error'); @endif
    @if(Session::has('info')) showNotify("{{ Session::get('info') }}", 'info'); @endif
    @if(Session::has('warning')) showNotify("{{ Session::get('warning') }}", 'warning'); @endif
    @if(Session::has('status')) showNotify("{{ Session::get('status') }}", 'success'); @endif
    
    // Display validation errors if any
    @if($errors->any())
        @foreach($errors->all() as $error)
            showNotify("{{ $error }}", 'error');
        @endforeach
    @endif
</script>

    @stack('modals')
</body>
</html>
