@extends('layouts.app')

@section('title', 'IVARA - Service Marketplace & Management')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    /* 
    ========================================
    IVARA MODERN THEME (Refined Aesthetic)
    ========================================
    */
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #ffc107;
        --accent-gold-hover: #ffca2c;
        --text-dark: #333333;
        --text-light: #666666;
        --bg-light: #f8f9fa;
        --white: #ffffff;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--white);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* Utilities */
    .container-custom { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .btn {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 12px 30px; border-radius: 50px; font-weight: 600;
        text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none;
    }
    .btn-primary {
        background: var(--primary-navy); color: var(--white);
        box-shadow: 0 4px 15px rgba(10, 17, 40, 0.3);
    }
    .btn-primary:hover {
        background: var(--secondary-navy); transform: translateY(-2px);
    }
    .btn-gold {
        background: var(--accent-gold); color: var(--primary-navy);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
    }
    .btn-gold:hover {
        background: var(--accent-gold-hover); transform: translateY(-2px);
    }
    .btn-outline {
        border: 2px solid var(--primary-navy); color: var(--primary-navy);
        background: transparent;
    }
    .btn-outline:hover {
        background: var(--primary-navy); color: var(--white);
    }
    
    /* New Gold Button Style (Ported from Header) */
    .btn-gold-styled {
        background: #ffb700; color: #000;
        text-decoration: none; padding: 12px 30px;
        border-radius: 50px; font-weight: 700; font-size: 1rem;
        transition: all 0.3s; text-align: center; border: 2px solid #ffb700;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .btn-gold-styled:hover { 
        background: var(--primary-navy); color: #ffffff;
        border-color: #ffb700; /* Yellow Border on Hover */
        transform: translateY(-2px); box-shadow: 0 4px 15px rgba(10, 17, 40, 0.3);
    }

    /* 
    ========================================
    HERO SECTION 
    ========================================
    */
    #hero {
        min-height: 100vh;
        display: flex; align-items: center;
        padding: 120px 0 60px;
        position: relative; overflow: hidden;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
    }

    .hero-container {
        display: flex; align-items: center; justify-content: space-between;
        gap: 4rem; width: 100%; max-width: 1300px; margin: 0 auto; padding: 0 20px;
    }

    .hero-content { flex: 1; z-index: 2; }
    
    .hero-content h1 {
        font-size: 3.5rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem;
        color: var(--primary-navy);
    }
    .hero-content h1 span { color: var(--accent-gold); }
    
    .hero-content p {
        font-size: 1.1rem; line-height: 1.8; color: var(--text-light);
        margin-bottom: 2.5rem; max-width: 550px;
    }

    .hero-visual {
        flex: 1; position: relative;
        display: flex; justify-content: center;
    }
    .hero-img {
        width: 100%; max-width: 600px;
        filter: drop-shadow(0 20px 40px rgba(0,0,0,0.15));
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    /* WHY SECTION STYLES (NEW) */
    #why { padding: 100px 0; background: #fff; scroll-margin-top: 100px; }

    .why-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px 50px;
        margin-top: 60px;
    }

    .why-item {
        display: flex;
        align-items: flex-start;
        gap: 30px;
    }

    .why-icon-circle {
        flex-shrink: 0;
        width: 140px;
        height: 140px;
        background: rgba(10, 17, 40, 0.05); /* Ivara Light Navy tint */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-navy); /* Ivara Navy */
        font-size: 3.5rem;
        transition: 0.3s;
    }

    .why-item:hover .why-icon-circle {
        transform: scale(1.05);
        background: var(--accent-gold); /* Ivara Gold on Hover */
        box-shadow: 0 10px 30px rgba(255, 193, 7, 0.3);
    }

    .why-text h3 {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 15px;
    }

    .why-text p {
        font-size: 1.05rem;
        color: var(--text-light);
        line-height: 1.7;
    }

    @media (max-width: 900px) {
        .why-grid { grid-template-columns: 1fr; }
        .why-item { flex-direction: column; text-align: center; align-items: center; }
    }

    /* Back To Top Button */
    #backToTop {
        position: fixed;
        bottom: 85px; /* Moved up 15px from 70px */
        right: 20px;  /* Moved left 5px from 15px */
        width: 50px;
        height: 50px;
        background: var(--accent-gold);
        color: var(--primary-navy);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 9999;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    #backToTop:hover { transform: translateY(-5px); background: var(--accent-gold-hover); }
    #backToTop.show { opacity: 1; visibility: visible; }

    /* Chatbot Reposition (Above Scroll Up) */
    iframe#chatbase-bubble-window {
        bottom: 160px !important; /* Raised to allow ScrollUp button below */
        right: 20px !important;
    }


    /* 
    ========================================
    CATEGORIES (Marketplace)
    ========================================
    */
    #marketplace { padding: 100px 0; background: var(--white); }
    
    .section-header { text-align: center; margin-bottom: 60px; }
    .section-header h2 {
        font-size: 2.5rem; font-weight: 700; color: var(--primary-navy);
        margin-bottom: 1rem; position: relative; display: inline-block;
    }
    .section-header h2::after {
        content: ''; display: block; width: 60px; height: 4px;
        background: var(--accent-gold); margin: 10px auto 0; border-radius: 2px;
    }
    .section-header p { color: var(--text-light); font-size: 1.1rem; max-width: 600px; margin: 0 auto; }

    .cat-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .cat-card {
        background: var(--white);
        border-radius: 20px; padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .cat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        border-color: var(--accent-gold);
    }

    .cat-icon-box {
        width: 80px; height: 80px;
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        border-radius: 20px; margin: 0 auto 20px;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent-gold); font-size: 2rem;
        box-shadow: 0 10px 20px rgba(10, 17, 40, 0.2);
    }
    
    .cat-card h3 { font-size: 1.25rem; margin-bottom: 15px; color: var(--primary-navy); }
    .cat-card p { font-size: 0.95rem; color: var(--text-light); line-height: 1.6; margin-bottom: 25px; }
    
    .cat-link {
        color: var(--primary-navy); font-weight: 600; font-size: 0.9rem;
        display: inline-flex; align-items: center; gap: 5px;
        transition: 0.3s;
    }
    .cat-link:hover { color: var(--accent-gold); gap: 10px; }

    /* 
    ========================================
    FEATURES & MOBILE APP
    ========================================
    */
    #mobile-app {
        padding: 100px 0;
        background: url('{{ asset("images/mobile_bg.png") }}') no-repeat center center / cover;
        color: var(--white);
        overflow: hidden;
    }

    .mobile-container {
        display: flex; align-items: center; justify-content: space-between;
        gap: 4rem; max-width: 1200px; margin: 0 auto; padding: 0 20px;
    }

    .mobile-content { flex: 1; }
    .mobile-content h2 { font-size: 2.5rem; margin-bottom: 1.5rem; font-weight: 700; }
    .mobile-content p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem; line-height: 1.8; }
    
    .app-btns { display: flex; gap: 1rem; }
    .store-btn {
        background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
        padding: 10px 20px; border-radius: 10px; display: flex; align-items: center; gap: 10px;
        color: var(--white); text-decoration: none; transition: 0.3s;
    }
    .store-btn:hover { background: var(--white); color: var(--primary-navy); }
    .store-icon { font-size: 1.8rem; }
    .store-text { display: flex; flex-direction: column; line-height: 1.2; }
    .store-text span { font-size: 0.7rem; }
    .store-text strong { font-size: 1rem; }

    .mobile-visual { flex: 1; position: relative; }
    .phone-mockup {
        width: 300px; margin: 0 auto;
        border-radius: 40px; border: 8px solid #000;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        overflow: hidden;
    }

    /* 
    ========================================
    PRICING
    ========================================
    */
    #pricing { padding: 100px 0; background: var(--bg-light); }
    
    .pricing-card {
        background: var(--white); border-radius: 20px; padding: 40px;
        text-align: center; position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: 0.3s;
    }
    .pricing-card.popular {
        transform: scale(1.05); border: 2px solid var(--accent-gold);
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        z-index: 2;
    }
    .pop-badge {
        position: absolute; top: -12px; left: 50%; transform: translateX(-50%);
        background: var(--accent-gold); color: var(--primary-navy);
        padding: 4px 15px; border-radius: 20px; font-weight: 700; font-size: 0.8rem;
    }
    
    .price-amount { font-size: 3rem; font-weight: 800; color: var(--primary-navy); margin: 20px 0; }
    .price-period { font-size: 1rem; color: var(--text-light); font-weight: 400; }
    
    .price-list { list-style: none; margin: 30px 0; text-align: left; }
    .price-list li { margin-bottom: 15px; font-size: 0.95rem; display: flex; align-items: center; gap: 10px; color: var(--text-light); }
    .price-list i { color: #28a745; }

    /* 
    ========================================
    CONTACT
    ========================================
    */
    #contact { padding: 100px 0; background: var(--white); }
    .contact-wrapper {
        display: flex; gap: 50px;
    }
    .contact-info { flex: 1; }
    .contact-form-box {
        flex: 1; background: var(--bg-light);
        padding: 40px; border-radius: 20px;
    }
    
    .form-grp { margin-bottom: 20px; }
    .form-control {
        width: 100%; padding: 15px; border: 1px solid #ddd;
        border-radius: 10px; font-family: inherit; font-size: 1rem;
        transition: 0.3s;
    }
    .form-control:focus { outline: none; border-color: var(--primary-navy); }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-container, .mobile-container, .contact-wrapper { flex-direction: column; text-align: center; }
        .hero-img { max-width: 80%; margin-top: 50px; }
        .mobile-content { margin-bottom: 50px; }
        .cat-grid { grid-template-columns: 1fr; }
        .pricing-card.popular { transform: none; margin: 20px 0; }
    }
    
    /* Mobile App Oblique Animation */
    .oblique-hover-effect {
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform: perspective(1500px) rotateY(-45deg) rotateZ(5deg); /* Increased Obliquity */
        box-shadow: -20px 20px 60px rgba(0,0,0,0.1); 
        border-radius: 20px;
    }
    .oblique-hover-effect:hover {
        transform: perspective(1500px) rotateY(0deg) rotateZ(0deg) scale(1.05); /* Straighten on Hover */
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }
    /* Typewriter Cursor */
    /* Typewriter Cursor */
    .cursor {
        display: inline-block;
        width: 4px;
        background-color: #ffb700; /* Yellow */
        animation: blink 1s infinite;
        margin-left: 2px;
        vertical-align: bottom;
        height: 1em; 
    }
    .typed-text {
        color: #0A1128 !important; /* Dark Blue Forced */
    }
    .cursor.typing { animation: none; }
    @keyframes blink {
        0% { opacity: 1; }
        49% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 0; }
    }
    /* BOOKING POPUP STYLES */
    .booking-modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(10, 17, 40, 0.75); backdrop-filter: blur(8px);
        z-index: 10000;
        display: none; align-items: center; justify-content: center;
    }
    .booking-modal-content {
        background: #fff; width: 800px; max-width: 95%; height: 500px; max-height: 90vh;
        border-radius: 20px; box-shadow: 0 25px 60px rgba(10, 17, 40, 0.4);
        display: flex; overflow: hidden; position: relative;
        animation: scaleUp 0.3s ease-out;
        border: 1px solid rgba(255, 183, 0, 0.1);
    }
    @keyframes scaleUp { from {transform: scale(0.9); opacity: 0;} to {transform: scale(1); opacity: 1;} }
    
    .bk-close-btn {
        position: absolute; top: 15px; right: 15px;
        width: 35px; height: 35px; border-radius: 50%;
        background: var(--white); border: 2px solid rgba(10, 17, 40, 0.1); 
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 1.2rem; color: var(--primary-navy); z-index: 10; 
        transition: all 0.3s ease;
    }
    .bk-close-btn:hover { 
        background: var(--accent-gold); 
        color: var(--primary-navy);
        transform: rotate(90deg);
        border-color: var(--accent-gold);
    }

    /* Left Form */
    .bk-left { flex: 1.2; padding: 25px; overflow-y: auto; background: var(--white); }
    .bk-title { 
        font-size: 1.6rem; font-weight: 800; 
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px; font-family: 'Poppins', sans-serif; 
    }
    .bk-subtitle { font-size: 0.85rem; color: #666; margin-bottom: 20px; line-height: 1.5; }

    .bk-row { display: flex; gap: 20px; margin-bottom: 15px; }
    .bk-group { flex: 1; }
    .bk-label { 
        display: block; font-size: 0.8rem; font-weight: 600; 
        color: var(--primary-navy); margin-bottom: 4px; 
    }
    .bk-input {
        width: 100%; padding: 10px 12px; 
        border: 2px solid rgba(10, 17, 40, 0.1); border-radius: 10px;
        font-size: 0.85rem; transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }
    .bk-input:focus { 
        outline: none; 
        border-color: var(--accent-gold); 
        box-shadow: 0 0 0 3px rgba(255, 183, 0, 0.15); 
    }
    
    .bk-btn {
        width: 100%; padding: 14px; 
        background: var(--accent-gold);
        color: var(--primary-navy); font-weight: 700; 
        border: 2px solid var(--accent-gold); border-radius: 50px; font-size: 1rem;
        cursor: pointer; transition: all 0.3s ease; margin-top: 10px;
    }
    .bk-btn:hover { 
        background: var(--primary-navy); 
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(10, 17, 40, 0.3);
    }

    /* Right Testimonial */
    .bk-right {
        flex: 1; 
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        padding: 25px; display: flex; align-items: center; justify-content: center;
        flex-direction: column; text-align: left;
    }
    .quote-card {
        background: rgba(255, 255, 255, 0.95); padding: 30px; border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: relative;
        border: 2px solid rgba(255, 183, 0, 0.2);
    }
    .quote-icon { 
        font-size: 3rem; 
        color: var(--accent-gold); 
        margin-bottom: 20px; display: block;
    } 
    .quote-text { 
        font-size: 1rem; line-height: 1.6; 
        color: #444; margin-bottom: 20px; font-style: italic; 
    }
    .quote-author { 
        font-weight: 800; 
        color: var(--primary-navy); 
        font-size: 1.1rem; 
    }
    .quote-pos { font-size: 0.85rem; color: #777; }
    
    .dont-show-again {
        margin-top: 15px; font-size: 0.8rem; 
        color: var(--primary-navy); cursor: pointer; text-decoration: underline;
        padding: 5px 10px; border-radius: 20px; 
        background: rgba(255, 183, 0, 0.1); display: inline-block;
        transition: all 0.3s ease;
    }
    .dont-show-again:hover { 
        background: var(--accent-gold); 
        color: var(--primary-navy);
        text-decoration: none;
    }

    @media(max-width: 900px) {
        .booking-modal-content { flex-direction: column; overflow-y: scroll; height: 100%; width: 100%; border-radius: 0; }
        .bk-right { display: none; } /* Hide testimonial on mobile to save space */
    }
</style>

<!-- HERO -->
<section id="hero">
    <div class="hero-container">
        <div class="hero-content reveal active">
            <h1><span class="typed-text"></span><span class="cursor">&nbsp;</span><br><span>Ecosystem</span></h1>
            <p>From Technical Repairs and Creative Lifestyle to Transport, Education, and Agriculture. IVARA connects you with the services you need, when you need them.</p>
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                 <a href="{{ route('register') }}" class="btn-gold-styled">Get Started</a>
                 <a href="#services" class="btn btn-outline">Explore Services</a>
            </div>
            
            <div style="margin-top: 40px; display: flex; gap: 30px; align-items: center;">
                <div>
                   <h3 style="font-size: 2rem; color: var(--primary-navy);">50k+</h3>
                   <span style="font-size: 0.9rem; color: var(--text-light);">Active Users</span>
                </div>
                <div style="width: 1px; height: 40px; background: #ddd;"></div>
                <div>
                   <h3 style="font-size: 2rem; color: var(--primary-navy);">9+</h3>
                   <span style="font-size: 0.9rem; color: var(--text-light);">Categories</span>
                </div>
            </div>
        </div>
        <div class="hero-visual reveal active" style="flex: 1.4; display: flex; justify-content: center; perspective: 2000px; z-index: 10; padding-top: 20px;">
            <!-- Advanced 3D Tilt Container for Hero Code -->
            <div class="hero-3d-card" id="heroTiltCard" style="position: relative; transform-style: preserve-3d; transition: transform 0.1s ease-out;">
                
                {{-- The Main Image --}}
                <img src="{{ asset('images/hero-dashboard-3d.png') }}" 
                     class="hero-img" 
                     alt="IVARA Dashboard"
                     style="width: 130%; max-width: none; margin-left: -15%; display: block; filter: drop-shadow(0 50px 100px rgba(0,0,0,0.35)); pointer-events: none;">
                
                {{-- Glare Overlay --}}
                <div class="hero-glare" style="position: absolute; top: 0; left: 0; width: 130%; margin-left: -15%; height: 100%; pointer-events: none; 
                     background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), rgba(255,255,255, 0.45) 0%, rgba(255,255,255,0) 60%); 
                     mix-blend-mode: overlay; opacity: 0; transition: opacity 0.3s; border-radius: 20px;"></div>
            </div>
        </div>
    </div>
</section>

<!-- WHY IVARA SECTION -->
<!-- WHY IVARA SECTION (Redesigned) -->
<section id="why" style="position: relative; padding: 100px 0; overflow: hidden;">
    <div class="container-custom" style="display: flex; flex-direction: row; align-items: center; gap: 50px;">
        
        {{-- Left Side: Visual --}}
        <div class="why-visual reveal" style="flex: 1.2; display: flex; justify-content: center; align-items: center; perspective: 1000px;">
            {{-- New Image with Tilt Effect --}}
            <img src="{{ asset('images/ivara_phone_mockup.png') }}" 
                 alt="IVARA App Interface" 
                 class="tilt-effect"
                 style="width: 100%; max-width: 650px; cursor: pointer;">
        </div>

        {{-- Right Side: Text Statements --}}
        <div class="why-text-content reveal" style="flex: 1; color: #475569; font-size: 1.05rem; line-height: 1.8;">
            <p style="margin-bottom: 25px;">
                <strong style="color: #0A1128;">IVARA.com</strong> is a premier platform for service seekers and providers, offering the fastest signup in the industry. We skip the lengthy downloads. Our app allows customers to book technical repairs, logistics, and professional services instantly with flexible membership plans if desired.
            </p>
            <p style="margin-bottom: 25px;">
                Referrals, ads, promotions, campaigns, and messaging are all integrated. Our <strong>backend dashboard</strong> gives you total control to make the app work best for you and your customers. Automated so that you can be up and running within minutes.
            </p>
            <p style="margin-bottom: 25px;">
                Designed with a robust set of features by industry experts to streamline service operations and increase revenue. Allowing the customer control to build loyalty and reduce churn.
            </p>
            <p>
                In today's fast paced world, businesses need every advantage. Our innovative management system is designed to streamline your operations, boost efficiency and elevate the customer experience.
            </p>
        </div>
    </div>
</section>
    
    <!-- BOOKING MODAL -->
    <div class="booking-modal-overlay" id="bookingModal">
        <div class="booking-modal-content">
            <button class="bk-close-btn" id="closeBookingBtn"><i class="fas fa-times"></i></button>
            
            <div class="bk-left">
                <h3 class="bk-title">Book a Free Consultation</h3>
                <p class="bk-subtitle">Please take a moment to fill out the form and schedule a personalized demonstration. An expert from our analysis team will get in touch with you soon.</p>
                
                <form id="bookingForm">
                     <div class="bk-row">
                         <div class="bk-group">
                             <label class="bk-label">Name</label>
                             <input type="text" name="name" class="bk-input" placeholder="Enter Your Full Name" required>
                         </div>
                         <div class="bk-group">
                             <label class="bk-label">Email</label>
                             <input type="email" name="email" class="bk-input" placeholder="Enter Your Email ID" required>
                         </div>
                     </div>

                     <div class="bk-row">
                         <div class="bk-group">
                             <label class="bk-label">Phone Number</label>
                             <input type="text" name="phone" class="bk-input" placeholder="Enter Your Phone Number" required>
                         </div>
                         <div class="bk-group">
                             <label class="bk-label">Your Budget</label>
                             <select name="budget" class="bk-input">
                                 <option value="Standard">Standard (500,000 - 2,000,000 FRW)</option>
                                 <option value="Premium">Premium (2,000,000 - 10,000,000 FRW)</option>
                                 <option value="Enterprise">Enterprise (10,000,000+ FRW)</option>
                             </select>
                         </div>
                     </div>

                     <div class="bk-group" style="margin-bottom: 20px;">
                        <label class="bk-label">Project Details</label>
                        <textarea name="details" class="bk-input" rows="4" placeholder="Enter your project details"></textarea>
                     </div>

                     <div style="display:flex; align-items: center; margin-bottom: 20px; font-size: 0.85rem; color: #666; gap: 10px;">
                        <input type="checkbox" required checked> I'm not a robot (ReCAPTCHA Mock)
                     </div>

                     <button type="submit" class="bk-btn">Let's Discuss Your Idea</button>
                     <div id="bookingMsg" style="margin-top:10px; font-size: 0.9rem; text-align: center;"></div>
                </form>
                
                {{-- Don't show again option --}}
                <div style="text-align: center;">
                    <span class="dont-show-again" id="dontShowBooking">Don't see it again</span>
                </div>
            </div>

            <div class="bk-right">
                <div class="quote-card">
                    <i class="fas fa-quote-left quote-icon"></i>
                    <p class="quote-text">Everything they said they would do they did and delivered on time. I can relax knowing that my startup is setting off on a good solid foundation.</p>
                    <div class="quote-author">Gilbert M</div>
                    <div class="quote-pos">CEO and Founder</div>
                    
                    <div style="margin-top: 20px; display: flex; gap: 5px;">
                        <div style="width: 30px; height: 4px; background: var(--accent-gold); border-radius: 2px; opacity: 0.3;"></div>
                        <div style="width: 30px; height: 4px; background: var(--accent-gold); border-radius: 2px; opacity: 0.3;"></div>
                        <div style="width: 30px; height: 4px; background: var(--accent-gold); border-radius: 2px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MARKETPLACE GRID -->
    <section id="services">
    <div class="container-custom">
        <div class="section-header reveal">
            <h2>Identify Your Category</h2>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Generic Tilt Effect (For existing small cards) ---
        const cards = document.querySelectorAll(".tilt-effect");
        cards.forEach(card => {
            card.style.transition = "transform 0.1s ease-out, filter 0.1s ease-out";
            card.addEventListener("mousemove", (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                // Max tilt 15deg
                const rotateX = ((y - centerY) / centerY) * -15;
                const rotateY = ((x - centerX) / centerX) * 15;
                const brightness = 1 + (((x - centerX) / centerX) * 0.15); 

                card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
                card.style.filter = `brightness(${brightness}) drop-shadow(0 20px 30px rgba(0,0,0,0.2))`;
            });
            card.addEventListener("mouseleave", () => {
                card.style.transform = "rotateX(0) rotateY(0) scale(1)";
                card.style.filter = "brightness(1)";
            });
        });

        // --- 2. Advanced Hero 3D Tilt with Glare ---
        const heroCard = document.getElementById('heroTiltCard');
        if(heroCard) {
            const container = heroCard.parentElement; // The .hero-visual container acts as the listener area
            const glare = heroCard.querySelector('.hero-glare');

            container.addEventListener('mousemove', (e) => {
                const rect = heroCard.getBoundingClientRect();
                // Calculate position relative to the CARD, not the container, for accurate center pivot
                const x = e.clientX - rect.left; 
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                // Stronger tilt for "Very Big" feel
                const rotateX = ((y - centerY) / centerY) * -12; // Inverted Y for natural tilt
                const rotateY = ((x - centerX) / centerX) * 12;

                // Apply Tilt
                heroCard.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;

                // Update Glare Position (CSS Variables)
                // Map x/y to percentage of width/height
                const xPct = (x / rect.width) * 100;
                const yPct = (y / rect.height) * 100;
                
                heroCard.style.setProperty('--x', `${xPct}%`);
                heroCard.style.setProperty('--y', `${yPct}%`);

                // Show Glare
                if(glare) glare.style.opacity = '1';
            });

            container.addEventListener('mouseleave', () => {
                heroCard.style.transform = `rotateX(0deg) rotateY(0deg) scale(1)`;
                if(glare) glare.style.opacity = '0';
            });
        }
        
        // Init Scroll Reveal
        reveal();
        window.addEventListener("scroll", reveal);
        
        // --- 4. Typewriter Effect ---
        const typedTextSpan = document.querySelector(".typed-text");
        const cursorSpan = document.querySelector(".cursor");

        const textArray = ["The #1 Service", "Empowering Service", "Economies"];
        const typingDelay = 100;
        const erasingDelay = 50;
        const newTextDelay = 2000; // Delay between current and next text
        let textArrayIndex = 0;
        let charIndex = 0;

        function type() {
            if (charIndex < textArray[textArrayIndex].length) {
                if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
                typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
                charIndex++;
                setTimeout(type, typingDelay);
            } else {
                cursorSpan.classList.remove("typing");
                setTimeout(erase, newTextDelay);
            }
        }

        function erase() {
            if (charIndex > 0) {
                if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
                typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(erase, erasingDelay);
            } else {
                cursorSpan.classList.remove("typing");
                textArrayIndex++;
                if(textArrayIndex >= textArray.length) textArrayIndex = 0;
                setTimeout(type, typingDelay + 1100);
            }
        }

        if(textArray.length) setTimeout(type, 250);
        
        // --- 5. Booking Logic ---
        initBookingPopup();
    });

    function initBookingPopup() {
        // Elements
        const modal = document.getElementById('bookingModal');
        const closeBtn = document.getElementById('closeBookingBtn');
        const dontShowBtn = document.getElementById('dontShowBooking');
        const form = document.getElementById('bookingForm');
        const msgDiv = document.getElementById('bookingMsg');

        // Logic
        const isSuspended = localStorage.getItem('ivara_booking_suspended');
        
        // First Open
        if (!isSuspended) {
            // Show after 1 second
            setTimeout(() => {
                modal.style.display = 'flex';
            }, 1000);

            // Re-open after 5 minutes (300,000 ms)
            setInterval(() => {
                if(modal.style.display === 'none' && !localStorage.getItem('ivara_booking_suspended')) {
                    modal.style.display = 'flex';
                }
            }, 300000); 
        }

        // Close
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Don't Show Again
        dontShowBtn.addEventListener('click', () => {
             localStorage.setItem('ivara_booking_suspended', 'true');
             modal.style.display = 'none';
             alert("We won't disturb you with this popup again.");
        });

        // Submit
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            btn.innerText = "Sending...";
            btn.disabled = true;

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('http://localhost:5001/api/booking', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if(response.ok) {
                    msgDiv.style.color = 'green';
                    msgDiv.innerText = result.message || "Booking Successful!";
                    setTimeout(() => {
                         modal.style.display = 'none';
                         form.reset();
                         btn.innerText = "Let's Discuss Your Idea";
                         btn.disabled = false;
                         msgDiv.innerText = "";
                    }, 2000);
                } else {
                    throw new Error(result.message || "Failed");
                }
            } catch (err) {
                 msgDiv.style.color = 'red';
                 msgDiv.innerText = "Error: " + err.message;
                 btn.innerText = "Let's Discuss Your Idea";
                 btn.disabled = false;
            }
        });
    }

    // --- 3. Scroll Reveal Animation (Existing) ---
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 150;
            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                // Optional: Keep them visible once revealed to avoid flickering
                // reveals[i].classList.remove("active"); 
            }
        }
    }
</script>
            <p>We've organized our services into 9 comprehensive categories to cater to every aspect of your life and business.</p>
        </div>

        <div class="cat-grid reveal">
            <!-- 1. Technical -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-tools"></i></div>
                <h3>Technical & Repair</h3>
                <p>Professional repair services for electronics, appliances, and industrial machinery.</p>
                <a href="{{ route('register') }}" class="cat-link">Register Device <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 2. Creative -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-palette"></i></div>
                <h3>Creative & Lifestyle</h3>
                <p>Connect with artists, designers, gym trainers, and lifestyle coaches.</p>
                <a href="{{ route('register') }}" class="cat-link">Find Talent <i class="fas fa-arrow-right"></i></a>
            </div>
            
             <!-- 3. Transport -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-car"></i></div>
                <h3>Transport & Travel</h3>
                <p>Seamless logistics, taxi services, tour guides, and vehicle rentals.</p>
                <a href="{{ route('register') }}" class="cat-link">Book Ride <i class="fas fa-arrow-right"></i></a>
            </div>
            
             <!-- 4. Food -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-utensils"></i></div>
                <h3>Food & Fashion</h3>
                <p>Culinary delights, fashion designers, catering services, and tailors.</p>
                <a href="{{ route('register') }}" class="cat-link">Discover <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 5. Education -->
             <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-graduation-cap"></i></div>
                <h3>Education</h3>
                <p>Online courses, private tutors, and educational materials.</p>
                <a href="{{ route('register') }}" class="cat-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 6. Agri -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-leaf"></i></div>
                <h3>Agri & Environment</h3>
                <p>Sustainable farming, agricultural consultants, and environment services.</p>
                <a href="{{ route('register') }}" class="cat-link">View Services <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 7. Legal -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-balance-scale"></i></div>
                <h3>Legal & Professional</h3>
                <p>Expert legal advice, business consulting, and professional services.</p>
                <a href="{{ route('register') }}" class="cat-link">Consult Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 8. Media -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-film"></i></div>
                <h3>Media & Entertainment</h3>
                <p>Event planners, media production, photography, and entertainment.</p>
                <a href="{{ route('register') }}" class="cat-link">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 9. Other -->
            <div class="cat-card">
                <div class="cat-icon-box"><i class="fas fa-ellipsis-h"></i></div>
                <h3>Other Services</h3>
                <p>Specialized services that don't fit the mold. Find niche experts here.</p>
                <a href="{{ route('register') }}" class="cat-link">See More <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- MOBILE APP SHOWCASE -->
<section id="mobile-app">
    <div class="mobile-container">
        <div class="mobile-content reveal">
             <h2>Experience IVARA<br>on Mobile</h2>
             <p>Manage your business, book services, and track payments on the go. The IVARA mobile app puts the power of our ecosystem in your pocket with real-time notifications and secure payments.</p>
             <div class="app-btns">
                 <a href="#" class="store-btn">
                     <i class="fab fa-apple store-icon"></i>
                     <div class="store-text"><span>Download on</span><strong>App Store</strong></div>
                 </a>
                  <a href="#" class="store-btn">
                     <i class="fab fa-google-play store-icon"></i>
                     <div class="store-text"><span>Get it on</span><strong>Google Play</strong></div>
                 </a>
             </div>
        </div>
        <div class="mobile-visual reveal" style="flex: 1.5; display: flex; justify-content: center; align-items: center;">
             {{-- New Mobile App Showcase Image --}}
             <img src="{{ asset('images/mobile_app_showcase.png') }}" 
                  class="oblique-hover-effect"
                  alt="IVARA Mobile App" 
                  style="width: 100%; max-width: 100%; object-fit: contain;">
        </div>
    </div>
</section>

<!-- PRICING -->
<section id="pricing">
    <div class="container-custom">
        <div class="section-header reveal">
            <h2>Flexible Pricing</h2>
            <p>Choose the plan that fits your needs.</p>
        </div>
        
        <div class="cat-grid reveal">
            @if(isset($pricingPlans) && count($pricingPlans) > 0)
                @foreach($pricingPlans as $plan)
                    <div class="pricing-card {{ $plan['isPopular'] ? 'popular' : '' }}">
                        @if($plan['isPopular'])
                            <div class="pop-badge">POPULAR</div>
                        @endif
                        <h4>{{ $plan['name'] }}</h4>
                        <!-- Display Price and Handle Period -->
                        <div class="price-amount">
                            {{ $plan['price'] }}
                            @if(!empty($plan['period']))
                                <span class="price-period">{{ $plan['period'] }}</span>
                            @endif
                        </div>
                        
                        <ul class="price-list">
                            @foreach($plan['features'] as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature['text'] }}</li>
                            @endforeach
                        </ul>
                        
                        <a href="{{ $plan['buttonLink'] ?? route('register') }}" 
                           class="btn {{ $plan['buttonStyle'] == 'primary' ? 'btn-primary' : 'btn-outline' }}" 
                           style="width:100%">
                           {{ $plan['buttonText'] }}
                        </a>
                    </div>
                @endforeach
            @else
                {{-- Fallback if API fails: Render Hardcoded layout as safety net --}}
                <div class="pricing-card">
                    <h4>Starter</h4>
                    <div class="price-amount">Free</div>
                     <ul class="price-list">
                        <li><i class="fas fa-check"></i> 1 Service Category</li>
                        <li><i class="fas fa-check"></i> Basic Dashboard</li>
                        <li><i class="fas fa-check"></i> Community Support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%">Get Started</a>
                </div>

                <div class="pricing-card popular">
                    <div class="pop-badge">POPULAR</div>
                    <h4>Professional</h4>
                    <div class="price-amount">29,000 FRW<span class="price-period">/mo</span></div>
                    <ul class="price-list">
                        <li><i class="fas fa-check"></i> 3 Service Categories</li>
                        <li><i class="fas fa-check"></i> Advanced Analytics</li>
                        <li><i class="fas fa-check"></i> Priority Support</li>
                        <li><i class="fas fa-check"></i> Marketing Tools</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-primary" style="width:100%">Sign Up Now</a>
                </div>

                <div class="pricing-card">
                    <h4>Enterprise</h4>
                    <div class="price-amount">Custom</div>
                    <ul class="price-list">
                        <li><i class="fas fa-check"></i> Unlimited Categories</li>
                        <li><i class="fas fa-check"></i> Dedicated Manager</li>
                        <li><i class="fas fa-check"></i> API Access</li>
                        <li><i class="fas fa-check"></i> Custom Reporting</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%">Contact Sales</a>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- SUPPORT SECTION (Background Updated) -->
<section id="support" style="position: relative; overflow: hidden; padding: 100px 0;">
    
    {{-- Animated Background Image Layer --}}
    <div class="support-bg-animate" style="
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('images/support_bg.png') }}') no-repeat left center;
        background-size: 50% auto; 
        opacity: 0.6; /* Increased opacity as requested */
        z-index: 0;
    "></div>

    <div class="container-custom" style="position: relative; z-index: 1;">
        <div class="contact-wrapper reveal">
            <div class="contact-info" style="text-shadow: 0 2px 15px rgba(255,255,255,0.9);">
                <h2>Get in Touch</h2>
                <p>Have questions? We're here to help. Reach out to our team for support or partnership inquiries.</p>
                
                <div style="margin-top: 30px; display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="width: 40px; height: 40px; background: rgba(10,17,40,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-navy);"><i class="fas fa-envelope"></i></div>
                        <span>support@ivara.com</span>
                    </div>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="width: 40px; height: 40px; background: rgba(10,17,40,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-navy);"><i class="fas fa-phone"></i></div>
                        <span>+250 788 446 936</span>
                    </div>
                     {{-- WhatsApp Web Chat Button (New Request) --}}
                    <div style="margin-top: 10px;">
                        <a href="https://wa.me/250788446936" target="_blank" class="btn border-0 text-white font-weight-bold" style="background-color: #25D366; display: inline-flex; align-items: center; gap: 10px; padding: 10px 20px; border-radius: 8px;">
                            <i class="fab fa-whatsapp" style="font-size: 1.2rem;"></i> Chat on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-box">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subject" value="Landing Page Inquiry">
                     <div class="form-grp">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-grp">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-grp">
                        <textarea name="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
/* SLIGHT BACKGROUND ANIMATION */
@keyframes bgDrift {
    0% { transform: scale(1) translate(0, 0); }
    50% { transform: scale(1.05) translate(-10px, -5px); }
    100% { transform: scale(1) translate(0, 0); }
}
.support-bg-animate {
    animation: bgDrift 20s infinite ease-in-out;
}
</style>

<!-- BACK TO TOP BUTTON -->
<div id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
    <i class="fas fa-arrow-up"></i>
</div>

@include('layouts.footer')

@include('web.chatboot')
@endsection

@section('scripts')
<script>
    // Scroll Reveal
    const revealElements = document.querySelectorAll('.reveal');
    const revealOnScroll = () => {
        const windowHeight = window.innerHeight;
        const elementVisible = 100;
        revealElements.forEach((reveal) => {
            const elementTop = reveal.getBoundingClientRect().top;
            if (elementTop < windowHeight - elementVisible) {
                reveal.classList.add('active');
            }
        });
    };
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();

    // Back to top visibility
    window.addEventListener('scroll', () => {
        const backToTop = document.getElementById('backToTop');
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
    
    // Add active class for CSS fade-in
    document.addEventListener("DOMContentLoaded", function(){
        const reveals = document.querySelectorAll(".reveal");
        reveals.forEach(r => r.style.opacity = "1"); // For fallback if JS fails
    });
</script>

<style>
.reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease; }
.reveal.active { opacity: 1; transform: translateY(0); }
</style>
@endsection
