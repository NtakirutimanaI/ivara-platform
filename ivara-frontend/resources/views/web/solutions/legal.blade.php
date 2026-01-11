@extends('layouts.app')

@section('title', 'Modernize Legal & Professional Consultancy - IVARA')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-navy: #0A1128;
        --accent-gold: #924FC2;
        --legal-navy: #2c3e50; /* Deep Legal Navy */
        --bg-light: #f4f4f4;
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
    .btn-action:hover { background: var(--primary-navy); color: #fff; border-color: #924FC2; transform: translateY(-3px); }

    .hero-visual { flex: 1.2; position: relative; }
    
    /* Legal Visuals */
    .mockup-container {
        position: relative; width: 100%; height: 500px;
        background: radial-gradient(circle at center, rgba(10, 17, 40, 0.1), transparent 70%);
    }
    .floating-card {
        background: #fff; padding: 20px; border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        position: absolute; animation: float 6s ease-in-out infinite;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
    }
    
    .card-scale { top: 15%; right: 10%; width: 180px; z-index: 2; }
    .card-doc { bottom: 20%; right: 25%; width: 220px; z-index: 3; animation-delay: 1.2s; padding: 15px; }
    .card-gavel { top: 40%; left: 10%; width: 180px; z-index: 1; animation-delay: 0.5s; }
    
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
    .models-section { background: #0A1128; color: #fff; position: relative; overflow: hidden; }
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
            <h1>Modernize Legal & <br> Professional Consulting</h1>
            <p class="subtitle">Secure, compliant, and efficient digital platforms for lawyers, accountants, and business consultants.</p>
            
            <ul class="feature-list">
                <li><i class="fas fa-check-circle"></i> Secure Document Management</li>
                <li><i class="fas fa-check-circle"></i> Appointment Scheduling & Reminders</li>
                <li><i class="fas fa-check-circle"></i> Video Consultation Integration</li>
                <li><i class="fas fa-check-circle"></i> Client Portal & Billing System</li>
            </ul>

            <a href="{{ route('register') }}" class="btn-action">Go Digital</a>
        </div>

        <div class="hero-visual reveal">
            <div class="mockup-container">
                <!-- Floating Scale Card -->
                <div class="floating-card card-scale">
                    <i class="fas fa-balance-scale" style="font-size: 3.5rem; color: #0A1128; margin-bottom: 10px;"></i>
                    <strong style="font-size: 1.1rem;">Justice</strong>
                </div>
                
                <!-- Floating Doc Card -->
                <div class="floating-card card-doc">
                    <i class="fas fa-file-signature" style="font-size: 3rem; color: #555; margin-bottom: 10px;"></i>
                    <div style="width: 100%; height: 5px; background: #eee; border-radius: 3px; margin-bottom: 5px;"></div>
                     <div style="width: 80%; height: 5px; background: #eee; border-radius: 3px; margin-bottom: 5px;"></div>
                    <strong style="color: green; margin-top: 5px;">Signed</strong>
                </div>

                <!-- Floating Gavel Card -->
                <div class="floating-card card-gavel">
                    <i class="fas fa-gavel" style="font-size: 3rem; color: #8d6e63; margin-bottom: 10px;"></i>
                    <strong>Verdict</strong>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY FEATURES -->
<section class="section-pad bg-white">
    <div class="center-head reveal">
        <h2>Trust & Compliance</h2>
        <p>Built with the high standards of professional services in mind.</p>
    </div>
    
    <div class="features-grid">
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-lock"></i></div>
            <h4>Data Security</h4>
            <p>End-to-end encryption for sensitive client data and communication channels.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-calendar-alt"></i></div>
            <h4>Automated Booking</h4>
            <p>Let clients book consultations directly into your calendar without the email back-and-forth.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-file-contract"></i></div>
            <h4>E-Signatures</h4>
            <p>Integrated tools for sending, signing, and storing legally binding documents online.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-comments"></i></div>
            <h4>Secure Chat</h4>
            <p>Private messaging channels for ongoing client support and file sharing.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-briefcase"></i></div>
            <h4>Case Management</h4>
            <p>Organize clients, documents, and tasks by case or project for better efficiency.</p>
        </div>
        <div class="f-card reveal">
            <div class="f-icon"><i class="fas fa-credit-card"></i></div>
            <h4>Retainer Billing</h4>
            <p>Flexible invoicing options for hourly billing, flat fees, or monthly retainers.</p>
        </div>
    </div>
</section>

<!-- MODELS -->
<section class="models-section section-pad">
    <div class="center-head reveal" style="position: relative; z-index: 2;">
        <h2 style="color: #fff;">Professional Models</h2>
        <p style="color: rgba(255,255,255,0.7);">Solutions for firms of all sizes.</p>
    </div>
    
    <div class="models-grid reveal">
        <div class="model-box">
            <h3>On-Demand Advice</h3>
            <p>Connect users with lawyers or consultants for quick, paid video answers.</p>
            <a href="#" class="btn-outline-gold">Explore On-Demand</a>
        </div>
        <div class="model-box">
            <h3>Firm Management</h3>
            <p>Comprehensive ERP for managing staff, leads, and billing in a consultancy firm.</p>
            <a href="#" class="btn-outline-gold">Explore ERP</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-pad cta-foot">
    <div class="reveal">
        <h2 style="font-size: 2.5rem; color: var(--primary-navy); margin-bottom: 20px;">Build Trust Online</h2>
        <p style="color: var(--text-muted); margin-bottom: 40px;">Elevate your professional practice with IVARA today.</p>
        <a href="{{ route('register') }}" class="btn-action" style="font-size: 1.2rem; padding: 18px 50px;">Get Started Now</a>
    </div>
</section>

@include('layouts.footer')
@endsection

@section('scripts')
<script>
    const reveals = document.querySelectorAll(".reveal");
    const windowHeight = window.innerHeight;
    function checkReveal() { reveals.forEach(r => { if (r.getBoundingClientRect().top < windowHeight - 100) { r.style.opacity = "1"; r.style.transform = "translateY(0)"; } }); }
    reveals.forEach(r => { r.style.opacity = "0"; r.style.transform = "translateY(30px)"; r.style.transition = "all 0.8s ease"; });
    window.addEventListener("scroll", checkReveal);
    checkReveal();
</script>
@endsection
