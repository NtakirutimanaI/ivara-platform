@extends('layouts.app')

@section('title', 'B2B Wholesale Marketplace - IVARA')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #ffb700;
        --bg-light: #f8f9fa;
    }

    .b2b-container {
        font-family: 'Poppins', sans-serif;
    }

    /* Hero Section */
    .b2b-hero {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        padding: 80px 20px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .b2b-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect fill="%23ffb700" opacity="0.03" width="50" height="50"/></svg>');
        animation: movePattern 20s linear infinite;
    }

    @keyframes movePattern {
        0% { transform: translateX(0) translateY(0); }
        100% { transform: translateX(100px) translateY(100px); }
    }

    .b2b-hero-content {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .b2b-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .b2b-hero h1 .highlight {
        color: var(--accent-gold);
    }

    .b2b-hero p {
        font-size: 1.3rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .b2b-hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-hero-primary {
        background: var(--accent-gold);
        color: var(--primary-navy);
        padding: 15px 40px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-hero-primary:hover {
        background: #ffc933;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(255, 183, 0, 0.4);
    }

    .btn-hero-secondary {
        background: transparent;
        color: white;
        padding: 15px 40px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s;
        border: 2px solid white;
    }

    .btn-hero-secondary:hover {
        background: white;
        color: var(--primary-navy);
    }

    /* Stats Section */
    .b2b-stats {
        background: white;
        padding: 60px 20px;
        box-shadow: 0 -10px 40px rgba(0,0,0,0.05);
    }

    .stats-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--accent-gold);
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1rem;
        color: #666;
        font-weight: 600;
    }

    /* Features Section */
    .b2b-features {
        padding: 80px 20px;
        background: var(--bg-light);
    }

    .features-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 50px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .feature-card {
        background: white;
        padding: 40px 30px;
        border-radius: 16px;
        text-align: center;
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        border-color: var(--accent-gold);
        box-shadow: 0 15px 40px rgba(10, 17, 40, 0.1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-navy), var(--secondary-navy));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--accent-gold);
        font-size: 2rem;
    }

    .feature-card h3 {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 15px;
    }

    .feature-card p {
        color: #666;
        line-height: 1.6;
    }

    /* CTA Section */
    .b2b-cta {
        background: linear-gradient(135deg, var(--accent-gold) 0%, #ffc933 100%);
        padding: 80px 20px;
        text-align: center;
    }

    .b2b-cta h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 20px;
    }

    .b2b-cta p {
        font-size: 1.2rem;
        color: var(--secondary-navy);
        margin-bottom: 30px;
    }

    .cta-form {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--primary-navy);
        margin-bottom: 8px;
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-group input:focus, .form-group select:focus {
        outline: none;
        border-color: var(--accent-gold);
        box-shadow: 0 0 0 3px rgba(255, 183, 0, 0.1);
    }

    .btn-submit {
        width: 100%;
        background: var(--primary-navy);
        color: white;
        padding: 15px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        background: var(--secondary-navy);
        transform: translateY(-2px);
    }

    @media (max-width: 968px) {
        .b2b-hero h1 { font-size: 2.5rem; }
        .features-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="b2b-container">
    <!-- Hero Section -->
    <section class="b2b-hero">
        <div class="b2b-hero-content">
            <h1>Welcome to <span class="highlight">IVARA B2B</span> Wholesale Marketplace</h1>
            <p>Connect with verified suppliers and buyers. Trade in bulk. Grow your business.</p>
            <div class="b2b-hero-buttons">
                <a href="#register" class="btn-hero-primary">
                    <i class="fas fa-rocket"></i> Register Your Company
                </a>
                <a href="#features" class="btn-hero-secondary">
                    <i class="fas fa-info-circle"></i> Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="b2b-stats">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Verified Companies</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Products Listed</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">₣2.5B</div>
                <div class="stat-label">Trade Volume</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Countries</div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="b2b-features" id="features">
        <div class="features-container">
            <h2 class="section-title">Why Choose IVARA B2B?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>Verified Businesses</h3>
                    <p>All companies are verified with document checks ensuring legitimate business relationships.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Volume Pricing</h3>
                    <p>Get better prices with tiered pricing based on order quantity. More you buy, more you save.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3>RFQ System</h3>
                    <p>Request quotations from multiple suppliers and compare offers to get the best deal.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Payment Terms</h3>
                    <p>Flexible payment options including NET 30, NET 60, and credit facilities for verified businesses.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>Logistics Support</h3>
                    <p>Integrated logistics partners for efficient delivery of bulk orders across Rwanda and beyond.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Secure Transactions</h3>
                    <p>Escrow services and transaction protection ensure safe business deals for both parties.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA / Registration Section -->
    <section class="b2b-cta" id="register">
        <h2>Ready to Start Trading?</h2>
        <p>Register your company now and get access to thousands of wholesale opportunities</p>
        
        <div class="cta-form">
            <form action="{{ route('b2b.register.interest') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="companyName">Company Name *</label>
                    <input type="text" id="companyName" name="company_name" required>
                </div>

                <div class="form-group">
                    <label for="businessType">Business Type *</label>
                    <select id="businessType" name="business_type" required>
                        <option value="">Select type</option>
                        <option value="manufacturer">Manufacturer</option>
                        <option value="distributor">Distributor</option>
                        <option value="wholesaler">Wholesaler</option>
                        <option value="retailer">Retailer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contactName">Contact Person *</label>
                    <input type="text" id="contactName" name="contact_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Business Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Register Interest
                </button>
            </form>

            @if(session('success'))
                <div style="margin-top: 20px; padding: 15px; background: #d4edda; color: #155724; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </section>
</div>

@include('layouts.footer')
@endsection
