@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')

<style>
/* Existing CSS, updated for uniform card sizes */
.updates-report-body {
    font-family: 'DejaVu Sans', sans-serif;
    font-size: 14px;
    margin-top: 100px;
    margin-left: 240px;
    width: 80%;
    padding: 20px;
    background-color: #f8fafc;
    color: #333;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.updates-report-header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #4f46e5;
    padding-bottom: 10px;
    margin-bottom: 20px;
}
.updates-report-title {
    font-size: 28px;
    font-weight: bold;
    color: #4f46e5;
}
.checkout-link {
    background-color: #10b981;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
.checkout-link:hover { background-color: #059669; }
.success-message {
    margin-bottom: 1rem;
    padding: 0.75rem 1rem;
    background-color: #bbf7d0;
    color: #166534;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.updates-list {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
}
.updates-list > div {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    padding: 15px;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    width: 300px;
    min-height: 380px;
}
.updates-list > div:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
@media(max-width: 1024px) { .updates-list > div { width: 45%; } }
@media(max-width: 768px) { .updates-list > div { width: 100%; } }

.update-details { flex: 1 1 auto; width: 100%; text-align: center; }
.update-details h3 { font-size: 1.2rem; font-weight: 600; margin: 0 0 0.25rem 0; color: #0a1128; }
.update-details p.date-location { font-size: 0.9rem; color: #6b7280; font-weight: bold; margin: 0 0 0.5rem 0; }
.update-details p.description { margin: 0 0 8px 0; line-height: 1.3; font-size: 0.85rem; }

form.updates-form { display: flex; flex-direction: column; gap: 8px; max-width: 140px; margin: 0 auto; }
form.updates-form label { font-weight: 600; font-size: 0.85rem; }
form.updates-form input[type="number"] { width: 100%; padding: 0.4rem 0.6rem; font-size: 0.85rem; border: 1px solid #ccc; border-radius: 6px; outline: none; transition: border-color 0.3s ease; }
form.updates-form input[type="number"]:focus { border-color: #4f46e5; }
form.updates-form button { background-color: #4f46e5; color: #fff; border: none; border-radius: 6px; padding: 0.4rem 1rem; font-size: 0.85rem; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease; }
form.updates-form button:hover { background-color: #0A1128; transform: scale(1.03); }

.update-image { margin-top: 8px; max-width: 120px; max-height: 120px; border-radius: 10px; object-fit: cover; align-self: center; }

@media (max-width: 767px) { .updates-report-body { margin-left: 10px; width: 95%; margin-top: 100px; } }

/* Divider */
.divider {
    width: 100%;
    text-align: center;
    border-top: 2px dashed #ccc;
    margin: 40px 0 20px 0;
    position: relative;
}
.divider span {
    background: #f8fafc;
    position: relative;
    top: -14px;
    padding: 0 15px;
    font-weight: bold;
    font-size: 20px;
    color: #4f46e5;
}
</style>

<div class="updates-report-body">

    <!-- Company Products & Services -->
    <div class="updates-report-header">
        <div class="updates-report-title">Company Products & Services</div>
        <a href="{{ route('client.checkout') }}" class="checkout-link">
            Go to Checkout ({{ session('cart') ? count(session('cart')) : 0 }})
        </a>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <!-- Main Company Products -->
    <div class="updates-list">
        @foreach($products as $product)
        <div>
            <div class="update-details">
                <h3>{{ $product->name }}</h3>
                <p class="description">{{ $product->description }}</p>
                <p class="date-location">Price: {{ number_format($product->price,2) }} FRW</p>
                <form action="{{ route('client.add_to_cart', $product->id) }}" method="POST" class="updates-form">
                    @csrf
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1" value="1">
                    <button type="submit">Buy Now</button>
                </form>
            </div>
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="update-image" alt="{{ $product->name }}">
            @endif
        </div>
        @endforeach
    </div>

    <!-- Divider -->
    <div class="divider"><span>Clients Products</span></div>

    <!-- Client Products -->
    <div class="updates-list">
        @foreach($clientProducts as $product)
        <div>
            <div class="update-details">
                <h3>{{ $product->title }}</h3>
                <p class="description">{{ $product->description }}</p>
                <p class="date-location">Price: {{ number_format($product->price,2) }} FRW</p>
                <form action="{{ route('client.add_client_to_cart', $product->id) }}" method="POST" class="updates-form">
                    @csrf
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1" value="1">
                    <button type="submit">Buy Now</button>
                </form>
            </div>
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="update-image" alt="{{ $product->title }}">
            @endif
        </div>
        @endforeach
    </div>

    <!-- Divider -->
    <div class="divider"><span>Technician Products & Services</span></div>

    <!-- Technician Products -->
    <div class="updates-list">
        @foreach($technicianProducts as $product)
        <div>
            <div class="update-details">
                <h3>{{ $product->name }}</h3>
                <p class="description">{{ $product->description }}</p>
                <p class="date-location">Price: {{ number_format($product->price,2) }} FRW</p>
                <form action="{{ route('client.add_technician_to_cart', $product->id) }}" method="POST" class="updates-form">
                    @csrf
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1" value="1">
                    <button type="submit">Buy Now</button>
                </form>
            </div>
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="update-image" alt="{{ $product->name }}">
            @endif
        </div>
        @endforeach
    </div>

    <!-- Divider -->
    <div class="divider"><span>Mechanician Products & Services</span></div>

    <!-- Mechanician Products -->
    <div class="updates-list">
        @foreach($mechanicianProducts as $product)
        <div>
            <div class="update-details">
                <h3>{{ $product->name }}</h3>
                <p class="description">{{ $product->description }}</p>
                <p class="date-location">Price: {{ number_format($product->price,2) }} FRW</p>
                <form action="{{ route('client.add_client_to_cart', $product->id) }}" method="POST" class="updates-form">
                    @csrf
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1" value="1">
                    <button type="submit">Buy Now</button>
                </form>
            </div>
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="update-image" alt="{{ $product->name }}">
            @endif
        </div>
        @endforeach
    </div>

    <!-- Divider -->
    <div class="divider"><span>Crafts Section</span></div>

    <!-- Craftsperson Products -->
    <div class="updates-list">
        @foreach($craftspersonProducts as $product)
            @if($product->status == 'Available')
            <div>
                <div class="update-details">
                    <h3>{{ $product->name }}</h3>
                    <p class="description">{{ $product->category ?? 'No category' }}</p>
                    <p class="date-location">Price: {{ number_format($product->price,2) }} FRW</p>
                    <form action="{{ route('client.add_client_to_cart', $product->id) }}" method="POST" class="updates-form">
                        @csrf
                        <label>Quantity</label>
                        <input type="number" name="quantity" min="1" max="{{ $product->quantity }}" value="1">
                        <button type="submit">Buy Now</button>
                    </form>
                </div>
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="update-image" alt="{{ $product->name }}">
                @endif
            </div>
            @endif
        @endforeach
    </div>

    <!-- Divider -->
    <div class="divider"><span>Business Person Products</span></div>

    <!-- Business Person Products -->
    <div class="updates-list">
        @foreach($businessPersonProducts as $product)
            @if($product->status == 'Available')
            <div>
                <div class="update-details">
                    <h3>{{ $product->name }}</h3>
                    <p class="description">{{ $product->category ?? 'No category' }}</p>
                    <p class="date-location">Price: {{ number_format($product->price,2) }} FRW ({{ $product->unit }})</p>
                    <form action="{{ route('client.add_client_to_cart', $product->id) }}" method="POST" class="updates-form">
                        @csrf
                        <label>Quantity</label>
                        <input type="number" name="quantity" min="1" max="{{ $product->quantity }}" value="1">
                        <button type="submit">Buy Now</button>
                    </form>
                </div>
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="update-image" alt="{{ $product->name }}">
                @endif
            </div>
            @endif
        @endforeach
    </div>

</div>

@include('layouts.footer')
