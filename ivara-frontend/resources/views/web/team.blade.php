@include('layouts.header')
<style>
    /* Your base styles from previous snippet */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; background-color: #f9f9f9; color: #333; }
    a { text-decoration: none; color: inherit; }
    .container { width: 90%; max-width: 1200px; margin: 0 auto; padding: 40px 0; }

    .about-header { text-align: center; padding: 40px 20px; background: linear-gradient(to right, #071839, #ffc107); color: #fff; border-radius: 12px; margin-bottom: 40px; animation: fadeInDown 1s ease forwards; }
    .about-header h1 { font-size: 2.5rem; margin-bottom: 10px; }
    .about-header p { font-size: 1.2rem; }

    .team-section { display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; }
    .team-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.1); width: 250px; text-align: center; transition: transform 0.5s ease; }
    .team-card:hover { transform: translateY(-10px); }
    .team-card img { width: 100%; height: 250px; object-fit: cover; }
    .team-card h3 { margin: 10px 0 5px; color: #071839; }
    .team-card p { font-size: 0.9rem; margin-bottom: 5px; color: #555; }
    .social-icons { display: flex; justify-content: center; gap: 10px; margin-bottom: 10px; }
    .social-icons a { color: #071839; font-size: 1.2rem; transition: color 0.3s; }
    .social-icons a:hover { color: #ffc107; }

    .about-content { text-align: center; margin-bottom: 50px; }
    .about-content h2 { font-size: 2rem; margin-bottom: 20px; color: #071839; }
    .about-content p { font-size: 1.1rem; margin-bottom: 16px; }

    /* Animations */
    @keyframes fadeInDown { from { opacity:0; transform: translateY(-50px); } to { opacity:1; transform: translateY(0); } }
    @keyframes fadeInUp { from { opacity:0; transform: translateY(50px); } to { opacity:1; transform: translateY(0); } }

    @media(max-width:768px) {
        .team-card { width: 80%; }
        .about-header h1 { font-size: 2rem; }
        .about-content h2 { font-size: 1.8rem; }
    }

    /* 📱 Smallest screens */
    @media(max-width:600px) {
        .container {
            margin-top: 160px;
        }
    }
</style>

<div class="container">
    <!-- Header -->
    <div class="about-header">
        <h1>Meet Our Team</h1>
        <p>Our team is committed, skilled, and driven to achieve excellence.</p>
    </div>

    <!-- About / Objectives -->
    <div class="about-content">
        <h2>Our Strength & Objectives</h2>
        <p>We believe in collaboration, innovation, and professionalism. Every team member contributes to our mission of delivering top-notch solutions and creating value for our clients.</p>
        <p>Our objective is to continuously improve, inspire, and exceed expectations while fostering a positive and productive work environment.</p>
    </div>

    <!-- Team Members -->
    <div class="team-section">
        @foreach($team as $member)
        <div class="team-card">
            <img src="{{ asset('storage/'.$member->image) }}" alt="{{ $member->full_name }}">
            <h3>{{ $member->full_name }}</h3>
            <p>{{ $member->position }}</p>
            <p>{{ $member->contact }}</p>
            <div class="social-icons">
                @if($member->facebook) <a href="{{ $member->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a> @endif
                @if($member->twitter) <a href="{{ $member->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a> @endif
                @if($member->linkedin) <a href="{{ $member->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a> @endif
                @if($member->instagram) <a href="{{ $member->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a> @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Font Awesome CDN for Social Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@include('layouts.footer')
