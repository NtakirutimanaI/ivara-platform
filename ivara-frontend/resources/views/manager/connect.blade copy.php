<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UMURINZI CTA</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .umurunzi-cta-section {
      position: absolute;         /* Float near sidebar */
      top: 200px;                 /* Distance from top */
      left: 85px;                 /* Distance from left */
      max-width: 150px;
      animation: umurunzi-slideIn 1s ease-out forwards;
      opacity: 0;
      transition: transform 0.3s ease-in-out;
      z-index: 10;                /* On top of content */
    }

    .umurunzi-cta-section img {
      width: 100%;
      height: auto;
      display: block;
      border-radius: 8px;
    }

    @keyframes umurunzi-slideIn {
      from {
        transform: translateX(-50px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @media (max-width: 600px) {
      .umurunzi-cta-section {
        display: none !important;  /* Hide on small screens */
      }
    }
  </style>
</head>
<body>
  <!-- UMURINZI CTA Block -->
  <div class="umurunzi-cta-section" id="umurunzi">
    <img src="{{ asset('images/arrows.png') }}" alt="UMURINZI CONNECT NOW" />
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const umurunziSection = document.getElementById("umurunzi");
      umurunziSection.style.opacity = "1";
    });
  </script>
</body>
</html>
