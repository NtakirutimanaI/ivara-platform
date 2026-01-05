  <style>
    /* Scoped styles for Top Hero Section */
    .section-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 0; /* REMOVED PADDING to hit edge */
      gap: 0;
      flex-wrap: wrap;
      background: #0A1128;
      width: 100%;
      overflow: hidden;
      position: relative;
    }

    .carousel-wrapper {
      width: 100%; /* Full width */
      height: 100vh;
      position: relative;
    }

    .carousel-container {
      position: relative;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }

    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      display: none;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0.4; /* Darken background image for text readability */
    }

    .slide.active {
      display: block;
      animation: fade 0.8s ease-in-out;
    }

    @keyframes fade {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      z-index: 10;
      width: 80%;
      max-width: 1000px;
    }

    .hero-tagline {
      font-size: 4rem; /* Larger */
      font-weight: 800;
      color: #ffffff;
      margin-bottom: 1.5rem;
      font-family: 'Poppins', sans-serif;
      line-height: 1.1;
      text-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .hero-subtext {
      font-size: 1.25rem;
      font-weight: 400;
      color: #f0f0f0;
      margin: 0 auto;
      max-width: 800px;
      font-family: 'Inter', sans-serif;
      line-height: 1.6;
      text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    .dots {
      position: absolute;
      bottom: 30px;
      width: 100%;
      text-align: center;
      z-index: 20;
    }

    .dot {
      height: 12px;
      width: 12px;
      margin: 0 5px;
      background-color: rgba(255,255,255,0.5);
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .dot.active {
      background-color: #FFB700;
      transform: scale(1.2);
    }

    /* 📱 Smallest screen styles */
    @media (max-width: 600px) {
      .hero-tagline {
        font-size: 2.2rem;
      }
      .hero-subtext {
        font-size: 1rem;
      }
    }
  </style>

<div class="section-container">
  <div class="carousel-wrapper">
    <div class="carousel-container">
      <div class="slide active">
        <img src="{{asset('images/support.png')}}" alt="Slide 1">
      </div>
      <div class="slide">
        <img src="{{asset('images/support2.png')}}" alt="Slide 2">
      </div>
      <div class="slide">
        <img src="{{asset('images/support3.png')}}" alt="Slide 3">
      </div>
      <div class="slide">
        <img src="{{asset('images/support4.png')}}" alt="Slide 4">
      </div>
    </div>
    
    <div class="hero-content">
        <p class="hero-tagline">Secure Your Business <br> & Assets</p>
        <p class="hero-subtext">
            IVARA empowers local entrepreneurs with smart tools to streamline sales, monitor stock, 
            and grow customer loyalty — Designed for small businesses across Africa.
        </p>
    </div>

    <div class="dots">
      <span class="dot active" onclick="showSlide(0)"></span>
      <span class="dot" onclick="showSlide(1)"></span>
      <span class="dot" onclick="showSlide(2)"></span>
      <span class="dot" onclick="showSlide(3)"></span>
    </div>
  </div>
</div>

<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');

  function showSlide(index) {
    if(slides.length === 0) return;
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      dots[i].classList.remove('active');
    });
    slides[index].classList.add('active');
    dots[index].classList.add('active');
    currentSlide = index;
  }

  // Check if slides exist before running interval
  if(slides.length > 0) {
      setInterval(() => showSlide((currentSlide + 1) % slides.length), 4000);
  }
</script>
