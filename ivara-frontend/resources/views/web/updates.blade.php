@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Updates</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f9fafc;
      color: #071839;
      margin: 1rem;
      font-size: 0.85rem;
    }
    h1 {
      text-align: center;
      margin-bottom: 1rem;
      font-weight: 700;
      font-size: 1.2rem;
    }

    /* Container */
    .container {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      align-items: flex-start;
      justify-content: center;
      
    }

    .image-section {
      flex: 1 1 200px;
      max-width: 220px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .image-section img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      transform: scale(1);
    }
    .image-section img.animate {
      animation: pulse 3s infinite;
    }
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
      }
      50% {
        transform: scale(1.03);
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.4);
      }
    }

    .table-section {
      flex: 2 1 400px;
      min-width: 260px;
    }

    table {
      width: 98%;
      margin-left:20px;
      border-collapse: collapse;
      background: white;
      border-radius: 5px;
      overflow: hidden;
      box-shadow: 0 1px 4px rgba(117, 131, 211, 0.05);
      font-size: 0.8rem;
    }
    thead {
      background-color: #071839;
      color: white;
    }
    th, td {
      padding: 0.4rem 0.5rem;
      text-align: left;
    }
    tbody tr {
      border-bottom: 1px solid #ddd;
    }
    img.update-image {
      max-width: 100px;
      max-height: 80px;
      object-fit: cover;
      border-radius: 3px;
    }

    /* Back button */
    .back-btn {
      display: inline-block;
      padding: 0.3rem 0.6rem;
      background-color: #071839;
      color: white;
      text-decoration: none;
      border-radius: 3px;
      font-weight: 600;
      font-size: 0.75rem;
      transition: background-color 0.3s ease;
      margin-bottom: 0.8rem;
    }
    .back-btn:hover {
      background-color: #0b2a5a;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        gap: 0.8rem;
      }
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead tr {
        display: none;
      }
      tbody tr {
        margin-bottom: 0.8rem;
        border-bottom: 1px solid #28a745;
        padding-bottom: 0.5rem;
      }
      td {
        padding-left: 45%;
        position: relative;
        text-align: left;
        border-bottom: 1px solid #eee;
      }
      td:last-child {
        border-bottom: none;
      }
      td:before {
        position: absolute;
        top: 0.4rem;
        left: 0.4rem;
        width: 40%;
        font-weight: 700;
        color: #28a745;
        content: attr(data-label);
      }
      img.update-image {
        max-width: 100px;
        max-height: 70px;
      }
    }
  </style>
</head>
<body>

  <h1>Upcoming Updates</h1>

  <div style="text-align: right;">
    <a href="{{ url()->previous() }}" class="back-btn">&larr; Back</a>
  </div>

  <div class="container">
    <div class="image-section">
      <img src="{{ asset('images/updates.png') }}" alt="Updates Illustration" class="animate" />
    </div>

    <div class="table-section">
      <table>
        <thead>
          <tr>
            <th>Event</th>
            <th>Date</th>
            <th>Location</th>
            <th>Image</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          @forelse($updates as $update)
            <tr>
              <td data-label="Event">{{ $update->event_name }}</td>
              <td data-label="Date">{{ \Carbon\Carbon::parse($update->date)->format('M j, Y') }}</td>
              <td data-label="Location">{{ $update->location }}</td>
              <td data-label="Image">
                @if($update->image)
                  <img src="{{ asset('storage/' . $update->image) }}" alt="{{ $update->event_name }}" class="update-image" />
                @else
                  —
                @endif
              </td>
              <td data-label="Description">{{ Str::limit($update->description, 50, '...') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 1rem; color: #777;">
                No updates available.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
