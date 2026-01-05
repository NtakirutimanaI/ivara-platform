@include('layouts.header')
<style>
  body, html {
    margin: 0; padding: 0; height: 100%;
    background: #0A1128;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .quick-access-container {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 40px;
    padding: 20px;
    color: white;
    text-align: center;
  }

  .quick-access-title {
    font-family: 'Inter', sans-serif;
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 0.2em;
    color: #FFB600;
    text-shadow: 0 0 8px rgba(255,182,0,0.8);
  }

  .quick-access-subtitle {
    font-size: 1.2rem;
    font-weight: 400;
    max-width: 500px;
    margin-bottom: 2rem;
    color: #ccc;
  }

  .btn-group {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
    max-width: 600px;
  }

  .btn-link {
    flex: 1 1 250px;
    padding: 20px 0;
    background: transparent;
    border: 3px solid #FFB600;
    border-radius: 10px;
    font-size: 1.5rem;
    font-weight: 700;
    color: #FFB600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 0 10px rgba(255,182,0,0.3);
  }

  .btn-link:hover {
    background: #FFB600;
    color: #0A1128;
    box-shadow: 0 0 25px #FFB600;
  }

  .btn-link span {
    margin-left: 10px;
    font-size: 1.6rem;
  }

  @media (max-width: 480px) {
    .btn-group {
      flex-direction: column;
      gap: 20px;
    }
  }
</style>

<div class="quick-access-container">
  <h1 class="quick-access-title">Quick Access</h1>
  <p class="quick-access-subtitle">Register your materials or book a service quickly and easily.</p>

  <div class="btn-group">
    <a href="{{ route('web.register_device') }}" class="btn-link">
      Register Devices/Assets <span>→</span>
    </a>

    <a href="{{ route('web.bookings') }}" class="btn-link">
      Book Services/Products <span>→</span>
    </a>
  </div>
</div>
