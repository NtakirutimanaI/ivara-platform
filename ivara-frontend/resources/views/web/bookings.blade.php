@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Form</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --primary-navy: #0A1128;
    --secondary-navy: #162447;
    --accent-gold: #924FC2;
    --white: #ffffff;
    --bg-light: #f8f9fa;
  }
  
  body { 
    font-family: 'Poppins', sans-serif; 
    background: linear-gradient(135deg, var(--bg-light) 0%, #e4e9f2 100%);
    color: var(--primary-navy); 
    margin-top: 20px;
    min-height: 100vh;
  }
  
  .service-card { 
    background: var(--white);
    color: var(--primary-navy);
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(10, 17, 40, 0.1);
    width: 280px;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(10, 17, 40, 0.08);
  }
  
  .service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(10, 17, 40, 0.15);
  }
  
  .service-card h3 { 
    color: var(--accent-gold);
    margin-bottom: 12px;
    font-weight: 700;
    font-size: 1.3rem;
  }
  
  .service-card p {
    color: #666;
    margin-bottom: 10px;
    line-height: 1.6;
  }
  
  .service-card p strong {
    color: var(--primary-navy);
  }
  
  .book-btn { 
    background: var(--accent-gold);
    border: 2px solid var(--accent-gold);
    padding: 12px 24px;
    cursor: pointer;
    border-radius: 50px;
    font-weight: 700;
    color: var(--primary-navy);
    transition: all 0.3s ease;
    font-size: 0.95rem;
    width: 100%;
    margin-top: 10px;
  }
  
  .book-btn:hover {
    background: rgba(10, 17, 40, 0.9);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(10, 17, 40, 0.3);
  }
  
  .message { 
    margin-top: 12px;
    font-weight: 600;
    color: var(--accent-gold);
    font-size: 0.9rem;
  }
  
  h2 {
    background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  
  .bookings-link {
    display: inline-block;
    background: var(--primary-navy);
    color: var(--white);
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 10px;
  }
  
  .bookings-link:hover {
    background: var(--accent-gold);
    color: rgba(10, 17, 40, 0.95);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 183, 0, 0.4);
  }
</style>
</head>
<body>

<h2 style="text-align:center;margin-bottom:30px;font-size:2.5rem;">Available Services</h2>

<div style="display:flex;flex-wrap:wrap;gap:25px;justify-content:center;padding:20px 0;">
@foreach($services as $service)
  <div class="service-card" id="service-{{ $service->id }}">
    <h3>{{ $service->name }}</h3>
    <p>{{ $service->description }}</p>
    <p><strong>Price:</strong> {{ number_format($service->price) }} FRW</p>
    <button class="book-btn" onclick="addToSession({{ $service->id }})">Book Now</button>
    <div class="message" id="msg-{{ $service->id }}"></div>
  </div>
@endforeach
</div>

<div style="text-align:center;margin-top:30px;margin-bottom:30px;">
  <a href="{{ route('bookings.confirm') }}" class="bookings-link">Go to My Bookings</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function addToSession(serviceId) {
    $.ajax({
        url: '/bookings/add-session/' + serviceId,
        type: 'POST',
        data: { _token: '{{ csrf_token() }}' },
        success: function(response) {
            $('#msg-' + serviceId).text(response.message);
        },
        error: function(xhr) {
            let msg = 'Error adding service';
            if(xhr.responseJSON && xhr.responseJSON.message){
                msg = xhr.responseJSON.message;
            }
            $('#msg-' + serviceId).text(msg);
        }
    });
}
</script>

</body>
</html>
