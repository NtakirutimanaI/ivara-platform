<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Green Overlay Cover</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
      height: 100%;
      background: #111;
      color: white;
      font-family: sans-serif;
    }

    .green-overlay-container {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 30%;
      pointer-events: none;
      overflow: hidden;
      z-index: 999;
    }

    .green-overlay-apple {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      height: 300px;
      opacity: 0.05;
      z-index: 0;
    }

    .green-overlay-shape {
      position: absolute;
      background:rgba(255, 183, 0, 0.15);
      border: 2px solid rgba(128, 98, 0, 0.3);
      border-radius: 50%;
      z-index: 1;
      animation: green-overlay-float 6s ease-in-out infinite;
    }

    .green-overlay-circle1 {
      width: 80px;
      height: 80px;
      top: 10%;
      left: 10%;
      animation-delay: 0s;
    }

    .green-overlay-circle2 {
      width: 60px;
      height: 60px;
      top: 40%;
      right: 15%;
      animation-delay: 1s;
    }

    .green-overlay-circle3 {
      width: 50px;
      height: 50px;
      bottom: 10%;
      left: 25%;
      animation-delay: 2s;
    }

    .green-overlay-flower {
      width: 80px;
      height: 80px;
      top: 20%;
      right: 20%;
      clip-path: polygon(
        50% 0%, 61% 35%, 98% 35%, 68% 57%,
        79% 91%, 50% 70%, 21% 91%, 32% 57%,
        2% 35%, 39% 35%
      );
      border-radius: 0;
      animation: green-overlay-rotatePulse 8s ease-in-out infinite;
    }

    .green-overlay-grape-cluster {
      display: flex;
      flex-wrap: wrap;
      width: 80px;
      position: absolute;
      left: 5%;
      bottom: 10%;
      animation: green-overlay-float 7s ease-in-out infinite reverse;
    }

    .green-overlay-grape {
      width: 16px;
      height: 16px;
      margin: 2px;
      border-radius: 50%;
      background: rgba(0, 128, 0, 0.3);
      border: 1.5px solid rgba(0, 128, 0, 0.3);
    }

    @keyframes green-overlay-float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
    }

    @keyframes green-overlay-rotatePulse {
      0%, 100% {
        transform: rotate(0deg) scale(1);
      }
      50% {
        transform: rotate(20deg) scale(1.1);
      }
    }

    @media (max-width: 600px) {
      .green-overlay-apple {
        width: 200px;
        height: 200px;
      }

      .green-overlay-shape,
      .green-overlay-grape-cluster {
        transform: scale(0.8);
      }
    }
  </style>
</head>
<body>

  <!-- GREEN OVERLAY BOTTOM COVER -->
  <div class="green-overlay-container">
    <!-- Apple background -->
    <div class="green-overlay-apple">
      <svg viewBox="0 0 100 100" width="100%" height="100%">
        <path d="M50 15
                 C 65 5, 90 30, 80 60
                 C 70 90, 30 90, 20 60
                 C 10 30, 35 5, 50 15
                 M50 5
                 C 45 15, 55 15, 50 5"
              fill="white" />
      </svg>
    </div>

    <!-- Green transparent animated shapes -->
    <div class="green-overlay-shape green-overlay-circle1"></div>
    <div class="green-overlay-shape green-overlay-circle2"></div>
    <div class="green-overlay-shape green-overlay-circle3"></div>
    <div class="green-overlay-shape green-overlay-flower"></div>

    <!-- Grape cluster -->
    <div class="green-overlay-grape-cluster">
      <div class="green-overlay-grape"></div>
      <div class="green-overlay-grape"></div>
      <div class="green-overlay-grape"></div>
      <div class="green-overlay-grape"></div>
      <div class="green-overlay-grape"></div>
      <div class="green-overlay-grape"></div>
    </div>
  </div>
</body>
</html>
