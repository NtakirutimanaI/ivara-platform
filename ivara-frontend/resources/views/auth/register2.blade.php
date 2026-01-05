@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Select Business Type</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f7f9fc;
    }

    .header {
      background-color: #021c3d;
      padding: 40px 20px;
      color: white;
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
    }

    .container {
      max-width: 500px;
      margin: auto;
      padding: 20px;
    }

    .title {
      font-size: 1.4rem;
      font-weight: bold;
      color: #222;
      margin-bottom: 8px;
    }

    .subtitle {
      color: #555;
      font-size: 0.95rem;
      margin-bottom: 20px;
    }

    .option {
      display: flex;
      align-items: center;
      border: 2px solid #ddd;
      border-radius: 12px;
      padding: 12px 16px;
      margin-bottom: 12px;
      cursor: pointer;
      background: #fff;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .option:hover {
      border-color: #0056b3;
    }

    .option.selected {
      border-color: #0d9488;
      box-shadow: 0 0 8px rgba(13, 148, 136, 0.3);
    }

    .icon {
      font-size: 1.6rem;
      margin-right: 12px;
      color: #0d9488;
    }

    .option-info {
      display: flex;
      flex-direction: column;
    }

    .option-title {
      font-weight: bold;
      font-size: 1.2rem;
      color: #0A1128;
    }

    .option-desc {
      font-size: 0.85rem;
      color: #666;
    }

    .submit-btn {
      display: block;
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      font-size: 1rem;
      font-weight: bold;
      color: white;
      background-color: #00C853;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: rgb(255, 182, 0);
    }

    @media (max-width: 600px) {
      .container { margin-top: 160px; padding: 16px; }
      .header { padding: 30px 15px; font-size: 1.6rem; }
      .title { font-size: 1.2rem; }
      .subtitle { font-size: 0.85rem; margin-bottom: 16px; }
      .option { padding: 10px 12px; }
      .icon { font-size: 1.4rem; margin-right: 10px; }
      .option-title { font-size: 1rem; }
      .option-desc { font-size: 0.8rem; }
      .submit-btn { font-size: 0.95rem; padding: 10px; }
    }
  </style>
</head>
<body>

<div class="header">IVARA</div>

<div class="container">
  <div class="title">One Last Step</div>
  <div class="subtitle">Select your membership type</div>

  <form id="businessForm" method="POST" action="{{ route('auth.saveBusinessType') }}">
    @csrf
    @php
      $options = [
        'BusinessPerson' => ['icon' => '💼', 'desc' => 'Entrepreneurs, Freelancers'],
        'Technician'     => ['icon' => '🔧', 'desc' => 'Electronics, Repair Services'],
        'Mechanic'       => ['icon' => '🚗', 'desc' => 'Auto repair, Garage Services'],
        'Tailor'         => ['icon' => '🧵', 'desc' => 'Clothing & Alterations'],
        'Craftsperson'   => ['icon' => '🎨', 'desc' => 'Woodwork, Handicrafts'],
        'Mediator'       => ['icon' => '🤝', 'desc' => 'Negotiation, Conflict Resolution'],
        'Client'         => ['icon' => '👤', 'desc' => 'Customer looking for services'],
      ];
    @endphp

    @foreach($options as $key => $val)
      <div class="option" onclick="selectOption(this)" data-value="{{ $key }}">
        <div class="icon">{{ $val['icon'] }}</div>
        <div class="option-info">
          <div class="option-title">{{ $key }}</div>
          <div class="option-desc">{{ $val['desc'] }}</div>
        </div>
      </div>
    @endforeach

    <input type="hidden" name="business_type" id="businessType">
    <button type="submit" class="submit-btn">Continue</button>
  </form>
</div>

<script>
  function selectOption(element) {
    document.querySelectorAll('.option').forEach(opt => opt.classList.remove('selected'));
    element.classList.add('selected');
    document.getElementById('businessType').value = element.getAttribute('data-value');
  }

  document.getElementById('businessForm').addEventListener('submit', function(e) {
    const selected = document.getElementById('businessType').value;
    if (!selected) {
      e.preventDefault();
      alert('Please select a business type.');
    }
  });
</script>

</body>
</html>

@include('layouts.footer')
