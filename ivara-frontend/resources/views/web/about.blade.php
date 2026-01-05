<style>
  /* Local Scoped Styles */
  .ivara-about-section {
    font-family: 'Poppins', sans-serif; 
    margin-top: 0;
    padding: 60px 20px;
    background: #fff;
    color: #000;
  }

  .section {
    max-width: 800px;
    margin: 50px auto 0 auto;
    color: #000;
  }

  .label {
    display: flex;
    align-items: center;
    font-size: 18px;
    color: #FCD72B;
    font-weight: 600;
    margin-bottom: 10px;
    font-family: inherit;
  }

  .label::before {
    content: '';
    width: 6px;
    height: 18px;
    background-color: #FCD72B;
    border-radius: 3px;
    margin-right: 6px;
  }

  .heading {
    font-size: 1.5rem; /* 24px */
    font-weight: 700;
    margin-bottom: 20px;
  }

  .content {
    font-size: 0.95rem; /* slightly smaller for readability */
    line-height: 1.6;
    font-weight: 500;
    transition: opacity 0.3s ease;
  }

  .controls {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
  }

  .arrow-btn {
    background: #f0f0f0;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    font-size: 18px;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease;
  }

  .arrow-btn:hover {
    background: #ddd;
    transform: translateY(-2px);
  }

  @media (max-width: 600px) {
    .content {
      font-size: 0.9rem; 
    }

    .arrow-btn {
      width: 32px;
      height: 32px;
      font-size: 16px;
    }
  }
</style>

<div class="ivara-about-section">
  <div class="label">Stay Connected</div>
  <div class="heading">Why IVARA comes?</div>
  <div class="content" id="evuba-text">
    IVARA saves you invaluable time streamlining processes that once took days into just minutes. Even first-time users can navigate the system effortlessly, enabling your team to focus on what truly matters: delivering exceptional service and growing your business.
  </div>

  <div class="controls">
    <button class="arrow-btn" onclick="prevText()">←</button>
    <button class="arrow-btn" onclick="nextText()">→</button>
  </div>
</div>

<script>
  const content = document.getElementById("evuba-text");

  const textSlides = [
    `IVARA’s mission is to empower communities by providing reliable, fast, and secure access to essential digital services. We simplify processes and improve everyday efficiency for all users.`,
    `Our vision is to become the leading platform for digital trust and transformation in Africa—supporting growth, collaboration, and empowerment through technology everyone can access.`,
    `We uphold core values of transparency, innovation, and service. At IVARA, we believe in putting people first, building trust, and continuously improving to meet real-world needs.`,
    `Through every feature, IVARA reflects our commitment to accessibility, data protection, and user-centered design—ensuring a secure and dependable experience at every step.`
  ];

  let currentIndex = 0;

  function updateContent(index) {
    content.style.opacity = 0;
    setTimeout(() => {
      content.textContent = textSlides[index];
      content.style.opacity = 1;
    }, 200);
  }

  function nextText() {
    currentIndex = (currentIndex + 1) % textSlides.length;
    updateContent(currentIndex);
  }

  function prevText() {
    currentIndex = (currentIndex - 1 + textSlides.length) % textSlides.length;
    updateContent(currentIndex);
  }
</script>
