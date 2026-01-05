@extends('layouts.app')

@section('title', 'Launch Your Technical Repair Platform - IVARA')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-navy: #0A1128;
        --accent-gold: #ffb700;
        --tech-blue: #00f2ff; /* Tech specific accent */
        --bg-light: #f4f8fb;
        --text-dark: #333;
        --text-muted: #666;
    }
    body { font-family: 'Poppins', sans-serif; color: var(--text-dark); }
    
    .fashion-hero {
        padding: 40px 0 80px;
        background: #f0f4f8; 
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

    /* Button Style */
    .btn-action {
        background: var(--accent-gold); color: #000;
        padding: 15px 40px; border-radius: 50px; text-decoration: none;
        font-weight: 700; font-size: 1.1rem; border: 2px solid var(--accent-gold);
        transition: 0.3s; box-shadow: 0 5px 15px rgba(255,183,0,0.3);
        display: inline-block;
    }
    .btn-action:hover {
        background: var(--primary-navy); color: #fff; border-color: #ffb700;
        transform: translateY(-3px);
    }

    .hero-visual { flex: 1.2; position: relative; }
    
    /* Technical Visuals */
    .mockup-container {
        position: relative; width: 100%; height: 500px;
        background: radial-gradient(circle at center, rgba(0, 242, 255, 0.1), transparent 70%);
    }
    .floating-card {
        background: #fff; padding: 20px; border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        position: absolute; animation: float 6s ease-in-out infinite;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    
    .card-tools { top: 15%; right: 10%; width: 180px; z-index: 2; }
    .card-phone { bottom: 20%; right: 30%; width: 220px; z-index: 3; animation-delay: 1.5s; }
    .card-status { top: 40%; left: 15%; width: 200px; z-index: 1; animation-delay: 0.8s; }
    
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

    /* BUSINESS MODELS (Recycled but text changed) */
    .models-section { background: #0A1128; color: #fff; position: relative; overflow: hidden; }
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
            <h1>Launch a Technical <br> Repair Platform</h1>
            <p class="subtitle">Connect certified technicians with customers needing device repairs, maintenance, and expert support.</p>
            
            <ul class="feature-list">
                <li><i class="fas fa-check-circle"></i> Booking & Scheduling System</li>
                <li><i class="fas fa-check-circle"></i> Technician Verification & Tracking</li>
                <li><i class="fas fa-check-circle"></i> Inventory & Parts Management</li>
                <li><i class="fas fa-check-circle"></i> Automated Invoicing & Payments</li>
            </ul>

            <a href="{{ route('register') }}" class="btn-action">Start Building</a>
        </div>

        <div class="hero-visual reveal">
            <div class="mockup-container">
                <!-- Floating Tool Card -->
                <div class="floating-card card-tools">
                    <i class="fas fa-tools" style="font-size: 4rem; color: #00f2ff; margin-bottom: 10px;"></i>
                    <strong style="font-size: 1.1rem;">Expert Repairs</strong>
                </div>
                
                <!-- Floating Phone Mockup -->
                <div class="floating-card card-phone">
                    <i class="fas fa-mobile-alt" style="font-size: 3rem; color: #333; margin-bottom: 10px;"></i>
                    <div style="background: #eee; width: 100%; height: 10px; border-radius: 5px; margin-bottom: 5px;"></div>
                    <div style="background: #eee; width: 60%; height: 10px; border-radius: 5px;"></div>
                    <span style="color: green; font-weight: 700; margin-top: 10px;">Repair Complete</span>
                </div>

                <!-- Floating Status -->
                <div class="floating-card card-status">
                    <i class="fas fa-cog fa-spin" style="font-size: 2.5rem; color: var(--primary-navy); margin-bottom: 10px;"></i>
                    <strong>System Diagnostic</strong>
                    <small>Running...</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY FEATURES -->
<section class="section-pad bg-white">
    <div class="center-head reveal">
        <h2>Built for Technical Excellence</h2>
        <p>Robust features to manage complex repair workflows and service logistics.</p>
    </div>
    
    <div class="features-grid">
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-calendar-check"></i></div>
            <h4>Smart Booking</h4>
            <p>Allow customers to schedule repairs at their convenience with real-time slot availability.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-user-shield"></i></div>
            <h4>Technician Vetting</h4>
            <p>Built-in tools to verify qualifications and track performance of your service professionals.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-map-marked-alt"></i></div>
            <h4>Live Tracking</h4>
            <p>Track on-field technicians in real-time as they travel to customer locations.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-microchip"></i></div>
            <h4>Parts Inventory</h4>
            <p>Manage spare parts stock efficiently and link them directly to repair job cards.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-file-invoice-dollar"></i></div>
            <h4>Automated Quotes</h4>
            <p>Generate instant cost estimates based on device models and reported issues.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-history"></i></div>
            <h4>Service History</h4>
            <p>Maintain digital records of all repairs for warranty and quality assurance purposes.</p>
        </div>
    </div>
</section>

<!-- DIFFERENTIATION -->
<section class="models-section section-pad">
    <div class="center-head reveal" style="position: relative; z-index: 2;">
        <h2 style="color: #fff;">Scalable Service Models</h2>
        <p style="color: rgba(255,255,255,0.7);">From solo shops to nationwide repair networks.</p>
    </div>
    
    <div class="models-grid reveal">
        <div class="model-box">
            <h3>On-Demand Repairs</h3>
            <p>Uber-like model for technicians. Connect customers with the nearest available expert for home service.</p>
            <a href="#" class="btn-outline-gold">Learn More</a>
        </div>
        <div class="model-box">
            <h3>Service Center Management</h3>
            <p>Enterprise solution for managing queues, inventory, and staff at physical repair hubs.</p>
            <a href="#" class="btn-outline-gold">Learn More</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-pad cta-foot">
    <div class="reveal">
        <h2 style="font-size: 2.5rem; color: var(--primary-navy); margin-bottom: 20px;">Fix the World with IVARA</h2>
        <p style="color: var(--text-muted); margin-bottom: 40px;">Join the leading platform for technical service providers.</p>
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
        reveals.forEach(r => {
            if (r.getBoundingClientRect().top < windowHeight - 100) {
                r.style.opacity = "1"; r.style.transform = "translateY(0)";
            }
        });
    }
    reveals.forEach(r => {
        r.style.opacity = "0"; r.style.transform = "translateY(30px)"; r.style.transition = "all 0.8s ease";
    });
    window.addEventListener("scroll", checkReveal);
    checkReveal();
</script>
@endsection
