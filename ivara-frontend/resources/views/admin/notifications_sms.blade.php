@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')
@include('admin.fruits')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>
    /* Reset */
    body, html {
      margin: 0; padding: 0; height: 100%;
      background: #924FC2;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: white;
      padding: 1rem;
      box-sizing: border-box;
    }

    /* Container Card */
    .p-6 {
      padding: 1.5rem;
    }
    .bg-white {
      background-color: #fff;
      color: #071839;
    }
    
    .rounded-lg {
      border-radius: 0.75rem;
    }
    .max-w-md {
      max-width: 28rem; /* 448px */
      width: 100%;
    }
    .mx-auto {
      margin-left: auto;
      margin-right: auto;
    }
    .mt-10 {
      margin-top: 2.5rem;
    }

    /* Title */
    h1.text-3xl {
      font-family: 'Inter', sans-serif;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      text-align: center;
      color: #924FC2;
    }

    /* Buttons container */
    .flex {
      display: flex;
    }
    .flex-col {
      flex-direction: column;
    }
    .gap-4 {
      gap: 1rem;
    }

    /* Buttons */
    a.block {
      display: block;
      text-align: center;
      padding: 0.75rem 1.5rem;
      border-radius: 0.75rem;
      font-weight: 700;
      font-size: 1.2rem;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 0 12px transparent;
      text-decoration: none;
    }

    a.bg-blue-600 {
      background-color:#0A1128;
      color: white;
      box-shadow: 0 0 12px #2563ebaa;
    }
    a.bg-blue-600:hover {
      background-color: #1d4ed8;
      color: #0A1128;
    }

    a.bg-green-600 {
      background-color: #924FC2;
      color: white;
      box-shadow: 0 0 12px #924FC2;
    }
    a.bg-green-600:hover {
      background-color: #924FC2;
      color: #0A1128;
    }

    /* Responsive */
    @media (max-width: 480px) {
      h1.text-3xl {
        font-size: 1.8rem;
        margin-bottom: 1rem;
      }
      a.block {
        font-size: 1rem;
        padding: 0.6rem 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="p-6 bg-white shadow rounded-lg max-w-md mx-auto mt-10">
      <h1 class="text-3xl font-bold mb-6 text-center">Admin Dashboard</h1>

      <div class="flex flex-col gap-4">
          <a href="{{ route('admin.sms') }}" 
             class="block text-center py-3 px-6 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
             SMS
          </a>

          <a href="{{ route('admin.notifications') }}" 
             class="block text-center py-3 px-6 bg-green-600 text-white rounded hover:bg-green-700 transition">
             Notifications
          </a>
      </div>
  </div>

</body>
</html>
