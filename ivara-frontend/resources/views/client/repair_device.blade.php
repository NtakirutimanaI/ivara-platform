@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')
@include('client.fruits')


<!-- Repair Form -->
<div class="repair-form-wrapper">
  <form action="{{ url('submit_repair_form') }}" method="POST" id="repairForm">
    @csrf
    <div class="form-grid">

      <div class="form-group">
        <label for="device_type">Device Type</label>
        <select name="device_type" id="device_type" required>
          <option value="">Select Type</option>
          <option>Laptop</option>
          <option>Desktop</option>
          <option>Tablet</option>
          <option>Phone</option>
          <option>Printer</option>
          <option>Watch</option>
          <option>Fridge</option>
          <option>Radio</option>
          <option>Television</option>
          <option>Other</option>
        </select>
      </div>

      <div class="form-group">
        <label for="device_name">Device Name</label>
        <input type="text" name="device_name" id="device_name" required>
      </div>

      <div class="form-group">
        <label for="serial_number">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number" required oninput="checkSerialNumber(this.value)">
        <small id="serialMessage" class="text-success" style="display: none;"></small>
      </div>

      <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" name="brand" id="brand" required>
      </div>

      <div class="form-group">
        <label for="model">Model</label>
        <input type="text" name="model" id="model" required>
      </div>

      <div class="form-group">
        <label for="operating_system">Operating System</label>
        <input type="text" name="operating_system" id="operating_system">
      </div>

      <div class="form-group">
        <label for="device_owner">Device Owner</label>
        <input type="text" name="device_owner" id="device_owner" required>
      </div>

      <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input type="text" name="contact_number" id="contact_number" required>
      </div>

      <div class="form-group">
        <label for="received_date">Received Date</label>
        <input type="date" name="received_date" id="received_date" required>
      </div>

      <div class="form-group">
        <label for="warranty_status">Warranty Status</label>
        <select name="warranty_status" id="warranty_status" required>
          <option value="Under Warranty">Under Warranty</option>
          <option value="Out of Warranty">Out of Warranty</option>
        </select>
      </div>

      <div class="form-group full-width">
        <label for="problem_description">Problem Description</label>
        <textarea name="problem_description" id="problem_description" rows="3" required></textarea>
      </div>

      <div class="form-group">
        <label for="technician">Technician Assigned</label>
        <input type="text" name="technician" id="technician">
      </div>

      <div class="form-group">
        <label for="estimated_cost">Estimated Cost (RWF)</label>
        <input type="number" name="estimated_cost" id="estimated_cost">
      </div>

      <div class="form-group">
        <label for="repair_status">Repair Status</label>
        <select name="repair_status" id="repair_status" required>
          <option>Pending</option>
          <option>In Progress</option>
          <option>Completed</option>
        </select>
      </div>

      <div class="form-group full-width text-right">
        <button type="submit" class="submit-btn">Submit Repair</button>
      </div>

    </div>
  </form>
</div>

<!-- AJAX Script -->
<script>
  function checkSerialNumber(serial) {
    if (serial.length === 0) {
      document.getElementById('serialMessage').style.display = 'none';
      return;
    }

    fetch(`/check-serial?serial_number=${serial}`)
      .then(response => response.json())
      .then(data => {
        const msg = document.getElementById('serialMessage');
        if (data.exists) {
          msg.textContent = "✖ Serial Already Exists";
          msg.style.color = "red";
        } else {
          msg.textContent = "✔ Device Recorded";
          msg.style.color = "green";
        }
        msg.style.display = 'block';
      });
  }
</script>
<style>
  .repair-form-wrapper {
    max-width: 900px;
    margin-left: 260px;
    margin-top: 100px;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
  }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
  }

  .form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    color: #000;
    font-size: 15px;
  }

  .form-group input,
  .form-group select,
  .form-group textarea {
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 15px;
    width: 100%;
    background-color: #fff;
    color: #000;
  }

  .form-group textarea {
    resize: vertical;
  }

  .form-group.full-width {
    grid-column: span 2;
  }

  .submit-btn {
    background-color: #4f46e5;
    color: white;
    padding: 10px 20px;
    border: none;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
  }

  .submit-btn:hover {
    background-color: #0056b3;
  }

  .text-right {
    text-align: right;
  }

  .text-success {
    color: green;
    margin-top: 4px;
    font-size: 0.9em;
  }

  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }

    .form-group.full-width {
      grid-column: span 1;
    }

    .text-right {
      text-align: center;
    }
  }
</style>

@include('layouts.footer')


