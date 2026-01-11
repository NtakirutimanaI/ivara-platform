@extends('layouts.app')

@section('title', 'All Marketplaces - IVARA')

@section('content')
<div style="background: #f8f9fa; min-height: 80vh; padding: 40px 0 60px;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 60px;">
            <h1 style="font-size: 3rem; color: #0A1128; font-weight: 800; margin-bottom: 15px;">Explore All Marketplaces</h1>
            <p style="color: #666; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Discover millions of products and services across our 9 specialized categories.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">
            
            {{-- Technical & Repair --}}
            <a href="{{ route('market.category', 'technical') }}" class="market-category-card">
                <div class="mc-icon" style="background: #e3f2fd; color: #1e88e5;"><i class="fas fa-tools"></i></div>
                <h3>Technical & Repair</h3>
                <p>Device repairs, maintenance & troubleshooting.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Fashion & Food --}}
            <a href="{{ route('market.category', 'fashion') }}" class="market-category-card">
                <div class="mc-icon" style="background: #ffebee; color: #e53935;"><i class="fas fa-tshirt"></i></div>
                <h3>Food & Fashion</h3>
                <p>Restaurants, boutiques, tailoring & more.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Transport --}}
            <a href="{{ route('market.category', 'transport') }}" class="market-category-card">
                <div class="mc-icon" style="background: #e8f5e9; color: #43a047;"><i class="fas fa-truck"></i></div>
                <h3>Transport & Travel</h3>
                <p>Logistics, ride-hailing & travel services.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Education --}}
            <a href="{{ route('market.category', 'education') }}" class="market-category-card">
                <div class="mc-icon" style="background: #e1f5fe; color: #039be5;"><i class="fas fa-graduation-cap"></i></div>
                <h3>Education & Knowledge</h3>
                <p>Tutoring, courses, books & training.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>
            
            {{-- Agriculture --}}
            <a href="{{ route('market.category', 'agriculture') }}" class="market-category-card">
                <div class="mc-icon" style="background: #f1f8e9; color: #7cb342;"><i class="fas fa-leaf"></i></div>
                <h3>Agriculture & Enviro</h3>
                <p>Farming supplies, eco-solutions & produce.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Creative --}}
            <a href="{{ route('market.category', 'creative') }}" class="market-category-card">
                <div class="mc-icon" style="background: #f3e5f5; color: #8e24aa;"><i class="fas fa-palette"></i></div>
                <h3>Creative & Lifestyle</h3>
                <p>Art, design, wellness & lifestyle services.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Media --}}
            <a href="{{ route('market.category', 'media') }}" class="market-category-card">
                <div class="mc-icon" style="background: #fff3e0; color: #fb8c00;"><i class="fas fa-film"></i></div>
                <h3>Media & Entertainment</h3>
                <p>Events, streaming, production & content.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Legal --}}
            <a href="{{ route('market.category', 'legal') }}" class="market-category-card">
                <div class="mc-icon" style="background: #e8eaf6; color: #3949ab;"><i class="fas fa-balance-scale"></i></div>
                <h3>Legal & Professional</h3>
                <p>Consultancy, legal advice & business solutions.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

            {{-- Other --}}
            <a href="{{ route('market.category', 'other') }}" class="market-category-card">
                <div class="mc-icon" style="background: #fafafa; color: #616161;"><i class="fas fa-ellipsis-h"></i></div>
                <h3>Other Services</h3>
                <p>Specialized niche services & more.</p>
                <span class="mc-link">Visit Market <i class="fas fa-arrow-right"></i></span>
            </a>

        </div>
    </div>
</div>

<style>
    .market-category-card {
        background: #fff; border-radius: 12px; padding: 30px;
        text-decoration: none; display: flex; flex-direction: column; align-items: center; text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: 0.3s;
        border: 1px solid transparent;
    }
    .market-category-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); border-color: #924FC2; }
    
    .mc-icon {
        width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 2rem; margin-bottom: 20px;
    }
    
    .market-category-card h3 { color: #0A1128; font-size: 1.2rem; font-weight: 700; margin-bottom: 10px; }
    .market-category-card p { color: #666; font-size: 0.9rem; margin-bottom: 20px; line-height: 1.5; }
    
    .mc-link { font-weight: 700; color: #0A1128; font-size: 0.9rem; transition: 0.2s; }
    .market-category-card:hover .mc-link { color: #924FC2; }
</style>
@endsection
