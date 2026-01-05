<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us - IVARA</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif; /* Updated font */
      background-color: #f3f4f6;
      margin: 0;
    }
    .um-contact-wrap {
      max-width: 600px;
      margin: 1rem auto;
      background: transparent;
      border-radius: 10px;
      box-shadow: none;
      padding: 1rem;
    }
    .um-contact-title {
      font-weight: 700;
      font-size: 2rem;
      margin-bottom: 0.2rem;
      color: #0A1128;
      text-align: center;
    }
    .um-contact-subtitle {
      font-size: 0.85rem;
      color: #555a75;
      margin-bottom: 1rem;
      text-align: center;
    }
    .um-contact-form {
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
    }
    .um-contact-label {
      font-weight: 600;
      font-size: 0.8rem;
      color: #4a4a4a;
    }
    .um-contact-input, 
    .um-contact-textarea, 
    .um-contact-select {
      width: 100%;
      padding: 0.4rem 0.5rem;
      border: none;
      border-bottom: 2px solid #d1d5db;
      font-size: 0.85rem;
      transition: border-color 0.2s ease;
      background: transparent;
      font-family: 'Poppins', sans-serif;
    }
    .um-contact-input:focus, 
    .um-contact-textarea:focus, 
    .um-contact-select:focus {
      border-bottom-color: #6c63ff;
      outline: none;
    }
    .um-contact-textarea {
      resize: vertical;
      min-height: 80px;
    }
    .um-feedback {
      font-size: 0.7rem;
    }
    .um-feedback-accepted { color: green; }
    .um-feedback-rejected { color: red; }
    .um-contact-btn {
      background-color: rgb(255, 182, 0);
      color: white;
      border: none;
      border-radius: 6px;
      padding: 0.5rem 0;
      font-weight: 700;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-family: 'Poppins', sans-serif;
    }
    .um-contact-btn:hover {
      background-color: #0A1128;
    }
    .um-phone-group {
      display: flex;
      gap: 0.4rem;
    }
    .um-country-select {
      width: 30%;
      padding: 0.4rem 0.5rem;
      font-size: 0.85rem;
      border: none;
      border-bottom: 2px solid #d1d5db;
      background: transparent;
      transition: border-color 0.2s ease;
      font-family: 'Poppins', sans-serif;
    }
    .um-country-select:focus {
      border-bottom-color: #6c63ff;
      outline: none;
    }
    .um-phone-input {
      width: 70%;
      padding: 0.4rem 0.5rem;
      font-size: 0.85rem;
      border: none;
      border-bottom: 2px solid #d1d5db;
      background: transparent;
      transition: border-color 0.2s ease;
      font-family: 'Poppins', sans-serif;
    }
    .um-phone-input:focus {
      border-bottom-color: #6c63ff;
      outline: none;
    }
    @media (max-width: 600px) {
      .um-contact-wrap {
        margin: 1rem;
        padding: 1rem;
      }
      .um-country-select {
        width: 40%;
      }
      .um-phone-input {
        width: 60%;
      }
    }
  </style>
</head>
<body>
  <div class="um-contact-wrap">
    <div class="um-contact-title">Contact IVARA</div>
    <div class="um-contact-subtitle">We'd love to hear from you!</div>

    <!-- Feedback message -->
    @if(session('success'))
      <div style="text-align:center; font-weight:bold; color:green; margin-bottom:10px;">
        ✔ Message Sent
      </div>
    @elseif(session('error'))
      <div style="text-align:center; font-weight:bold; color:red; margin-bottom:10px;">
        ✖ Message Not Sent
      </div>
    @endif
    
    <form method="POST" action="{{ route('contact.send') }}" class="um-contact-form">
      @csrf

      <div>
        <label for="name" class="um-contact-label">Full Name *</label>
        <input id="name" type="text" name="name" required placeholder="Enter your full name"
               class="um-contact-input"
               oninput="umValidateField(this, /^[a-zA-Z\s]{3,}$/)" />
        <div id="name-feedback" class="um-feedback"></div>
      </div>

      <div>
        <label for="email" class="um-contact-label">Email *</label>
        <input id="email" type="email" name="email" required placeholder="Enter your email address"
               class="um-contact-input"
               oninput="umValidateEmail()" />
        <div id="email-feedback" class="um-feedback"></div>
      </div>

      <div>
        <label class="um-contact-label">Phone Number</label>
        <div class="um-phone-group">
          <select class="um-country-select" name="country_code">
            <option value="+250">🇷🇼 +250</option>
            <option value="+254">🇰🇪 +254</option>
            <option value="+255">🇹🇿 +255</option>
            <option value="+256">🇺🇬 +256</option>
            <option value="+1">🇺🇸 +1</option>
            <option value="+44">🇬🇧 +44</option>
          </select>
          <input id="phone" type="text" name="phone" placeholder="e.g. 788832490"
                 class="um-phone-input"
                 oninput="umValidateField(this, /^[0-9]{6,}$/)" />
        </div>
        <div id="phone-feedback" class="um-feedback"></div>
      </div>

      <div>
        <label for="subject" class="um-contact-label">Subject *</label>
        <input id="subject" type="text" name="subject" required placeholder="Enter subject"
               class="um-contact-input"
               oninput="umValidateField(this, /^.{3,}$/)" />
        <div id="subject-feedback" class="um-feedback"></div>
      </div>

      <div>
        <label for="message" class="um-contact-label">Message *</label>
        <textarea id="message" name="message" required placeholder="Write your message here..."
                  class="um-contact-textarea"
                  oninput="umValidateField(this, /^.{10,}$/)"></textarea>
        <div id="message-feedback" class="um-feedback"></div>
      </div>

      <button type="submit" class="um-contact-btn">Send Message</button>
    </form>
  </div>

  <script>
    function umValidateField(input, regex) {
      const feedback = document.getElementById(input.id + '-feedback');
      if (regex.test(input.value.trim())) {
        feedback.textContent = '✔ Accepted';
        feedback.className = 'um-feedback um-feedback-accepted';
      } else {
        feedback.textContent = '✖ Not Accepted';
        feedback.className = 'um-feedback um-feedback-rejected';
      }
    }
    function umValidateEmail() {
      const emailInput = document.getElementById('email');
      const feedback = document.getElementById('email-feedback');
      const value = emailInput.value.trim();
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!regex.test(value)) {
        feedback.textContent = '✖ Not Accepted';
        feedback.className = 'um-feedback um-feedback-rejected';
      } else {
        feedback.textContent = '✔ Accepted';
        feedback.className = 'um-feedback um-feedback-accepted';
      }
    }
  </script>
</body>
</html>
