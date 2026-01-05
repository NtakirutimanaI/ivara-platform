@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IVARA Support</title>
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#eef2f7; color:#333; }

  .container { width:90%; max-width:1200px; margin:0px auto 0 auto; padding:40px 0; display:flex; flex-direction:column; gap:40px; }

  /* Top Row */
  .top-row {
    background: linear-gradient(135deg, #ff9800, #071839);
    color:#fff;
    padding:60px 20px;
    text-align:center;
    border-radius:15px;
    position:relative;
    overflow:hidden;
  }
  .top-row h1 { font-size:3rem; animation:fadeInDown 1s ease forwards; }
  .top-row p { font-size:1.3rem; margin-top:15px; animation:fadeInUp 1s ease forwards; }

  /* Middle Row - 3 sections */
  .middle-row { display:flex; flex-wrap:wrap; gap:20px; justify-content:center; }

  .middle-row .side-section, .middle-row .center-section {
    border-radius:15px;
    background:#0A1128;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
    overflow:hidden;
    position:relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .middle-row .side-section:hover, .middle-row .center-section:hover { transform: translateY(-10px); box-shadow:0 15px 30px rgba(0,0,0,0.2); }

  .side-section { flex:1 1 250px; max-height:300px; display:flex; justify-content:center; align-items:center; animation:floatUp 2s ease infinite alternate; }
  .side-section img { width:100%; max-width:220px; border-radius:15px; }

  .center-section { flex:2 1 500px; padding:30px; text-align:center; background:linear-gradient(135deg,#ffb74d,#071839); color:#fff; animation:zoomIn 1s ease forwards; }
  .center-section h2 { font-size:2.5rem; margin-bottom:20px; }
  .center-section p { font-size:1.2rem; margin-bottom:15px; }
  .center-section a { font-weight:bold; color:#fff; text-decoration:underline; }

  /* Bottom Row */
  .bottom-row {
    border-top:3px solid #071839;
    padding-top:20px;
    text-align:center;
    display:flex; flex-wrap:wrap; justify-content:center; gap:20px;
    color:#555;
  }
  .bottom-row div { background:#fff; padding:15px; border-radius:10px; flex:1 1 200px; box-shadow:0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
  .bottom-row div:hover { transform: translateY(-5px); }

  /* Animations */
  @keyframes fadeInDown { from {opacity:0; transform:translateY(-50px);} to {opacity:1; transform:translateY(0);} }
  @keyframes fadeInUp { from {opacity:0; transform:translateY(50px);} to {opacity:1; transform:translateY(0);} }
  @keyframes zoomIn { from {transform:scale(0.8); opacity:0;} to {transform:scale(1); opacity:1;} }
  @keyframes floatUp { from {transform:translateY(0);} to {transform:translateY(-15px);} }

  /* Floating emojis in front */
  .floating-emoji {
    position:fixed; /* front display */
    font-size:2rem;
    opacity:0.8;
    animation:float 6s ease-in-out infinite;
    z-index:9999;
    pointer-events:none;
  }
  @keyframes float {
    0% { transform:translateY(0) rotate(0deg); }
    50% { transform:translateY(-20px) rotate(180deg); }
    100% { transform:translateY(0) rotate(360deg); }
  }

  /* Responsive for smallest screens */
  @media(max-width:600px) {
    .container { margin-top:160px; padding:20px 10px; }
    .top-row { padding:40px 15px; border-radius:10px; }
    .top-row h1 { font-size:1.8rem; }
    .top-row p { font-size:1rem; }

    .middle-row { flex-direction:column; gap:15px; }
    .side-section { max-height:220px; }
    .side-section img { max-width:160px; }
    .center-section { flex:1 1 auto; padding:20px; order:-1; }
    .center-section h2 { font-size:1.6rem; margin-bottom:15px; }
    .center-section p { font-size:1rem; margin-bottom:10px; }
    
    .bottom-row { flex-direction:column; gap:15px; }
    .bottom-row div { flex:1 1 auto; padding:12px; }
  }
</style>
</head>
<body>

<!-- Floating emojis -->
<span class="floating-emoji" style="top:10%; left:5%;">💡</span>
<span class="floating-emoji" style="top:20%; left:85%;"><i class="fa fa-rocket" style="color:orange;"></i></span>
<span class="floating-emoji" style="top:70%; left:10%;">🤝</span>
<span class="floating-emoji" style="top:60%; left:75%;"><i class="fa fa-phone" style="color:blue;"></i></span>

<div class="container">
  <!-- Top Row -->
  <div class="top-row">
    <h1>IVARA Support Center</h1>
    <p>Helping you succeed with training, guidance & collaboration ✨</p>
  </div>

  <!-- Middle Row -->
  <div class="middle-row">
    <div class="side-section">
      <img src="{{asset('images/invoices.png')}}" alt="Training">
    </div>

    <div class="center-section">
      <h2>Contact & Help</h2>
      <p><i class="fa fa-phone" style="color:white;"></i><a href="tel:+250788446936">+250788446936</a></p>
      <p><i class="fa fa-envelope"></i> <a href="mailto:info@ivara.rw">info@ivara.rw</a></p>
      <p>Our team is ready to guide you through any challenges, provide solutions, and ensure your success!</p>
    </div>

    <div class="side-section">
      <img src="{{asset('images/updates.png')}}" alt="Innovation">
    </div>
  </div>

  <!-- Bottom Row -->
  <div class="bottom-row">
    <div>
      <h3>Community Support <i class="fa fa-hand-holding-heart" style="color:orange;"></i></h3>
      <p>Engage with our network to share knowledge, skills, and mentorship.</p>
    </div>
    <div>
      <h3>Workshops & Learning <i class="fa fa-book-open" style="color:blue;"></i></h3>
      <p>Access tutorials, workshops, and events to enhance technical and business skills.</p>
    </div>
    <div>
      <h3>Innovation <i class="fa fa-brain" style="color:purple;"></i></h3>
      <p>Transform ideas into actionable solutions with guidance from our experts.</p>
    </div>
  </div>
</div>

<script>
  // Scroll animation for middle & bottom row
  const sections = document.querySelectorAll('.middle-row, .bottom-row, .top-row');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.style.opacity = 1;
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  sections.forEach(section => {
    section.style.opacity = 0;
    section.style.transform = 'translateY(50px)';
    observer.observe(section);
  });
</script>

</body>
</html>
@include('layouts.footer')
