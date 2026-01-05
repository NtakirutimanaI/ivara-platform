@extends('layouts.app')

@section('title', 'Site Map - IVARA')

@section('content')
<style>
    .sitemap-container {
        max-width: 1200px;
        margin: 120px auto 60px;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }
    
    .sitemap-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .sitemap-header h1 {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0A1128 0%, #162447 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }
    
    .sitemap-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
       margin-top: 40px;
    }
    
    .sitemap-section {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(10, 17, 40, 0.08);
        border: 1px solid rgba(10, 17, 40, 0.05);
    }
    
    .sitemap-section h3 {
        color: #ffb700;
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 1.3rem;
    }
    
    .sitemap-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sitemap-section li {
        margin-bottom: 12px;
    }
    
    .sitemap-section a {
        color: #0A1128;
        text-decoration: none;
        transition: all 0.3s;
        display: block;
        padding: 5px 0;
    }
    
    .sitemap-section a:hover {
        color: #ffb700;
        padding-left: 10px;
    }
</style>

<div class="sitemap-container">
    <div class="sitemap-header">
        <h1>Site Map</h1>
        <p>Navigate through all pages of IVARA platform</p>
    </div>
    
    <div class="sitemap-grid">
        <div class="sitemap-section">
            <h3>Main Pages</h3>
            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('aboutus') }}">About Us</a></li>
                <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                <li><a href="{{ route('team') }}">Our Team</a></li>
                <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
            </ul>
        </div>
        
        <div class="sitemap-section">
            <h3>Services</h3>
            <ul>
                <li><a href="{{ route('index') }}#services">All Services</a></li>
                <li><a href="{{ route('marketplace.index') }}">Marketplace</a></li>
                <li><a href="{{ route('bookings.index') }}">Book Service</a></li>
                <li><a href="{{ route('index') }}#pricing">Pricing</a></li>
            </ul>
        </div>
        
        <div class="sitemap-section">
            <h3>User Account</h3>
            <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ route('password.request') }}">Forgot Password</a></li>
            </ul>
        </div>
        
        <div class="sitemap-section">
            <h3>Resources</h3>
            <ul>
                <li><a href="{{ route('resources.index') }}">Blog</a></li>
                <li><a href="{{ route('faq.index') }}">FAQs</a></li>
                <li><a href="{{ route('resources.index') }}">Documentation</a></li>
            </ul>
        </div>
        
        <div class="sitemap-section">
            <h3>Legal</h3>
            <ul>
                <li><a href="{{ route('web.terms') }}">Terms & Conditions</a></li>
                <li><a href="{{ route('web.privacy-policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('web.sitemap') }}">Site Map</a></li>
            </ul>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
