@extends('layouts.app')

@section('title', 'Launch Your Fashion eCommerce Platform - IVARA')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-navy: #0A1128;
        --accent-gold: #924FC2;
        --bg-light: #f9f9f9;
        --text-dark: #333;
        --text-muted: #666;
    }
    body { font-family: 'Poppins', sans-serif; color: var(--text-dark); }
    
    /* HERO SECTION */
    .fashion-hero {
        padding: 40px 0 80px;
        background: #f4f6f8; /* Light gray background like image */
        overflow: hidden;
    }
    .hero-container {
        max-width: 1300px; margin: 0 auto; padding: 0 30px;
        display: flex; align-items: center; gap: 60px;
    }
    .hero-text { flex: 1; z-index: 2; }
    .hero-text h1 {
        font-size: 3.5rem; font-weight: 700; color: var(--primary-navy);
        line-height: 1.2; margin-bottom: 20px;
    }
    .hero-text p.subtitle {
        font-size: 1.2rem; color: var(--text-muted); margin-bottom: 30px;
        font-weight: 300;
    }
    
    .feature-list { list-style: none; padding: 0; margin-bottom: 40px; }
    .feature-list li {
        display: flex; align-items: center; gap: 10px;
        font-size: 1.05rem; color: var(--primary-navy); font-weight: 500;
        margin-bottom: 12px;
    }
    .feature-list li i { color: var(--accent-gold); font-size: 1.2rem; }

    /* Button Style (Matching previous requests) */
    .btn-action {
        background: var(--accent-gold); color: #000;
        padding: 15px 40px; border-radius: 50px; text-decoration: none;
        font-weight: 700; font-size: 1.1rem; border: 2px solid var(--accent-gold);
        transition: 0.3s; box-shadow: 0 5px 15px rgba(255,183,0,0.3);
        display: inline-block;
    }
    .btn-action:hover {
        background: var(--primary-navy); color: #fff; border-color: #924FC2;
        transform: translateY(-3px);
    }

    .hero-visual { flex: 1.2; position: relative; }
    /* Generic Placeholder mimicking the collage */
    .mockup-container {
        position: relative; width: 100%; height: 500px;
        background: radial-gradient(circle at center, rgba(255,255,255,0.8), transparent 70%);
    }
    .floating-card {
        background: #fff; padding: 20px; border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        position: absolute; animation: float 6s ease-in-out infinite;
    }
    .card-1 { top: 10%; right: 10%; width: 200px; z-index: 2; } /* Shirt placeholder area */
    .card-2 { bottom: 15%; right: 25%; width: 220px; z-index: 3; } /* Bag placeholder */
    .card-3 { top: 40%; left: 10%; width: 180px; z-index: 1; animation-delay: 1s; } /* Selector */
    
    @keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0); } }

    /* FEATURES SECTION */
    .section-pad { padding: 100px 0; }
    .bg-white { background: #fff; }
    .center-head { text-align: center; max-width: 800px; margin: 0 auto 60px; }
    .center-head h2 { font-size: 2.5rem; color: var(--primary-navy); font-weight: 700; margin-bottom: 15px; }
    .center-head p { font-size: 1.1rem; color: var(--text-muted); }

    .features-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;
        max-width: 1200px; margin: 0 auto; padding: 0 30px;
    }
    .f-card {
        padding: 40px 30px; border-radius: 20px; background: #fff;
        border: 1px solid #eee; transition: 0.3s; text-align: center;
    }
    .f-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: var(--accent-gold); }
    .f-icon {
        width: 70px; height: 70px; background: rgba(10,17,40,0.05); color: var(--primary-navy);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; margin: 0 auto 25px; transition: 0.3s;
    }
    .f-card:hover .f-icon { background: var(--accent-gold); color: #000; }
    .f-card h4 { font-size: 1.3rem; margin-bottom: 15px; font-weight: 600; color: var(--primary-navy); }
    .f-card p { font-size: 0.95rem; color: var(--text-muted); line-height: 1.6; }

    /* BUSINESS MODELS */
    .models-section { background: #1a2a5e; color: #fff; position: relative; overflow: hidden; }
    .models-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 0;
        max-width: 1200px; margin: 0 auto;
    }
    .model-box {
        padding: 80px 40px; border-right: 1px solid rgba(255,255,255,0.1);
        display: flex; flex-direction: column; align-items: center; text-align: center;
        transition: 0.3s;
    }
    .model-box:last-child { border-right: none; }
    .model-box:hover { background: rgba(255,255,255,0.05); }
    .model-box h3 { font-size: 2rem; margin-bottom: 20px; color: var(--accent-gold); }
    .model-box p { font-size: 1.1rem; opacity: 0.8; max-width: 400px; margin-bottom: 30px; }
    .btn-outline-gold {
        border: 2px solid var(--accent-gold); color: var(--accent-gold);
        padding: 10px 30px; border-radius: 50px; text-decoration: none; font-weight: 600;
        transition: 0.3s;
    }
    .btn-outline-gold:hover { background: var(--accent-gold); color: #000; }

    /* CTA */
    .cta-foot { background: #fff; text-align: center; }
    
    @media (max-width: 900px) {
        .hero-container { flex-direction: column; text-align: center; }
        .hero-text h1 { font-size: 2.5rem; }
        .features-grid { grid-template-columns: 1fr; }
        .models-grid { grid-template-columns: 1fr; border-right: none; }
        .model-box { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
    }
</style>

<section class="fashion-hero">
    <div class="hero-container">
        <div class="hero-text reveal">
            <h1>Launch a Contemporary <br> Fashion eCommerce Platform</h1>
            <p class="subtitle">Discover the ease of starting your own Fashion eCommerce platform with IVARA.</p>
            
            <ul class="feature-list">
                <li><i class="fas fa-check-circle"></i> Essential Fashion Platform Features - Prebuilt</li>
                <li><i class="fas fa-check-circle"></i> Reliability & Tested Scalability</li>
                <li><i class="fas fa-check-circle"></i> Customizable and Whitelabel</li>
                <li><i class="fas fa-check-circle"></i> Tailormade solutions for B2C and B2B models</li>
            </ul>

            <a href="{{ route('register') }}" class="btn-action">Get Started</a>
        </div>

        <div class="hero-visual reveal">
            <!-- Simulated Collage using CSS Cards & Icons -->
            <div class="mockup-container">
                <!-- Shirt Card Representation -->
                <div class="floating-card card-1" style="height: 250px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <i class="fas fa-tshirt" style="font-size: 4rem; color: #0A1128; margin-bottom: 15px;"></i>
                    <span style="font-weight: 700; color: #333;">Summer Shirt</span>
                    <span style="color: var(--accent-gold); font-weight: 600;">$45.00</span>
                </div>
                
                <!-- Bag Card Representation -->
                <div class="floating-card card-2" style="height: 180px; display: flex; align-items: center; gap: 15px;">
                    <i class="fas fa-shopping-bag" style="font-size: 3rem; color: #555;"></i>
                    <div>
                        <strong style="display: block;">Leather Bag</strong>
                        <small style="color: green;">In Stock</small>
                    </div>
                </div>

                <!-- Palette Card Representation -->
                <div class="floating-card card-3" style="text-align: center;">
                    <span style="display: block; font-weight: 600; margin-bottom: 10px;">Select Color</span>
                    <div style="display: flex; gap: 8px; justify-content: center;">
                        <div style="width: 20px; height: 20px; background: #0A1128; border-radius: 50%;"></div>
                        <div style="width: 20px; height: 20px; background: #924FC2; border-radius: 50%;"></div>
                        <div style="width: 20px; height: 20px; background: #e74c3c; border-radius: 50%;"></div>
                        <div style="width: 20px; height: 20px; background: #2ecc71; border-radius: 50%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY FEATURES -->
<section class="section-pad bg-white">
    <div class="center-head reveal">
        <h2>Why Choose IVARA for Fashion?</h2>
        <p>Purpose-built features designed to help your fashion marketplace thrive in a competitive market.</p>
    </div>
    
    <div class="features-grid">
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-mobile-alt"></i></div>
            <h4>Mobile-First Design</h4>
            <p>Capture the mobile audience with a responsive design and native apps that offer a seamless shopping experience.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-palette"></i></div>
            <h4>Visual Customization</h4>
            <p>Easily tweak colors, fonts, and layouts to match your brand identity without writing a single line of code.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-tags"></i></div>
            <h4>Smart Product Variants</h4>
            <p>Handle complex fashion inventory with size, color, and material variants effortlessly.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-chart-line"></i></div>
            <h4>Sales Analytics</h4>
            <p>Get deep insights into your best-selling items, customer preferences, and seasonal trends.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-search-dollar"></i></div>
            <h4>SEO Optimized</h4>
            <p>Drive organic traffic with built-in SEO tools designed specifically for catalog-heavy fashion stores.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-shield-alt"></i></div>
            <h4>Secure Payments</h4>
            <p>Integrate with top global payment gateways to offer secure and flexible payment options to your customers.</p>
        </div>
    </div>
</section>

<!-- BUSINESS MODELS -->
<section class="models-section section-pad">
    <div class="center-head reveal" style="position: relative; z-index: 2;">
        <h2 style="color: #fff;">Supported Business Models</h2>
        <p style="color: rgba(255,255,255,0.7);">One platform, multiple possibilities for your growth.</p>
    </div>
    
    <div class="models-grid reveal">
        <div class="model-box">
            <h3>B2C Marketplace</h3>
            <p>Direct-to-consumer model. Connect fashion brands and designers directly with end customers. Ideal for malls and multi-vendor stores.</p>
            <a href="#" class="btn-outline-gold">Explore B2C</a>
        </div>
        <div class="model-box">
            <h3>B2B Wholesale</h3>
            <p>Business-to-business model. Enable bulk buying, wholesale pricing, and verified supplier networks for fashion retailers.</p>
            <a href="#" class="btn-outline-gold">Explore B2B</a>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="section-pad cta-foot">
    <div class="reveal">
        <h2 style="font-size: 2.5rem; color: var(--primary-navy); margin-bottom: 20px;">Ready to Launch?</h2>
        <p style="color: var(--text-muted); margin-bottom: 40px;">Join thousands of entrepreneurs transforming the fashion industry with IVARA.</p>
        <a href="{{ route('register') }}" class="btn-action" style="font-size: 1.2rem; padding: 18px 50px;">Get Started Now</a>
    </div>
</section>

@include('layouts.footer')

@endsection

@section('scripts')
<script>
    // Simple Scroll Reveal (Reused)
    const reveals = document.querySelectorAll(".reveal");
    const windowHeight = window.innerHeight;
    
    function checkReveal() {
        reveals.forEach(r => {
            const elementTop = r.getBoundingClientRect().top;
            if (elementTop < windowHeight - 100) {
                r.style.opacity = "1";
                r.style.transform = "translateY(0)";
            }
        });
    }

    // Init Styles
    reveals.forEach(r => {
        r.style.opacity = "0";
        r.style.transform = "translateY(30px)";
        r.style.transition = "all 0.8s ease";
    });

    window.addEventListener("scroll", checkReveal);
    checkReveal(); // Run on load
</script>
@endsection
