<!-- Terms of Use Link -->
<a href="#" id="termsOfUseLink">Terms Of Use</a>

<!-- Terms of Use Modal -->
<div id="termsOfUseModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span id="closeTermsOfUse" class="close-btn">&times;</span>
    <h2>Terms of Use - IVARA</h2>
    <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
      <p>Welcome to IVARA. By accessing or using our platform, you agree to comply with and be bound by these Terms of Use.</p>
      <h3>Use of Services</h3>
      <p>IVARA provides tools and services aimed at empowering communities and businesses. You agree to use our platform lawfully and responsibly.</p>
      <h3>Account Responsibility</h3>
      <p>You are responsible for maintaining the confidentiality of your account information and for all activities under your account.</p>
      <h3>Prohibited Activities</h3>
      <p>Users must not engage in any activity that harms the platform, other users, or violates applicable laws and regulations.</p>
      <h3>Intellectual Property</h3>
      <p>All content, trademarks, and intellectual property on IVARA are owned by or licensed to us. Unauthorized use is prohibited.</p>
      <h3>Limitation of Liability</h3>
      <p>IVARA is not liable for any damages arising from your use or inability to use the services.</p>
      <h3>Changes to Terms</h3>
      <p>We may modify these Terms of Use at any time. Continued use of the platform indicates acceptance of updated terms.</p>
      <h3>Contact Information</h3>
      <p>If you have questions about these terms, please contact us at info@ivara.rw.</p>
      <hr>
      <label>
        <input type="checkbox" id="agreeCheckbox" />
        I agree to the Terms and Conditions
      </label>
    </div>
    <button id="agreeBtn" disabled style="margin-top: 15px; padding: 10px 20px; font-size: 1rem; cursor: not-allowed;">Agree and Continue</button>
  </div>
</div>

<style>
  /* Modal Background */
  .modal {
    display: none; /* hidden by default */
    position: fixed;
    z-index: 1000;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.6);
    padding: 20px;
    box-sizing: border-box;
  }

  /* Modal Content Box */
  .modal-content {
    background: #fff;
    margin: 40px auto;
    padding: 20px 30px;
    border-radius: 8px;
    max-width: 700px;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    font-family: Arial, sans-serif;
    color: #333;
    position: relative;
  }

  /* Close Button */
  .close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #888;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    user-select: none;
  }
  .close-btn:hover {
    color: #000;
  }

  /* Headings */
  .modal-content h2 {
    margin-top: 0;
    margin-bottom: 15px;
    font-weight: 700;
  }
  .modal-content h3 {
    margin-top: 20px;
    font-weight: 600;
  }

  /* Paragraphs */
  .modal-content p {
    line-height: 1.5;
    font-size: 1rem;
  }

  /* Checkbox Label */
  label {
    font-size: 1rem;
    cursor: pointer;
    user-select: none;
  }

  /* Button styles */
  #agreeBtn {
    background-color: #4caf50;
    border: none;
    border-radius: 4px;
    color: white;
  }
  #agreeBtn:disabled {
    background-color: #a5d6a7;
    cursor: not-allowed;
  }

  /* Responsive */
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
      top: 5px;
      right: 10px;
    }
  }
</style>

<script>
  const modal = document.getElementById('termsOfUseModal');
  const openBtn = document.getElementById('termsOfUseLink');
  const closeBtn = document.getElementById('closeTermsOfUse');
  const agreeCheckbox = document.getElementById('agreeCheckbox');
  const agreeBtn = document.getElementById('agreeBtn');

  // Open modal on link click
  openBtn.addEventListener('click', function(e) {
    e.preventDefault();
    modal.style.display = 'block';
  });

  // Close modal on close button click
  closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
    agreeCheckbox.checked = false;
    agreeBtn.disabled = true;
  });

  // Close modal when clicking outside the content
  window.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.style.display = 'none';
      agreeCheckbox.checked = false;
      agreeBtn.disabled = true;
    }
  });

  // Enable button only if checkbox is checked
  agreeCheckbox.addEventListener('change', function() {
    agreeBtn.disabled = !this.checked;
    agreeBtn.style.cursor = this.checked ? 'pointer' : 'not-allowed';
  });

  // Action when user clicks Agree and Continue
  agreeBtn.addEventListener('click', function() {
    if (!agreeCheckbox.checked) return;

    // Example: redirect to another page after agreement
    // You can change this URL to wherever you want users to go
    window.location.href = '/welcome'; // Change as needed

    // Or you could just close the modal
    // modal.style.display = 'none';
  });
</script>
