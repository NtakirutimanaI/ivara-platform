@include('layouts.header')
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Client, Device, Technician</title>
  <style>
    /* Basic styles, border-bottom only, concise height */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 20px; background: #f5f7fa; color: #333;
      min-height: 100vh;
      display: flex; flex-direction: column; align-items: center;
      margin-top:60px;
    }
    h2 {
      margin-bottom: 15px;
      color: #222;
    }
    form {
      background: white;
      max-width: 600px;
      width: 90vw;
      padding: 15px 25px 20px 25px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgb(0 0 0 / 0.1);
      margin-bottom: 30px;
    }
    form h3 {
      margin-top: 0;
      margin-bottom: 15px;
      color: #00C853;
    }
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: 600;
      font-size: 0.9rem;
      color: #333;
    }
    input, select, textarea {
      width: 100%;
      padding: 6px 10px;
      font-size: 1rem;
      border: none;
      border-bottom: 2px solid #ced4da;
      border-radius: 0;
      transition: border-color 0.3s ease;
      height: 30px;
      box-sizing: border-box;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-bottom-color: #00C853;
      box-shadow: 0 2px 6px #00C853a0;
    }
    textarea {
      resize: vertical;
      min-height: 40px;
      max-height: 90px;
    }
    button[type="submit"] {
      margin-top: 15px;
      padding: 10px 25px;
      background-color: #00C853;
      color: white;
      font-weight: 700;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      height: 38px;
    }
    button[type="submit"]:hover {
      background-color: #008f3e;
    }
    .error {
      color: #dc3545;
      font-size: 0.85rem;
      margin-top: 5px;
    }
    .success-message {
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 25px;
      max-width: 600px;
      width: 90vw;
      text-align: center;
    }

    /* NEW: phone input + country code wrapper */
    .phone-group {
      display: flex;
      gap: 8px;
      align-items: center;
    }
    .phone-group select.country-code {
      width: 30%;
      max-width: 100px;
      padding: 6px 8px;
      font-size: 1rem;
      border: none;
      border-bottom: 2px solid #ced4da;
      border-radius: 0;
      height: 30px;
      background: white;
      color: #333;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
      cursor: pointer;
    }
    .phone-group select.country-code:focus {
      outline: none;
      border-bottom-color: #00C853;
      box-shadow: 0 2px 6px #00C853a0;
    }
    .phone-group input[type="tel"] {
      width: 100%;
      flex-grow: 1;
      padding-left: 10px;
      box-sizing: border-box;
    }

    @media (max-width: 480px) {
      .phone-group {
        flex-direction: column;
        align-items: stretch;
      }
      .phone-group select.country-code {
        width: 100%;
        max-width: none;
        margin-bottom: 6px;
      }
      .phone-group input[type="tel"] {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<h2>Data Registration Workflow</h2>

@if(session('success'))
  <div class="success-message">{{ session('success') }}</div>
@endif

{{-- Step 1: Client Form --}}
@if($step === 1)
  <form method="POST" action="{{ route('clients.store') }}">
    @csrf
    <h3>Register Client</h3>

    <label>Name*:
      <input type="text" name="name" value="{{ old('name') }}" required />
      @error('name') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Phone*:
      <div class="phone-group">
        <select name="phone_country_code" class="country-code" required>
          <option value="+1">+1 USA</option>
          <option value="+44">+44 UK</option>
          <option value="+250" selected>+250 Rwanda</option>
          <option value="+254">+254 Kenya</option>
          <option value="+255">+255 Tanzania</option>
          <option value="+256">+256 Uganda</option>
          <option value="+27">+27 South Africa</option>
          <option value="+233">+233 Ghana</option>
          <option value="+20">+20 Egypt</option>
          <!-- Add more country codes as needed -->
        </select>
        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Phone number without country code" />
      </div>
      @error('phone') <div class="error">{{ $message }}</div> @enderror
      @error('phone_country_code') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Email:
      <input type="email" name="email" value="{{ old('email') }}" />
      @error('email') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Address:
      <input type="text" name="address" value="{{ old('address') }}" />
      @error('address') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>City:
      <input type="text" name="city" value="{{ old('city') }}" />
      @error('city') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Country:
      <input type="text" name="country" value="{{ old('country', 'Rwanda') }}" />
      @error('country') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>National ID:
      <input type="text" name="national_id" value="{{ old('national_id') }}" />
      @error('national_id') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Gender:
      <select name="gender">
        <option value="" @if(old('gender') === '') selected @endif>Select gender</option>
        <option value="Male" @if(old('gender') === 'Male') selected @endif>Male</option>
        <option value="Female" @if(old('gender') === 'Female') selected @endif>Female</option>
        <option value="Other" @if(old('gender') === 'Other') selected @endif>Other</option>
      </select>
      @error('gender') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Date of Birth:
      <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" />
      @error('date_of_birth') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Notes:
      <textarea name="notes">{{ old('notes') }}</textarea>
      @error('notes') <div class="error">{{ $message }}</div> @enderror
    </label>

    <button type="submit">Save Client</button>
  </form>
@endif

{{-- Step 2: Device Form --}}
@if($step === 2)
  <form method="POST" action="{{ route('devices.store') }}">
    @csrf
    <input type="hidden" name="client_id" value="{{ $client_id }}" />

    <h3>Register Device</h3>

    <label>Brand*:
      <input type="text" name="brand" value="{{ old('brand') }}" required />
      @error('brand') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Model*:
      <input type="text" name="model" value="{{ old('model') }}" required />
      @error('model') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Serial Number*:
      <input type="text" name="serial_number" value="{{ old('serial_number') }}" required />
      @error('serial_number') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>IMEI 1:
      <input type="text" name="imei_1" value="{{ old('imei_1') }}" />
      @error('imei_1') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>IMEI 2:
      <input type="text" name="imei_2" value="{{ old('imei_2') }}" />
      @error('imei_2') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>IMEI 3 / MAC / Plate:
      <input type="text" name="imei_3_or_mac_or_plate" value="{{ old('imei_3_or_mac_or_plate') }}" />
      @error('imei_3_or_mac_or_plate') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Type:
      <input type="text" name="type" value="{{ old('type') }}" />
      @error('type') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Operating System:
      <input type="text" name="os" value="{{ old('os') }}" />
      @error('os') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Status:
      <select name="status">
        <option value="active" @if(old('status') === 'active') selected @endif>Active</option>
        <option value="inactive" @if(old('status') === 'inactive') selected @endif>Inactive</option>
        <option value="under_repair" @if(old('status') === 'under_repair') selected @endif>Under Repair</option>
        <option value="lost" @if(old('status') === 'lost') selected @endif>Lost</option>
        <option value="stolen" @if(old('status') === 'stolen') selected @endif>Stolen</option>
        <option value="repair_approved" @if(old('status') === 'repair_approved') selected @endif>Repair Approved</option>
      </select>
      @error('status') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Purchase Date:
      <input type="date" name="purchase_date" value="{{ old('purchase_date') }}" />
      @error('purchase_date') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Warranty Expiry:
      <input type="date" name="warranty_expiry" value="{{ old('warranty_expiry') }}" />
      @error('warranty_expiry') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Location:
      <input type="text" name="location" value="{{ old('location') }}" />
      @error('location') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Notes:
      <textarea name="notes">{{ old('notes') }}</textarea>
      @error('notes') <div class="error">{{ $message }}</div> @enderror
    </label>

    <button type="submit">Save Device</button>
  </form>
@endif

{{-- Step 3: Technician Form --}}
@if($step === 3)
  <form method="POST" action="{{ route('technicians.store') }}">
    @csrf
    <input type="hidden" name="device_id" value="{{ $device_id }}" />

    <h3>Register Technician</h3>

    <label>Name*:
      <input type="text" name="name" value="{{ old('name') }}" required />
      @error('name') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Email:
      <input type="email" name="email" value="{{ old('email') }}" />
      @error('email') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Phone:
      <div class="phone-group">
        <select name="phone_country_code" class="country-code">
          <option value="+1">+1 USA</option>
          <option value="+44">+44 UK</option>
          <option value="+250" selected>+250 Rwanda</option>
          <option value="+254">+254 Kenya</option>
          <option value="+255">+255 Tanzania</option>
          <option value="+256">+256 Uganda</option>
          <option value="+27">+27 South Africa</option>
          <option value="+233">+233 Ghana</option>
          <option value="+20">+20 Egypt</option>
          <!-- Add more country codes as needed -->
        </select>
        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone number without country code" />
      </div>
      @error('phone') <div class="error">{{ $message }}</div> @enderror
      @error('phone_country_code') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Expertise*:
      <input type="text" name="expertise" value="{{ old('expertise') }}" required />
      @error('expertise') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Years of Experience:
      <input type="number" min="0" name="experience_years" value="{{ old('experience_years') }}" />
      @error('experience_years') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Certifications:
      <input type="text" name="certifications" value="{{ old('certifications') }}" />
      @error('certifications') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Status:
      <select name="status">
        <option value="active" @if(old('status') === 'active') selected @endif>Active</option>
        <option value="inactive" @if(old('status') === 'inactive') selected @endif>Inactive</option>
        <option value="on_leave" @if(old('status') === 'on_leave') selected @endif>On Leave</option>
      </select>
      @error('status') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Location:
      <input type="text" name="location" value="{{ old('location') }}" />
      @error('location') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Notes:
      <textarea name="notes">{{ old('notes') }}</textarea>
      @error('notes') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Registered On:
      <input type="date" name="registered_on" value="{{ old('registered_on') }}" />
      @error('registered_on') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Received By:
      <input type="text" name="received_by" value="{{ old('received_by') }}" />
      @error('received_by') <div class="error">{{ $message }}</div> @enderror
    </label>

    <label>Position:
      <input type="text" name="position" value="{{ old('position') }}" />
      @error('position') <div class="error">{{ $message }}</div> @enderror
    </label>

    <button type="submit">Save Technician</button>
  </form>
@endif

{{-- Final thank you message --}}
@if($step === 4)
  <div class="success-message">Thank you! All data processing completed.</div>
@endif

</body>
</html>
