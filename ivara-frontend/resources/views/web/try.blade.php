
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
    }

    /* Section Styles */
    .cta-section {
      background: #001633;
      color: #fff;
      text-align: center;
      padding: 4rem 1rem;
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
    }

    .cta-section p {
      color: #ffb700;
      font-weight: 600;
      font-size: 0.85rem;
      margin-bottom: 1rem;
    }

    .cta-section h2 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 2rem;
      line-height: 1.3;
      color: #ffffff;
    }

    .cta-section a {
      background: #ffb700;
      color: #000;
      text-decoration: none;
      font-weight: bold;
      padding: 0.75rem 2rem;
      border-radius: 999px;
      display: inline-block;
      transition: background 0.3s ease;
    }

    .cta-section a:hover {
      background: #e6a800;
    }

    @media (max-width: 600px) {
      .cta-section h2 {
        font-size: 1.6rem;
      }

      .cta-section a {
        padding: 0.6rem 1.5rem;
      }
    }
  </style>
</head>
<body>

  <section class="cta-section">
    <div style="max-width: 800px; margin: auto;">
      <p>Ready to Protect Your Community?</p>
      <h2>
        Experience secure, efficient<br> community protection with <br> IVARA!
      </h2>
      <a href="{{ route('register') }}">
        Be Part Of Us Now! &rarr;
      </a>
    </div>
  </section>

