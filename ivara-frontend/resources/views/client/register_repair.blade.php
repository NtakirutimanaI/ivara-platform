@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>UMURINZI | Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

  <style>
    .bg-overlay {
      background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.2));
    }
    .link-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      font-size: 0.875rem;
      text-decoration: none;
      box-shadow: 0 1px 4px rgba(0,0,0,0.15);
      transition: background-color 0.3s ease;
    }
    .link-button i {
      margin-right: 0.4rem;
    }
    .link-button-indigo {
      background-color: #4f46e5;
      color: white;
    }
    .link-button-indigo:hover {
      background-color: #FFB700;
    }
    .link-button-blue-light {
      background-color: #4f46e5;
      color: white;
    }
    .link-button-blue-light:hover {
      background-color: #FFB700;
    }
    .link-button-green {
      background-color: #4f46e5;
      color: white;
    }
    .link-button-green:hover {
      background-color: #FFB700;
    }
  </style>
</head>
<body class="text-sm bg-gray-50 font-sans" style="margin-left:240px; margin-top:80px;">

  <div class="container mx-auto min-h-screen flex flex-col md:flex-row shadow-md bg-white rounded-lg overflow-hidden mt-4 px-4 md:px-0">

    <!-- Left Column -->
    <div class="md:w-1/2 w-full bg-cover bg-center relative" style="background-image: url('{{ asset('images/iPhone.png') }}'); min-height: 320px;">
      <div class="absolute inset-0 bg-overlay"></div>
      <div class="absolute bottom-6 left-6 text-white z-10 max-w-xs md:max-w-md" data-aos="fade-up">
        <h1 class="text-3xl font-bold mb-1">UMURINZI</h1>
        <p class="text-sm">Your trusted guardian platform for community resilience, alerts, and coordination.</p>
      </div>
    </div>

    <!-- Right Column -->
    <div class="md:w-1/2 w-full flex flex-col justify-center items-center md:items-start p-6 space-y-6 bg-white">
      <div data-aos="fade-down" class="text-center w-full max-w-md">
        <img src="{{ asset('images/support3.png') }}" alt="UMURINZI Logo" class="mx-auto mb-2 max-w-full h-auto" style="width: 320px;">
        <p class="text-gray-600 text-sm">
          "Want to keep your device safe? Register it now with UMURINZI and ensure secure tracking!"
        </p>
      </div>

      <div class="space-y-3 w-full max-w-md" data-aos="fade-right">
        <a href="{{ route('client.register_device') }}" class="link-button link-button-indigo" style="max-width: 160px; padding: 6px 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          <i class="fa-solid fa-shield-alt"></i> Register Device
        </a>

        <a href="{{ route('client.reports') }}" class="link-button link-button-green" style="max-width: 160px; padding: 6px 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          <i class="fa fa-users"></i> Reports
        </a>

        <a href="{{ route('client.repair_device') }}" class="link-button link-button-green" style="max-width: 160px; padding: 6px 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          <i class="fa fa-users"></i> Repair Device
        </a>

        <a href="{{ route('client.register_view_data') }}" class="link-button link-button-blue-light" style="max-width: 160px; padding: 6px 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          <i class="fa fa-bar-chart"></i> Device Owners
        </a>

        <a href="{{ route('client.device') }}" class="link-button link-button-green" style="max-width: 160px; padding: 6px 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          <i class="fa fa-users"></i> Registered Devices
        </a>

        <a href="{{ route('client.technicians') }}" class="link-button link-button-green" style="max-width: 160px; padding: 6px 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
          <i class="fa fa-users"></i> Technicians Actions
        </a>
      </div>

      <div data-aos="fade-up" data-aos-delay="300" class="w-full max-w-md">
        <h3 class="text-base font-semibold mb-1 text-gray-900">Key Features:</h3>
        <ul class="list-disc pl-4 space-y-1 text-gray-700 text-sm">
          <li>Real-time emergency communication</li>
          <li>Community coordination tools</li>
          <li>Integrated location tracking</li>
          <li>Custom reports and dashboards</li>
        </ul>
      </div>
    </div>
  </div>

  <script>
    AOS.init({ duration: 800, once: true });
  </script>
</body>
</html>
@include('layouts.footer')