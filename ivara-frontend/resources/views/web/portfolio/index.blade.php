@extends('layouts.app')

@section('title', 'Portfolio - IVARA')


@section('styles')
<style>
    :root {
        --navy-dark: #0A1128;
        --navy-light: #1c2744;
        --gold: #ffb700;
        --text-grey: #94a3b8;
        --blue-accent: #3b82f6;
        --green-accent: #10b981;
    }
    
    /* Base Styles */
    body { 
        background: linear-gradient(135deg, #0A1128 0%, #1a1f3a 100%); 
        color: white;
        padding-top: 0;
        margin: 0;
    }

    /* HERO SECTION */
    .pf-hero {
        padding: 180px 0 100px;
        text-align: center;
        background: linear-gradient(135deg, rgba(10, 17, 40, 0.95) 0%, rgba(28, 39, 68, 0.95) 100%);
        position: relative;
        overflow: hidden;
    }
    
    .pf-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(59, 130, 246, 0.1), transparent 50%),
                    radial-gradient(circle at 70% 50%, rgba(16, 185, 129, 0.1), transparent 50%);
        pointer-events: none;
    }
    
    .pf-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 25px;
        background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
        z-index: 1;
    }
    
    .pf-hero p { 
        color: var(--text-grey);
        max-width: 700px;
        margin: 0 auto;
        font-size: 1.2rem;
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    /* SECTION CONTAINERS */
    .pf-section { 
        padding: 100px 0;
        position: relative;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 80px;
        position: relative;
    }
    
    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 24px;
        border-radius: 50px;
        background: rgba(255, 183, 0, 0.1);
        color: var(--gold);
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 183, 0, 0.3);
    }
    
    .section-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin: 20px 0;
        color: white;
        line-height: 1.2;
    }
    
    .section-description {
        color: var(--text-grey);
        max-width: 700px;
        margin: 0 auto;
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* CLIENT STATS CARDS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 60px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, rgba(28, 39, 68, 0.6) 0%, rgba(15, 23, 42, 0.6) 100%);
        padding: 45px 30px;
        border-radius: 20px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--stat-color), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-10px);
        border-color: rgba(255, 183, 0, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .stat-card:hover::before {
        opacity: 1;
    }
    
    .stat-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(var(--stat-rgb), 0.2), rgba(var(--stat-rgb), 0.05));
        border: 2px solid rgba(var(--stat-rgb), 0.3);
    }
    
    .stat-icon i {
        font-size: 2.2rem;
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 12px;
        background: linear-gradient(135deg, var(--stat-color), rgba(255, 255, 255, 0.8));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .stat-label {
        color: #cbd5e1;
        font-size: 1.1rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* PROJECT CARDS */
    .project-card {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 60px;
        align-items: center;
        margin-bottom: 100px;
        scroll-margin-top: 100px;
        opacity: 0;
        transform: translateY(50px);
        transition: 0.8s ease-out;
        background: linear-gradient(135deg, rgba(28, 39, 68, 0.4) 0%, rgba(15, 23, 42, 0.4) 100%);
        padding: 50px;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .project-card.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .project-card:nth-child(even) {
        grid-template-columns: 1fr 1.2fr;
    }
    
    .project-card:nth-child(even) .project-visual {
        order: 2;
    }
    
    /* Visual Half */
    .project-visual {
        position: relative;
        perspective: 1000px;
    }
    
    .project-img {
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        transition: transform 0.4s ease;
        cursor: pointer;
    }
    
    .project-visual:hover .project-img {
        transform: rotateY(-3deg) rotateX(3deg) scale(1.03);
    }
    
    /* Content Half */
    .project-badge {
        display: inline-block;
        padding: 6px 18px;
        border-radius: 50px;
        background: rgba(255, 183, 0, 0.15);
        color: var(--gold);
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 183, 0, 0.3);
    }
    
    .project-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.3;
        color: white;
    }
    
    .project-desc {
        color: #cbd5e1;
        line-height: 1.9;
        margin-bottom: 30px;
        font-size: 1.05rem;
    }

    .tech-stack {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 35px;
    }
    
    .tech-pill {
        background: rgba(59, 130, 246, 0.15);
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.85rem;
        color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, 0.3);
        font-weight: 500;
    }

    .btn-project {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: linear-gradient(135deg, var(--gold) 0%, #ffa500 100%);
        color: #000;
        font-weight: 700;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(255, 183, 0, 0.3);
    }
    
    .btn-project:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 183, 0, 0.4);
    }

    /* TESTIMONIAL CARDS */
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 35px;
        margin-top: 60px;
    }
    
    .testimonial-card {
        background: linear-gradient(135deg, rgba(28, 39, 68, 0.6) 0%, rgba(15, 23, 42, 0.6) 100%);
        padding: 40px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        position: relative;
        transition: all 0.3s ease;
    }
    
    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 30px;
        font-size: 80px;
        color: rgba(255, 183, 0, 0.1);
        font-family: Georgia, serif;
        line-height: 1;
    }
    
    .testimonial-card:hover {
        transform: translateY(-8px);
        border-color: rgba(255, 183, 0, 0.3);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .testimonial-rating {
        display: flex;
        gap: 8px;
        margin-bottom: 25px;
    }
    
    .testimonial-rating i {
        color: var(--gold);
        font-size: 1.1rem;
    }
    
    .testimonial-text {
        color: #e2e8f0;
        line-height: 1.9;
        margin-bottom: 30px;
        font-style: italic;
        font-size: 1.05rem;
        position: relative;
        z-index: 1;
    }
    
    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    
    .testimonial-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 3px solid var(--gold);
        box-shadow: 0 4px 12px rgba(255, 183, 0, 0.3);
    }
    
    .testimonial-name {
        margin: 0;
        font-weight: 700;
        color: white;
        font-size: 1.1rem;
    }
    
    .testimonial-position {
        margin: 0;
        font-size: 0.9rem;
        color: var(--text-grey);
        margin-top: 4px;
    }

    /* Separator */
    .divider-line {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.15), transparent);
        margin: 80px 0;
    }
    
    /* Empty States */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 40px;
        background: rgba(28, 39, 68, 0.3);
        border-radius: 20px;
        border: 2px dashed rgba(255, 255, 255, 0.1);
    }
    
    .empty-state i {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.2);
        margin-bottom: 20px;
    }
    
    .empty-state p {
        color: var(--text-grey);
        font-size: 1.1rem;
    }

    /* Mobile Responsive */
    @media(max-width: 900px) {
        .pf-hero h1 { font-size: 2.5rem; }
        .section-title { font-size: 2.2rem; }
        .project-card { 
            grid-template-columns: 1fr !important;
            gap: 30px;
            padding: 35px;
        }
        .project-card:nth-child(even) .project-visual { order: 1; }
        .testimonials-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: 1fr; }
        .success-story { margin-bottom: 60px; }
        .story-metrics { grid-template-columns: 1fr; }
    }

    /* SUCCESS STORIES - UNIQUE DESIGN */
    .success-story {
        position: relative;
        margin-bottom: 120px;
        padding-left: 80px;
    }
    
    .success-story::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: -60px;
        width: 3px;
        background: linear-gradient(180deg, var(--gold) 0%, rgba(255, 183, 0, 0.1) 100%);
    }
    
    .success-story:last-child::before {
        background: linear-gradient(180deg, var(--gold) 0%, transparent 100%);
    }
    
    .story-number {
        position: absolute;
        left: 0;
        top: 0;
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, var(--gold) 0%, #ffa500 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.2rem;
        color: #000;
        box-shadow: 0 8px 24px rgba(255, 183, 0, 0.4);
        z-index: 2;
    }
    
    .story-card {
        background: linear-gradient(135deg, rgba(28, 39, 68, 0.8) 0%, rgba(15, 23, 42, 0.8) 100%);
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s ease;
    }
    
    .story-card:hover {
        transform: translateX(10px);
        border-color: rgba(255, 183, 0, 0.4);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    }
    
    .story-header {
        position: relative;
        height: 300px;
        overflow: hidden;
    }
    
    .story-header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .story-card:hover .story-header img {
        transform: scale(1.1);
    }
    
    .story-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 40px;
        background: linear-gradient(to top, rgba(10, 17, 40, 0.95), transparent);
    }
    
    .story-category {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(255, 183, 0, 0.2);
        border: 1px solid var(--gold);
        border-radius: 50px;
        color: var(--gold);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    
    .story-company {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin: 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }
    
    .story-content {
        padding: 40px;
    }
    
    .story-challenge {
        margin-bottom: 30px;
        padding: 25px;
        background: rgba(239, 68, 68, 0.1);
        border-left: 4px solid #ef4444;
        border-radius: 12px;
    }
    
    .story-challenge h4 {
        color: #fca5a5;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    
    .story-challenge p {
        color: #e5e7eb;
        line-height: 1.8;
        margin: 0;
    }
    
    .story-solution {
        margin-bottom: 30px;
        padding: 25px;
        background: rgba(16, 185, 129, 0.1);
        border-left: 4px solid #10b981;
        border-radius: 12px;
    }
    
    .story-solution h4 {
        color: #6ee7b7;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    
    .story-solution p {
        color: #e5e7eb;
        line-height: 1.8;
        margin: 0;
    }
    
    .story-metrics {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .metric-item {
        text-align: center;
        padding: 20px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 16px;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .metric-value {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }
    
    .metric-label {
        color: #94a3b8;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .story-tech {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
    }
    
    .story-tech-tag {
        padding: 8px 16px;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 8px;
        color: #c4b5fd;
        font-size: 0.85rem;
        font-weight: 600;
    }
    
    .story-quote {
        margin-top: 30px;
        padding: 30px;
        background: linear-gradient(135deg, rgba(255, 183, 0, 0.1) 0%, rgba(255, 183, 0, 0.05) 100%);
        border-radius: 16px;
        border-left: 4px solid var(--gold);
        position: relative;
    }
    
    .story-quote::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 60px;
        color: rgba(255, 183, 0, 0.2);
        font-family: Georgia, serif;
        line-height: 1;
    }
    
    .story-quote-text {
        font-size: 1.1rem;
        font-style: italic;
        color: #f3f4f6;
        line-height: 1.8;
        margin-bottom: 15px;
        padding-left: 30px;
    }
    
    .story-quote-author {
        color: var(--gold);
        font-weight: 700;
        padding-left: 30px;
    }
</style>
@endsection

@section('content')

<div class="pf-hero">
    <div class="container-custom">
        <h1>Transforming Ideas<br>Into Reality</h1>
        <p>Explore our curated portfolio of successful projects, spanning robust software solutions, creative branding, and industrial innovation.</p>
    </div>
</div>

<div class="container-custom pf-section">
    {{-- CLIENTS SECTION --}}
    <div id="clients" style="scroll-margin-top: 100px;">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-users"></i> Our Clients</span>
            <h2 class="section-title">5000+ Projects Delivered Worldwide</h2>
            <p class="section-description">Explore how we helped entrepreneurs, startups, and enterprises transform their ideas into successful digital products.</p>
        </div>

        <div class="stats-grid">
            @forelse($clientStats as $stat)
                @php
                    $rgb = sscanf($stat['color'], "#%02x%02x%02x");
                @endphp
                <div class="stat-card" style="--stat-color: {{ $stat['color'] }}; --stat-rgb: {{ $rgb[0] }}, {{ $rgb[1] }}, {{ $rgb[2] }};">
                    <div class="stat-icon">
                        <i class="fas {{ $stat['icon'] }}" style="color: {{ $stat['color'] }};"></i>
                    </div>
                    <h3 class="stat-number">{{ $stat['number'] }}</h3>
                    <p class="stat-label">{{ $stat['label'] }}</p>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-chart-bar"></i>
                    <p>No statistics available yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="divider-line"></div>

    {{-- SUCCESS STORIES SECTION --}}
    <div id="success-stories" style="scroll-margin-top: 100px;">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-trophy"></i> Success Stories</span>
            <h2 class="section-title">Climbing the Ladder of Success</h2>
            <p class="section-description">Discover the transformative journeys of our clients and how IVARA turned their challenges into triumphs.</p>
        </div>

        @if(count($portfolios) > 0)
            @foreach($portfolios as $index => $project)
                <div class="success-story reveal-pf" id="project-{{ $project['slug'] ?? $project['_id'] }}">
                    <div class="story-number">{{ $index + 1 }}</div>
                    
                    <div class="story-card">
                        {{-- Story Header with Image --}}
                        <div class="story-header">
                            <img src="{{ $project['image'] ?? 'https://via.placeholder.com/1200x400?text=' . urlencode($project['title']) }}" 
                                 alt="{{ $project['title'] }}">
                            <div class="story-overlay">
                                <span class="story-category">{{ $project['category'] ?? 'Technology' }}</span>
                                <h3 class="story-company">{{ $project['title'] }}</h3>
                            </div>
                        </div>

                        {{-- Story Content --}}
                        <div class="story-content">
                            {{-- Challenge --}}
                            <div class="story-challenge">
                                <h4><i class="fas fa-exclamation-triangle"></i> The Challenge</h4>
                                <p>{{ $project['challenge'] ?? $project['description'] ?? 'Our client faced scalability issues and needed a robust solution to handle rapid growth while maintaining performance and user experience.' }}</p>
                            </div>

                            {{-- Solution --}}
                            <div class="story-solution">
                                <h4><i class="fas fa-lightbulb"></i> Our Solution</h4>
                                <p>{{ $project['solution'] ?? 'IVARA delivered a comprehensive digital transformation strategy, implementing cutting-edge technologies and best practices to create a scalable, future-proof solution.' }}</p>
                            </div>

                            {{-- Results/Metrics --}}
                            @if(isset($project['metrics']) || isset($project['results']))
                                <div class="story-metrics">
                                    @foreach($project['metrics'] ?? $project['results'] ?? [] as $metric)
                                        <div class="metric-item">
                                            <div class="metric-value">{{ $metric['value'] ?? '200%' }}</div>
                                            <div class="metric-label">{{ $metric['label'] ?? 'Growth' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="story-metrics">
                                    <div class="metric-item">
                                        <div class="metric-value">300%</div>
                                        <div class="metric-label">Revenue Increase</div>
                                    </div>
                                    <div class="metric-item">
                                        <div class="metric-value">85%</div>
                                        <div class="metric-label">Time Saved</div>
                                    </div>
                                    <div class="metric-item">
                                        <div class="metric-value">10k+</div>
                                        <div class="metric-label">New Users</div>
                                    </div>
                                </div>
                            @endif

                            {{-- Technologies Used --}}
                            @if(isset($project['technologies']) && count($project['technologies']) > 0)
                                <div class="story-tech">
                                    @foreach($project['technologies'] as $tech)
                                        <span class="story-tech-tag">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Client Quote --}}
                            <div class="story-quote">
                                <p class="story-quote-text">
                                    {{ $project['testimonial'] ?? '"Working with IVARA was a game-changer for our business. Their expertise and dedication transformed our vision into reality, exceeding all expectations."' }}
                                </p>
                                <div class="story-quote-author">
                                    - {{ $project['client_name'] ?? 'CEO' }}, {{ $project['client_company'] ?? $project['title'] }}
                                </div>
                            </div>

                            {{-- View Project Link --}}
                            @if(!empty($project['link']) && $project['link'] != '#')
                                <div style="margin-top: 30px; text-align: center;">
                                    <a href="{{ $project['link'] }}" target="_blank" class="btn-project">
                                        View Full Case Study <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-rocket"></i>
                <p>Success stories are being prepared. Check back soon!</p>
            </div>
        @endif
    </div>

    <div class="divider-line"></div>

    {{-- TESTIMONIALS & REVIEWS SECTION --}}
    <div id="testimonials" style="scroll-margin-top: 100px;">
        <div class="section-header">
            <span class="section-badge"><i class="fas fa-star"></i> Client Testimonials</span>
            <h2 class="section-title">What Our Clients Say</h2>
            <p class="section-description">See what our clients say about our team and IVARA Ecosystem. Real feedback from real people.</p>
        </div>

        <div class="testimonials-grid">
            @forelse($testimonials as $testimonial)
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
                    <div class="testimonial-author">
                        <img src="{{ $testimonial['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($testimonial['name']) . '&background=3b82f6&color=fff' }}" 
                             alt="{{ $testimonial['name'] }}" 
                             class="testimonial-avatar">
                        <div>
                            <h5 class="testimonial-name">{{ $testimonial['name'] }}</h5>
                            <p class="testimonial-position">{{ $testimonial['role'] }}, {{ $testimonial['company'] }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-comments"></i>
                    <p>No testimonials available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Simple Reveal on Scroll
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.reveal-pf').forEach((el) => observer.observe(el));

        // Smooth scroll to anchor if present in URL
        if(window.location.hash) {
            setTimeout(() => {
                const target = document.querySelector(window.location.hash);
                if(target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 100);
        }
    });
</script>
@endsection
