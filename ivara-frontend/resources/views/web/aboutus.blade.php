@extends('layouts.app')

@section('title', 'About IVARA - Our Story')

@section('content')
<div class="about-hero">
    <div class="container-custom">
        <h1>Empowering Service Economies</h1>
        <p>Our mission is to create a seamless, integrated ecosystem for service providers and seekers across Africa and beyond.</p>
    </div>
</div>

<div class="container-custom section-padding">
    <div class="row">
        <div class="col-text" style="flex:1; padding-right: 50px;">
             <h2>Who We Are</h2>
             <p>IVARA is more than just a marketplace; it is a digital infrastructure designed to formalize and boost the service economy. Whether you are a technician, a creative artist, or an agricultural expert, IVARA provides the tools you need to reach a wider audience and manage your business professionally.</p>
             <p>Founded on the principles of reliability, speed, and trust, we bridge the gap between talent and opportunity.</p>
        </div>
        <div class="col-img" style="flex:1;">
             <img src="{{ asset('images/about_us_team.png') }}" onerror="this.src='https://via.placeholder.com/600x400'" style="width:100%; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>
    </div>
</div>

<style>
    .about-hero { background: linear-gradient(135deg, #0A1128, #162447); color: white; padding: 150px 0 80px; text-align: center; }
    .about-hero h1 { font-size: 3.5rem; font-weight: 800; margin-bottom: 20px; }
    .about-hero p { font-size: 1.2rem; max-width: 700px; margin: 0 auto; opacity: 0.9; }
    
    .section-padding { padding: 100px 20px; }
    .row { display: flex; align-items: center; }
    @media(max-width: 768px) { .row { flex-direction: column; gap: 40px; } .col-text{padding:0!important;} }
    
    h2 { font-size: 2.5rem; color: #0A1128; margin-bottom: 30px; font-weight: 700; }
    p { font-size: 1.1rem; color: #555; line-height: 1.8; margin-bottom: 20px; }
</style>
@endsection
