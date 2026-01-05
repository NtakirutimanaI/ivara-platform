@include('layouts.header')
@include('layouts.sidebar')
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Client, Device, Technician</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    /* Reset and basic */
    *, *::before, *::after { box-sizing: border-box; }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin 0; padding: 20px; background: #f5f7fa; color: #333;
      min-height: 100vh;
      display: flex; flex-direction: column; align-items: center;
    }

    h2 {
      margin-bottom: 15px;
      color: #222;
    }

    /* Prompt box */
    .prompt {
      background: white;
      max-width: 400px;
      width: 90vw;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      position: relative;
      margin-bottom: 20px;
      text-align: center;
    }
    .prompt .close-btn {
      position: absolute;
      top: 12px;
      right: 12px;
      font-weight: bold;
      font-size: 22px;
      color: #666;
      cursor: pointer;
      user-select: none;
    }
    .prompt p {
      font-size: 1.1rem;
      margin: 0 0 20px 0;
    }
    .prompt-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
    }
    .prompt-buttons button {
      flex: 1;
      padding: 10px 0;
      font-size: 1rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-weight: 600;
    }
    .prompt-buttons button.yes {
      background-color: #00C853;
      color: white;
    }
    .prompt-buttons button.no {
      background-color: #6c757d;
      color: white;
    }
    .prompt-buttons button.yes:hover {
      background-color: #00C853;
    }
    .prompt-buttons button.no:hover {
      background-color: #5a6268;
    }

    /* Forms */
    form {
      background: white;
      max-width: 600px;
      width: 90vw;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.1);
      display: none;
      flex-direction: column;
    }

    form.active {
      display: flex;
    }

    form h3 {
      margin-top: 0;
      margin-bottom: 15px;
      color: #00C853;
    }

    label {
      display: flex;
      flex-direction: column;
      margin-bottom: 15px;
      font-weight: 600;
      font-size: 0.9rem;
      color: #333;
    }

    input, select, textarea {
      margin-top: 5px;
      padding: 8px 12px;
      font-size: 1rem;
      border: 1.5px solid #ced4da;
      border-radius: 5px;
      transition: border-color 0.3s ease;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #00C853;
      box-shadow: 0 0 6px #0A1128;
    }

    textarea {
      resize: vertical;
      min-height: 70px;
      max-height: 150px;
    }

    button[type="submit"] {
      align-self: flex-start;
      padding: 10px 25px;
      background-color: #00C853;
      color: white;
      font-weight: 700;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
      background-color: #00C853;
    }

    .message {
      margin-top: 15px;
      font-weight: 700;
      color: #28a745;
      font-size: 1.1rem;
      display: none;
    }

    /* Validation error styles */
    .error-messages {
      margin-top: -10px;
      margin-bottom: 10px;
      color: #dc3545;
      font-size: 0.875rem;
      font-weight: 600;
      list-style-type: none;
      padding-left: 0;
    }
    .error-messages li {
      margin-left: 0;
    }

    /* Final Thank you */
    #finalThankYou {
      font-size: 1.4rem;
      color: #155724;
      background-color: #d4edda;
      padding: 25px 40px;
      border-radius: 10px;
      border: 1px solid #c3e6cb;
      max-width: 600px;
      width: 90vw;
      text-align: center;
      margin-top: 30px;
      display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
      body {
        padding: 15px 10px;
        margin-top:90px;
      }
      form {
        padding: 20px;
      }
      .prompt {
        padding: 15px;
      }
      label {
        font-size: 0.85rem;
      }
      button[type="submit"], .prompt-buttons button {
        font-size: 0.9rem;
        padding: 10px;
      }
    }
  </style>
</head>
<body>
<!-- Everything else below remains unchanged from your code -->
<!-- Keep your HTML body and script intact as you shared it -->

<h2>Data Registration Workflow</h2>

<div id="promptContainer"></div>

<!-- CLIENT FORM -->
<form id="clientForm" novalidate>
  <h3>Register Client</h3>
  <label>Name*:
    <input type="text" name="name" required placeholder="Full name" />
    <ul class="error-messages" id="client-name-errors"></ul>
  </label>
  <label>Phone*:
    <input type="tel" name="phone" required placeholder="+250 7XXXXXXXX" />
    <ul class="error-messages" id="client-phone-errors"></ul>
  </label>
  <label>Email:
    <input type="email" name="email" placeholder="email@example.com" />
    <ul class="error-messages" id="client-email-errors"></ul>
  </label>
  <label>Address:
    <input type="text" name="address" placeholder="Street address" />
    <ul class="error-messages" id="client-address-errors"></ul>
  </label>
  <label>City:
    <input type="text" name="city" placeholder="City" />
    <ul class="error-messages" id="client-city-errors"></ul>
  </label>
  <label>Country:
    <input type="text" name="country" value="Rwanda" />
    <ul class="error-messages" id="client-country-errors"></ul>
  </label>
  <label>National ID:
    <input type="text" name="national_id" placeholder="ID number" />
    <ul class="error-messages" id="client-national_id-errors"></ul>
  </label>
  <label>Gender:
    <select name="gender">
      <option value="">Select gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select>
    <ul class="error-messages" id="client-gender-errors"></ul>
  </label>
  <label>Date of Birth:
    <input type="date" name="date_of_birth" />
    <ul class="error-messages" id="client-date_of_birth-errors"></ul>
  </label>
  <label>Notes:
    <textarea name="notes" placeholder="Additional info"></textarea>
    <ul class="error-messages" id="client-notes-errors"></ul>
  </label>
  <button type="submit">Save Client</button>
  <div class="message" id="clientSuccess">Client saved successfully!</div>
</form>

<!-- DEVICE FORM -->
<form id="deviceForm" novalidate>
  <h3>Register Device</h3>
  <input type="hidden" name="client_id" id="deviceClientId" />
  <label>Brand*:
    <input type="text" name="brand" required placeholder="Brand" />
    <ul class="error-messages" id="device-brand-errors"></ul>
  </label>
  <label>Model*:
    <input type="text" name="model" required placeholder="Model" />
    <ul class="error-messages" id="device-model-errors"></ul>
  </label>
  <label>Serial Number*:
    <input type="text" name="serial_number" required placeholder="Serial Number" />
    <ul class="error-messages" id="device-serial_number-errors"></ul>
  </label>
  <label>IMEI 1:
    <input type="text" name="imei_1" placeholder="IMEI 1" />
    <ul class="error-messages" id="device-imei_1-errors"></ul>
  </label>
  <label>IMEI 2:
    <input type="text" name="imei_2" placeholder="IMEI 2" />
    <ul class="error-messages" id="device-imei_2-errors"></ul>
  </label>
  <label>IMEI 3 / MAC / Plate:
    <input type="text" name="imei_3_or_mac_or_plate" placeholder="IMEI 3 / MAC / Plate" />
    <ul class="error-messages" id="device-imei_3_or_mac_or_plate-errors"></ul>
  </label>
  <label>Type:
    <input type="text" name="type" placeholder="Device type" />
    <ul class="error-messages" id="device-type-errors"></ul>
  </label>
  <label>Operating System:
    <input type="text" name="os" placeholder="OS" />
    <ul class="error-messages" id="device-os-errors"></ul>
  </label>
  <label>Status:
    <select name="status">
      <option value="active" selected>Active</option>
      <option value="inactive">Inactive</option>
      <option value="under_repair">Under Repair</option>
      <option value="lost">Lost</option>
      <option value="stolen">Stolen</option>
      <option value="repair_approved">Repair Approved</option>
    </select>
    <ul class="error-messages" id="device-status-errors"></ul>
  </label>
  <label>Purchase Date:
    <input type="date" name="purchase_date" />
    <ul class="error-messages" id="device-purchase_date-errors"></ul>
  </label>
  <label>Warranty Expiry:
    <input type="date" name="warranty_expiry" />
    <ul class="error-messages" id="device-warranty_expiry-errors"></ul>
  </label>
  <label>Location:
    <input type="text" name="location" placeholder="Location" />
    <ul class="error-messages" id="device-location-errors"></ul>
  </label>
  <label>Notes:
    <textarea name="notes" placeholder="Additional info"></textarea>
    <ul class="error-messages" id="device-notes-errors"></ul>
  </label>
  <button type="submit">Save Device</button>
  <div class="message" id="deviceSuccess">Device saved successfully!</div>
</form>

<!-- TECHNICIAN FORM -->
<form id="technicianForm" novalidate>
  <h3>Register Technician</h3>
  <input type="hidden" name="device_id" id="techDeviceId" />
  <label>Name*:
    <input type="text" name="name" required placeholder="Technician full name" />
    <ul class="error-messages" id="tech-name-errors"></ul>
  </label>
  <label>Email:
    <input type="email" name="email" placeholder="email@example.com" />
    <ul class="error-messages" id="tech-email-errors"></ul>
  </label>
  <label>Phone:
    <input type="tel" name="phone" placeholder="+250 7XXXXXXXX" />
    <ul class="error-messages" id="tech-phone-errors"></ul>
  </label>
  <label>Expertise*:
    <input type="text" name="expertise" required placeholder="e.g., Hardware, Software" />
    <ul class="error-messages" id="tech-expertise-errors"></ul>
  </label>
  <label>Years of Experience:
    <input type="number" min="0" name="experience_years" placeholder="Number of years" />
    <ul class="error-messages" id="tech-experience_years-errors"></ul>
  </label>
  <label>Certifications:
    <input type="text" name="certifications" placeholder="Certifications" />
    <ul class="error-messages" id="tech-certifications-errors"></ul>
  </label>
  <label>Status:
    <select name="status">
      <option value="active" selected>Active</option>
      <option value="inactive">Inactive</option>
      <option value="on_leave">On Leave</option>
    </select>
    <ul class="error-messages" id="tech-status-errors"></ul>
  </label>
  <label>Location:
    <input type="text" name="location" placeholder="Location" />
    <ul class="error-messages" id="tech-location-errors"></ul>
  </label>
  <label>Notes:
    <textarea name="notes" placeholder="Additional info"></textarea>
    <ul class="error-messages" id="tech-notes-errors"></ul>
  </label>
  <label>Registered On:
    <input type="date" name="registered_on" />
    <ul class="error-messages" id="tech-registered_on-errors"></ul>
  </label>
  <label>Received By:
    <input type="text" name="received_by" placeholder="Who received the technician" />
    <ul class="error-messages" id="tech-received_by-errors"></ul>
  </label>
  <label>Position:
    <input type="text" name="position" placeholder="Position" />
    <ul class="error-messages" id="tech-position-errors"></ul>
  </label>
  <button type="submit">Save Technician</button>
  <div class="message" id="techSuccess">Technician saved successfully!</div>
</form>

<div id="finalThankYou">Thank you! All data processing completed.</div>

<script>
  const promptContainer = document.getElementById('promptContainer');

  const forms = {
    client: document.getElementById('clientForm'),
    device: document.getElementById('deviceForm'),
    technician: document.getElementById('technicianForm'),
  };

  const successMsgs = {
    client: document.getElementById('clientSuccess'),
    device: document.getElementById('deviceSuccess'),
    technician: document.getElementById('techSuccess'),
  };

  const finalThankYou = document.getElementById('finalThankYou');
  let currentStep = 0;
  let clientId = null;
  let deviceId = null;

  const steps = [
    {name: 'client', label: 'client'},
    {name: 'device', label: 'device'},
    {name: 'technician', label: 'technician'}
  ];

  function createPrompt(label) {
    return `
      <div class="prompt" id="promptBox">
        <span class="close-btn" id="closePrompt">&times;</span>
        <p>Do you want to record <b>${label}</b> data?</p>
        <div class="prompt-buttons">
          <button class="yes" id="yesBtn">Yes</button>
          <button class="no" id="noBtn">No</button>
        </div>
      </div>
    `;
  }

  function showPrompt() {
    if (currentStep >= steps.length) {
      promptContainer.innerHTML = '';
      hideAllForms();
      finalThankYou.style.display = 'block';
      return;
    }

    const step = steps[currentStep];
    promptContainer.innerHTML = createPrompt(step.label);

    document.getElementById('yesBtn').onclick = () => {
      promptContainer.innerHTML = '';
      showForm(step.name);
    };

    document.getElementById('noBtn').onclick = skipStep;
    document.getElementById('closePrompt').onclick = skipStep;
  }

  function showForm(name) {
    hideAllForms();
    const form = forms[name];

    if (name === 'device' && clientId) {
      form.querySelector('#deviceClientId').value = clientId;
    }
    if (name === 'technician' && deviceId) {
      form.querySelector('#techDeviceId').value = deviceId;
    }

    form.classList.add('active');
  }

  function hideAllForms() {
    Object.values(forms).forEach(f => {
      f.classList.remove('active');
      successMsgs.client.style.display = 'none';
      successMsgs.device.style.display = 'none';
      successMsgs.technician.style.display = 'none';
      clearFormErrors(f);
    });
    finalThankYou.style.display = 'none';
  }

  function skipStep() {
    currentStep++;
    hideAllForms();
    showPrompt();
  }

  function clearFormErrors(form) {
    form.querySelectorAll('.error-messages').forEach(ul => {
      ul.innerHTML = '';
    });
  }

  function showFormErrors(form, errors) {
    for (const [field, messages] of Object.entries(errors)) {
      const errorList = form.querySelector(`#${form.id}-${field.replace(/[\[\]]+/g, '-')}-errors`);
      if (errorList) {
        errorList.innerHTML = '';
        messages.forEach(msg => {
          const li = document.createElement('li');
          li.textContent = msg;
          errorList.appendChild(li);
        });
      }
    }
  }

  function getRouteForForm(name) {
    switch(name) {
      case 'client': return '/clients';
      case 'device': return '/devices';
      case 'technician': return '/technicians';
      default: return '/';
    }
  }

  function handleSubmit(formName, formElement, successCallback) {
    formElement.addEventListener('submit', function(e) {
      e.preventDefault();
      clearFormErrors(formElement);
      const formData = new FormData(formElement);
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      fetch(getRouteForForm(formName), {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if(data.success){
          successMsgs[formName].style.display = 'block';

          if (formName === 'client') clientId = data.client_id;
          if (formName === 'device') deviceId = data.device_id;

          setTimeout(() => {
            formElement.classList.remove('active');
            successMsgs[formName].style.display = 'none';
            currentStep++;
            showPrompt();
          }, 1500);

          if (typeof successCallback === 'function') successCallback(data);
        } else if(data.errors) {
          showFormErrors(formElement, data.errors);
        } else {
          alert(`Error saving ${formName} data.`);
        }
      }).catch(() => alert('Network error, please try again.'));
    });
  }

  // Attach submit handlers
  handleSubmit('client', forms.client);
  handleSubmit('device', forms.device);
  handleSubmit('technician', forms.technician);

  // Start first prompt
  showPrompt();
</script>


</body>
</html>
@include('layouts.footer')
