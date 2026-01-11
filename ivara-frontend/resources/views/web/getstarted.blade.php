  <style>
    /* Scoped Styles for Get Started */
    .cta-buttons-section {
      background-color: #001633; /* Moved from body */
      color: white;
      font-family: 'Inter', sans-serif;
      padding: 2rem 1rem;
      text-align: center;
    }

    .floating-cta-wrapper {
      position: relative;
      z-index: 999;
    }

    .cta-buttons-section {
      padding: 2rem 1rem;
      text-align: center;
    }

    .cta-buttons {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
      
    }

    .cta-buttons button {
      font-size: 1rem;
      font-weight: 600;
      padding: 0.75rem 1.75rem;
      border-radius: 9999px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      white-space: nowrap;
    }

    .btn-primary {
      background-color: #ffba00;
      color: #000;
      border: none;
    }

    .btn-primary:hover {
      background-color: #7b3fa8;
    }

    .btn-outline {
      background-color: transparent;
      border: 1px solid #ffba00;
      color: #ffba00;
    }

    .btn-outline:hover {
      background-color: #ffba00;
      color: #000;
    }

    @media (max-width: 480px) {
      .cta-buttons {
        flex-direction: column;
      }

      .cta-buttons button {
        width: 100%;
        justify-content: center;
      }
    }
  </style>


  <!-- Wrapper to isolate CTA section -->
  <div class="floating-cta-wrapper">
    <section class="cta-buttons-section">
      <div class="cta-buttons">
        <button class="btn-primary" onclick="window.location.href='{{ route('register') }}'">Get Started <span>→</span></button>

       <button class="btn-outline" onclick="handleBookDemo()">Quick Access <span>→</span></button>
      </div>
    </section>
  </div>

  <script>
    function handleGetStarted() {
      window.location.href = '/get-started'; // Update as needed
    }

    function handleBookDemo() {
      window.location.href = '/book-demo'; // Update as needed
    }

    function handleBookDemo() {
    window.location.href = "{{ route('quick.access') }}";
}
  </script>


