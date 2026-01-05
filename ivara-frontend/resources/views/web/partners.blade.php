<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVARA Dashboard Preview</title>

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET ONLY FOR THIS PAGE ===== */
        .ivara-body {
            margin: 0;
            font-family: 'Poppins', sans-serif; /* Changed to Poppins */
            color: white;
        }

        /* ===== HERO SECTION ===== */
        .ivara-hero {
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .ivara-hero-content {
            display: flex;
            align-items: center;
            position: relative;
            flex-wrap: wrap;
            max-width: 1200px;
            top:45px;
        }

        .ivara-left-image img {
            width: 250px;
            z-index: 2;
            max-width: 100%;
        }

        .ivara-dashboard-preview img {
            width: 700px;
            border-radius: 8px;
            max-width: 100%;
        }

        .ivara-mobile-preview {
            position: absolute;
            right: -40px;
            bottom: -50px;
        }

        .ivara-mobile-preview img {
            width: 200px;
            max-width: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .ivara-mobile-preview {
                position: relative;
                right: 0;
                bottom: 0;
                margin-top: 20px;
            }
        }

        /* ===== PARTNERS SECTION ===== */
        .ivara-partners-section {
            background: #f5f5f5;
            padding: 20px;
            text-align: center;
            color: black;
        }

        .ivara-partners-section h3 {
            margin-bottom: 20px;
            font-weight: 500;
        }

        .ivara-partners-marquee {
            overflow: hidden;
            position: relative;
            white-space: nowrap;
        }

        .ivara-marquee-content {
            display: inline-flex;
            animation: ivara-marquee 15s linear infinite;
        }

        .ivara-marquee-content img {
            height: 50px;
            margin: 0 30px;
            object-fit: contain;
            max-width: 100%;
        }

        @keyframes ivara-marquee {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        /* Pause animation on hover */
        .ivara-partners-marquee:hover .ivara-marquee-content {
            animation-play-state: paused;
        }
    </style>
</head>
<body class="ivara-body">

    <!-- Main Container -->
    <section class="ivara-hero">
        <div class="ivara-hero-content">
            <div class="ivara-left-image">
                <img src="{{asset('images/invoices.png')}}" alt="Woman Thumbs Up">
            </div>
            <div class="ivara-dashboard-preview">
                <img src="{{asset('images/toop.png')}}" alt="Dashboard">
            </div>
            <div class="ivara-mobile-preview">
                <img src="{{asset('images/permissions.png')}}" alt="Mobile View">
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="ivara-partners-section">
        <h3>❤️ & Trusted by:</h3>
        <div class="ivara-partners-marquee">
            <div class="ivara-marquee-content">
                <img src="{{asset('images/mtn.png')}}" alt="Partner 1">
                <img src="{{asset('images/tigo.png')}}" alt="Partner 2">
                <img src="{{asset('images/5g.jpg')}}" alt="Partner 3">
                <img src="{{asset('images/4g.jpg')}}" alt="Partner 4">
                <img src="{{asset('images/5_g.jpg')}}" alt="Partner 5">
                <!-- Duplicate for smooth looping -->
                <img src="{{asset('images/mtn.png')}}" alt="Partner 1">
                <img src="{{asset('images/tigo.png')}}" alt="Partner 2">
                <img src="{{asset('images/5g.jpg')}}" alt="Partner 3">
                <img src="{{asset('images/4g.jpg')}}" alt="Partner 4">
                <img src="{{asset('images/5_g.jpg')}}" alt="Partner 5">
            </div>
        </div>
    </section>

</body>
</html>
