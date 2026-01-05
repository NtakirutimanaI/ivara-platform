<!-- Privacy Policy Link (optional if you want to keep it) -->
<a href="#" id="privacyPolicyLink">Privacy Policy</a>

<!-- Modal Structure -->
<div id="privacyPolicyModal" class="modal" style="display: block;"> <!-- visible by default -->
  <div class="modal-content">
    <span class="close-btn" id="closePrivacyPolicy">&times;</span>
    <h2>Privacy Policy - IVARA</h2>
    <div class="modal-body">
      <p>At IVARA, your privacy is our priority. This Privacy Policy explains how we collect, use, and protect your personal information...</p>
      <h3>Information Collection</h3>
      <p>We collect personal information that you voluntarily provide to us when subscribing, contacting us, or using our services...</p>
      <h3>Use of Information</h3>
      <p>Your information is used to provide, maintain, and improve our services, communicate important updates, and comply with legal obligations...</p>
      <h3>Data Security</h3>
      <p>We implement industry-standard security measures to safeguard your data from unauthorized access, alteration, disclosure, or destruction...</p>
      <h3>Your Rights</h3>
      <p>You have the right to access, correct, or delete your personal information. Contact us for any privacy-related requests.</p>
      <h3>Cookies</h3>
      <p>We use cookies to enhance user experience and analyze website traffic. You can disable cookies via your browser settings.</p>
      <h3>Changes to Policy</h3>
      <p>We may update this policy from time to time. We encourage you to review it periodically.</p>
      <h3>Contact Us</h3>
      <p>If you have questions or concerns about this policy, please contact us at info@ivara.rw.</p>
    </div>
  </div>
</div>

<style>
  /* Modal background */
  .modal {
    display: block; /* Changed from none to block to show modal initially */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.6); /* Black with opacity */
    padding: 20px;
    box-sizing: border-box;
  }

  /* Modal content box */
  .modal-content {
    background-color: #fff;
    margin: 40px auto;
    padding: 20px 30px;
    border-radius: 8px;
    max-width: 700px;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    font-family: Arial, sans-serif;
    color: #333;
  }

  /* Close button */
  .close-btn {
    color: #888;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    user-select: none;
  }

  .close-btn:hover {
    color: #000;
  }

  /* Modal heading */
  .modal-content h2 {
    margin-top: 0;
    margin-bottom: 15px;
    font-weight: 700;
    color: #222;
  }

  /* Modal paragraphs and headings */
  .modal-content h3 {
    margin-top: 20px;
    font-weight: 600;
    color: #444;
  }

  .modal-content p {
    line-height: 1.5;
    font-size: 1rem;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .modal-content {
      max-width: 90%;
      padding: 15px 20px;
    }
    .modal-content p, .modal-content h3 {
      font-size: 0.9rem;
    }
    .close-btn {
      font-size: 24px;
    }
  }
</style>

<script>
  // Close modal when clicking the close button
  document.getElementById('closePrivacyPolicy').addEventListener('click', function() {
    document.getElementById('privacyPolicyModal').style.display = 'none';
  });

  // Optional: Close modal if clicking outside modal content
  window.addEventListener('click', function(e) {
    const modal = document.getElementById('privacyPolicyModal');
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

  // Optional: if you want the link to reopen the modal (if you keep the link)
  document.getElementById('privacyPolicyLink').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('privacyPolicyModal').style.display = 'block';
  });
</script>
