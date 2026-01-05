<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  * {
    box-sizing: border-box;
    padding: 0;
  }

  body {
    font-family: 'Poppins', sans-serif;
  }

  .support-section {
    background: linear-gradient(to right, #0A1128, #0A1128);
    color: white;
    padding: 40px 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
  }

  .support-content {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
    padding: 20px;
  }

  .support-label {
    color: rgb(255, 182, 0);
    font-size: 14px;
    margin-bottom: 10px;
    font-weight: bold;
  }

  .support-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
  }

  .support-description {
    font-size: 18px;
    margin-bottom: 30px;
    font-weight: 500;
  }

  .support-action {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
  }

  .call-icon {
    background: white;
    border-radius: 50%;
    padding: 10px;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .call-icon img {
    width: 40px;
    height: 40px;
  }

  .call-button {
    background: rgb(37, 211, 102); /* WhatsApp green */
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
  }

  .call-button:hover {
    background: #25c16f;
  }

  .support-image {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
    text-align: center;
    padding: 20px;
  }

  .support-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
  }

  @media (max-width: 768px) {
    .support-section {
      flex-direction: column;
      text-align: center;
    }

    .support-action {
      justify-content: center;
      gap: 10px;
    }
  }

  /* Display WhatsApp status */
  #whatsappNumberDisplay {
    margin-left: 10px;
    font-size: 18px;
    color: #FFB600;
    font-weight: 600;
    min-width: 180px;
    font-family: 'Poppins', sans-serif;
  }
</style>

<section class="support-section">
  <div class="support-content">
    <div class="support-label">Support</div>
    <div class="support-title">We are here for you</div>
    <div class="support-description">Any issue reach on us via WhatsApp</div>
    <div class="support-action">
      <div class="call-icon">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Icon" />
      </div>
      <button class="call-button" onclick="openWhatsApp()" id="callBtn">Chat on WhatsApp</button>
      <div id="whatsappNumberDisplay"></div>
    </div>
  </div>
  <div class="support-image">
    <img src="{{asset('images/support5.png')}}" alt="Support Person" />
  </div>
</section>

<script>
  const supportNumber = "+250788446936"; // WhatsApp number (no spaces)
  const defaultMessage = "Hello, I need support."; // Prefilled message

  function openWhatsApp() {
    // Encode message for URL
    const message = encodeURIComponent(defaultMessage);
    const url = `https://wa.me/${supportNumber}?text=${message}`;

    // Open WhatsApp Web or mobile app
    window.open(url, '_blank');

    // Show status
    const display = document.getElementById('whatsappNumberDisplay');
    display.textContent = `Opening WhatsApp chat with ${supportNumber}...`;
  }
</script>
