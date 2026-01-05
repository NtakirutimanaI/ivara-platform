@extends('layouts.app')

@section('title', 'Launch Your Transport & Logistics Platform - IVARA')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-navy: #0A1128;
        --accent-gold: #ffb700;
        --transport-green: #00d2d3; /* Transport Teal */
        --bg-light: #eefbfb;
        --text-dark: #333;
        --text-muted: #666;
    }
    body { font-family: 'Poppins', sans-serif; color: var(--text-dark); }
    
    /* HERO SECTION */
    .fashion-hero { padding: 40px 0 80px; background: var(--bg-light); overflow: hidden; }
    .hero-container {
        max-width: 1300px; margin: 0 auto; padding: 0 30px;
        display: flex; align-items: center; gap: 60px;
    }
    .hero-text { flex: 1; z-index: 2; }
    .hero-text h1 { font-size: 3.5rem; font-weight: 700; color: var(--primary-navy); line-height: 1.2; margin-bottom: 20px; }
    .hero-text p.subtitle { font-size: 1.2rem; color: var(--text-muted); margin-bottom: 30px; font-weight: 300; }
    
    .feature-list { list-style: none; padding: 0; margin-bottom: 40px; }
    .feature-list li { display: flex; align-items: center; gap: 10px; font-size: 1.05rem; color: var(--primary-navy); font-weight: 500; margin-bottom: 12px; }
    .feature-list li i { color: var(--accent-gold); font-size: 1.2rem; }

    /* Button Style */
    .btn-action {
        background: var(--accent-gold); color: #000;
        padding: 15px 40px; border-radius: 50px; text-decoration: none;
        font-weight: 700; font-size: 1.1rem; border: 2px solid var(--accent-gold);
        transition: 0.3s; box-shadow: 0 5px 15px rgba(255,183,0,0.3); display: inline-block;
    }
    .btn-action:hover { background: var(--primary-navy); color: #fff; border-color: #ffb700; transform: translateY(-3px); }

    .hero-visual { flex: 1.2; position: relative; }
    
    /* Transport Visuals */
    .mockup-container {
        position: relative; width: 100%; height: 500px;
        background: radial-gradient(circle at center, rgba(0, 210, 211, 0.15), transparent 70%);
    }
    .floating-card {
        background: #fff; padding: 20px; border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        position: absolute; animation: float 6s ease-in-out infinite;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    
    .card-truck { top: 15%; right: 5%; width: 220px; z-index: 2; }
    .card-map { bottom: 15%; right: 25%; width: 200px; z-index: 3; animation-delay: 1.5s; padding: 10px; }
    .card-driver { top: 35%; left: 10%; width: 180px; z-index: 1; animation-delay: 0.8s; }
    
    @keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-15px); } 100% { transform: translateY(0); } }

    /* FEATURES SECTION */
    .section-pad { padding: 100px 0; }
    .bg-white { background: #fff; }
    .center-head { text-align: center; max-width: 800px; margin: 0 auto 60px; }
    .center-head h2 { font-size: 2.5rem; color: var(--primary-navy); font-weight: 700; margin-bottom: 15px; }
    .center-head p { font-size: 1.1rem; color: var(--text-muted); }

    .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; max-width: 1200px; margin: 0 auto; padding: 0 30px; }
    .f-card { padding: 40px 30px; border-radius: 20px; background: #fff; border: 1px solid #eee; transition: 0.3s; text-align: center; }
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
    .models-section { background: #1e272e; color: #fff; position: relative; overflow: hidden; }
    .models-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0; max-width: 1200px; margin: 0 auto; }
    .model-box { padding: 80px 40px; border-right: 1px solid rgba(255,255,255,0.1); display: flex; flex-direction: column; align-items: center; text-align: center; transition: 0.3s; }
    .model-box:last-child { border-right: none; }
    .model-box:hover { background: rgba(255,255,255,0.05); }
    .model-box h3 { font-size: 2rem; margin-bottom: 20px; color: var(--accent-gold); }
    .model-box p { font-size: 1.1rem; opacity: 0.8; max-width: 400px; margin-bottom: 30px; }
    .btn-outline-gold { border: 2px solid var(--accent-gold); color: var(--accent-gold); padding: 10px 30px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s; }
    .btn-outline-gold:hover { background: var(--accent-gold); color: #000; }

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
            <h1>Start a Transport & <br> Logistics Business</h1>
            <p class="subtitle">Launch a powerful platform for ride-hailing, freight delivery, or fleet management with IVARA.</p>
            
            <ul class="feature-list">
                <li><i class="fas fa-check-circle"></i> Real-Time GPS Tracking & Navigation</li>
                <li><i class="fas fa-check-circle"></i> Driver Wallet & Payout System</li>
                <li><i class="fas fa-check-circle"></i> Automated Route Optimization</li>
                <li><i class="fas fa-check-circle"></i> Fleet & Vehicle Management</li>
            </ul>

            <a href="{{ route('register') }}" class="btn-action">Start Moving</a>
        </div>

        <div class="hero-visual reveal">
            <div class="mockup-container">
                <!-- Floating Truck Card -->
                <div class="floating-card card-truck">
                    <i class="fas fa-truck-moving" style="font-size: 3.5rem; color: #00d2d3; margin-bottom: 10px;"></i>
                    <strong style="font-size: 1.1rem;">Fleet Alpha</strong>
                    <span style="color: #666; font-size: 0.9rem;">En Route</span>
                </div>
                
                <!-- Floating Map Card -->
                <div class="floating-card card-map">
                    <div style="width: 100%; height: 100px; background: #eee; border-radius: 8px; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 30%; left: 40%; width: 10px; height: 10px; background: red; border-radius: 50%;"></div>
                        <div style="position: absolute; top: 60%; left: 60%; width: 10px; height: 10px; background: blue; border-radius: 50%;"></div>
                        <svg width="100%" height="100%" style="position: absolute; top:0; left:0;">
                             <path d="M70 30 Q 100 60 110 60" stroke="#333" stroke-width="2" fill="none" class="path-anim"/>
                        </svg>
                    </div>
                    <strong style="margin-top: 10px;">Live Route</strong>
                </div>

                <!-- Floating Driver Card -->
                <div class="floating-card card-driver">
                    <i class="fas fa-user-check" style="font-size: 2.5rem; color: var(--primary-navy); margin-bottom: 10px;"></i>
                    <strong>Driver Active</strong>
                    <small style="color: green;">Online</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY FEATURES -->
<section class="section-pad bg-white">
    <div class="center-head reveal">
        <h2>Efficiency in Motion</h2>
        <p>Advanced logistics features designed to optimize every mile of your operation.</p>
    </div>
    
    <div class="features-grid">
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-map-marked"></i></div>
            <h4>Route Optimization</h4>
            <p>AI-driven algorithms to calculate the most efficient routes and reduce fuel costs.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-mobile-alt"></i></div>
            <h4>Driver & User Apps</h4>
            <p>Native mobile applications for seamless booking, tracking, and communication.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-wallet"></i></div>
            <h4>Automated Billing</h4>
            <p>Transparent pricing, digital invoicing, and integrated payment gateways.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-chart-area"></i></div>
            <h4>Fleet Analytics</h4>
            <p>Monitor vehicle health, driver performance, and operational costs in one dashboard.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-boxes"></i></div>
            <h4>Load Management</h4>
            <p>Connect shippers with carriers efficiently for freight and cargo logistics.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-shield-alt"></i></div>
            <h4>Safety First</h4>
            <p>SOS features, ride tracking, and verified driver profiles for maximum security.</p>
        </div>
    </div>
</section>

<!-- MODELS -->
<section class="models-section section-pad">
    <div class="center-head reveal" style="position: relative; z-index: 2;">
        <h2 style="color: #fff;">Transport Business Models</h2>
        <p style="color: rgba(255,255,255,0.7);">Choose the right model for your logistic venture.</p>
    </div>
    
    <div class="models-grid reveal">
        <div class="model-box">
            <h3>Ride Hailing</h3>
            <p>Connect passengers with drivers nearby. Ideal for taxi startups and urban mobility solutions.</p>
            <a href="#" class="btn-outline-gold">Explore Taxi App</a>
        </div>
        <div class="model-box">
            <h3>Freight & Logistics</h3>
            <p>Manage truck fleets and cargo delivery. Perfect for courier companies and movers.</p>
            <a href="#" class="btn-outline-gold">Explore Logistics</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-pad cta-foot">
    <div class="reveal">
        <h2 style="font-size: 2.5rem; color: var(--primary-navy); margin-bottom: 20px;">Drive Your Business Forward</h2>
        <p style="color: var(--text-muted); margin-bottom: 40px;">Launch your transport empire with IVARA's robust tech stack.</p>
        <a href="{{ route('register') }}" class="btn-action" style="font-size: 1.2rem; padding: 18px 50px;">Get Started Now</a>
    </div>
</section>

@include('layouts.footer')
@endsection

@section('scripts')
<script>
    const reveals = document.querySelectorAll(".reveal");
    const windowHeight = window.innerHeight;
    function checkReveal() {
        reveals.forEach(r => { if (r.getBoundingClientRect().top < windowHeight - 100) { r.style.opacity = "1"; r.style.transform = "translateY(0)"; } });
    }
    reveals.forEach(r => { r.style.opacity = "0"; r.style.transform = "translateY(30px)"; r.style.transition = "all 0.8s ease"; });
    window.addEventListener("scroll", checkReveal);
    checkReveal();
</script>
@endsection
