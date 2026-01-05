<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IVARA')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @section('styles')
    <style>
        * { box-sizing: border-box; }
        body { margin:0; font-family: 'Inter', Arial, sans-serif; }
        
        /* Sidebar default styles (can be overridden by sidebar.blade.php include) */
        .sidebar { width:210px; background:#0f172a; color:#fff; position:fixed; left:0; top:72px; height:calc(100vh - 72px); padding:10px; overflow-y:auto; z-index: 1000; }
        
        /* Default Content Wrapper (Dashboard Mode) */
        .content { 
            margin-left: 210px; 
            width: calc(100% - 210px);
            padding: 0 20px 20px 20px; 
            min-height: calc(100vh - 72px);
            transition: all 0.3s ease;
            background: #f3f4f6;
        }

        /* Public / Landing Page Mode */
        .content-public {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 0 !important;
            margin-top: 0 !important; /* Managed by page CSS */
            background: transparent !important;
        }
    </style>
    @show
</head>
<body>

@include('layouts.header')

@php
    // Detect if current route is a public/landing page
    // You can extend this list as needed
    $publicRoutes = [
        'home', 'index', 
        'aboutus', 'support', 'contact.index', 'contact.send', 
        'products', 'team', 
        'privacy_policy', 'terms', 'web.privacy-policy', 'web.terms', 'web.updates',
        'login', 'register', 'password.request', 'password.reset', 'verification.notice', 'verification.verify',
        'quick.access', 'subscribe',
        'market.*', 'resource.*', 'solutions.*'
    ];
    $isPublic = !Auth::check() || Request::routeIs($publicRoutes);
@endphp

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
        "timeOut": "5000"
    };
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
    @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif
    @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif
    @if(Session::has('status'))
        toastr.success("{{ Session::get('status') }}");
    @endif
    
    // Display validation errors if any
    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

</body>
</html>
