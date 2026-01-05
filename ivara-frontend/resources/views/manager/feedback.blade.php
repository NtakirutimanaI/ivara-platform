@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Feedback</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f9fafb;
      color: #333;
      overflow-x: hidden;
    }

    .container {
      width: 80%;
      margin-left: 240px;
      margin-top: 60px;
      padding: 20px;
      box-sizing: border-box;
    }

    h1 {
      color: #924FC2;
      margin-bottom: 20px;
    }

    form {
      background: white;
      border-radius: 8px;
      box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
      padding: 25px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-weight: 600;
    }

    select,
    textarea,
    input[type="text"],
    input[type="email"],
    input[type="file"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      resize: vertical;
    }

    textarea {
      min-height: 120px;
    }

    .char-count {
      font-size: 13px;
      color: #888;
      text-align: right;
      margin-top: -10px;
    }

    button {
      background-color: #924FC2;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 12px 15px;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
      width: fit-content;
    }

    button:hover {
      background-color: #3730a3;
    }

    .alert-success {
      background-color: #dcfce7;
      border: 1px solid #bbf7d0;
      padding: 10px 15px;
      border-radius: 5px;
      color: #166534;
      margin-bottom: 15px;
    }

    .flex-row {
      display: flex;
      gap: 15px;
    }

    .flex-row > div {
      flex: 1;
    }

    @media (max-width: 900px) {
      .container {
        width: 100%;
        margin-left: 0;
        padding: 15px;
      }

      .flex-row {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h1>User Feedback</h1>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('admin.feedback.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="flex-row">
      <div>
        <label for="user_type">User Type</label>
        <select name="user_type" id="user_type" required>
          <option value="">Select...</option>
          <option value="Admin">Admin</option>
          <option value="Manager">Manager</option>
          <option value="Supervisor">Supervisor</option>
          <option value="Technician">Technician</option>
          <option value="Mechanician">Mechanician</option>
          <option value="Businessperson">Businessperson</option>
          <option value="Craftsperson">Craftsperson</option>
          <option value="Mediator">Mediator</option>
          <option value="Tailor">Tailor</option>
          <option value="Client">Client</option>
        </select>
      </div>

      <div>
        <label for="module">Feedback Area</label>
        <select name="module" id="module" required>
          <option value="">Choose Area...</option>
          <option value="Devices">Devices</option>
          <option value="Repairs">Repairs</option>
          <option value="Subscriptions">Subscriptions</option>
          <option value="Reports">Reports</option>
          <option value="Stock">Stock</option>
          <option value="Bookings">Bookings</option>
          <option value="Communication">Communication</option>
          <option value="Payments">Payments</option>
          <option value="Marketing">Marketing</option>
          <option value="Team">Team Management</option>
          <option value="User Accounts">User Accounts</option>
          <option value="Other">Other</option>
        </select>
      </div>
    </div>

    <div class="flex-row">
      <div>
        <label for="urgency">Urgency</label>
        <select name="urgency" id="urgency" required>
          <option value="Low">Low</option>
          <option value="Normal" selected>Normal</option>
          <option value="High">High</option>
          <option value="Critical">Critical</option>
        </select>
      </div>

      <div>
        <label for="category">Feedback Type</label>
        <select name="category" id="category" required>
          <option value="Bug Report">Bug Report</option>
          <option value="Suggestion">Suggestion</option>
          <option value="Appreciation">Appreciation</option>
          <option value="Complaint">Complaint</option>
        </select>
      </div>
    </div>

    <div class="flex-row">
      <div>
        <label for="name">Your Name (optional)</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" />
      </div>
      <div>
        <label for="email">Your Email (optional)</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" />
      </div>
    </div>

    <div>
      <label for="anonymous">
        <input type="checkbox" name="anonymous" id="anonymous" />
        Submit Anonymously
      </label>
    </div>

    <label for="message">Message</label>
    <textarea name="message" id="message" maxlength="1000" placeholder="Write your feedback here..." required></textarea>
    <div class="char-count" id="charCount">0 / 1000 characters</div>

    <label for="attachment">Attach File (optional)</label>
    <input type="file" name="attachment" id="attachment" accept=".jpg,.png,.pdf,.doc,.docx" />

    <button type="submit"><i class="fa fa-paper-plane"></i> Submit Feedback</button>
  </form>
</div>

<script>
  const messageField = document.getElementById('message');
  const charCount = document.getElementById('charCount');

  messageField.addEventListener('input', () => {
    const length = messageField.value.length;
    charCount.textContent = `${length} / 1000 characters`;
  });

  // Disable name/email if anonymous checked
  document.getElementById('anonymous').addEventListener('change', function () {
    const isChecked = this.checked;
    document.getElementById('name').disabled = isChecked;
    document.getElementById('email').disabled = isChecked;
  });
</script>

</body>
</html>

@include('layouts.footer')
