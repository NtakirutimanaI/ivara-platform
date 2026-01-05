@extends('layouts.app')

@section('title', 'Order Details - IVARA Marketplace')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #ffb700;
        --bg-light: #f8f9fa;
        --text-gray: #666;
    }

    .order-detail-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .detail-header {
        margin-bottom: 30px;
        border-bottom: 2px solid #eee;
        padding-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-header h1 {
        font-size: 1.8rem;
        color: var(--primary-navy);
        font-weight: 800;
        margin: 0;
    }

    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        padding: 25px;
        border: 1px solid #eee;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .info-item label {
        font-size: 0.8rem;
        color: #777;
        text-transform: uppercase;
        display: block;
        margin-bottom: 5px;
    }

    .info-item span {
        font-weight: 600;
        color: var(--primary-navy);
    }

    .item-list {
        width: 100%;
    }

    .item-row {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #f5f5f5;
        gap: 20px;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .item-img {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 700;
        color: var(--primary-navy);
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        font-size: 1.1rem;
    }

    .grand-total {
        font-weight: 800;
        color: var(--primary-navy);
        font-size: 1.3rem;
        border-top: 2px solid #eee;
        padding-top: 15px;
        margin-top: 15px;
    }
</style>

<div class="order-detail-container">
    <div class="detail-header">
        <div>
            <a href="{{ route('orders.index') }}" style="color: var(--text-gray); font-size: 0.9rem; text-decoration: none;">
                <i class="fas fa-chevron-left"></i> Back to My Orders
            </a>
            <h1>Order #{{ $order['orderNumber'] ?? strtoupper(substr($order['_id'], -8)) }}</h1>
        </div>
        <span class="status-badge status-{{ strtolower($order['status']) }}">
            {{ $order['status'] }}
        </span>
    </div>

    <div class="card">
        <h3 class="card-title"><i class="fas fa-info-circle"></i> Order Information</h3>
        <div class="info-grid">
            <div class="info-item">
                <label>Date Ordered</label>
                <span>{{ \Carbon\Carbon::parse($order['createdAt'])->format('d M Y, H:i') }}</span>
            </div>
            <div class="info-item">
                <label>Payment Method</label>
                <span>{{ strtoupper($order['paymentMethod'] ?? 'N/A') }}</span>
            </div>
            <div class="info-item">
                <label>Payment Status</label>
                <span>{{ ucfirst($order['paymentStatus'] ?? 'Pending') }}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title"><i class="fas fa-shopping-bag"></i> Items Ordered</h3>
        <div class="item-list">
            @foreach($order['items'] as $item)
                @php
                    $product = $item['productId'] ?? [];
                    $image = null;
                    if (isset($product['images']) && count($product['images']) > 0) {
                        $image = $product['images'][0];
                    }
                    if ($image && !str_starts_with($image, 'http')) {
                        $image = rtrim($backendUrl, '/') . '/' . ltrim($image, '/');
                    }
                @endphp
                <div class="item-row">
                    @if($image)
                        <img src="{{ $image }}" class="item-img" onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-icon').style.display='flex';">
                        <div class="item-img fallback-icon" style="display: none; align-items: center; justify-content: center; font-size: 1.5rem; color: #ccc; background: #f8f9fa;">
                            <i class="fas fa-box"></i>
                        </div>
                    @else
                        <div class="item-img" style="display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #ccc; background: #f8f9fa;">
                            <i class="fas fa-box"></i>
                        </div>
                    @endif
                    <div class="item-details">
                        <div class="item-name">{{ $product['name'] ?? $item['productName'] }}</div>
                        <div style="color: #777; font-size: 0.9rem;">Qty: {{ $item['quantity'] }} × {{ number_format($item['price']) }} FRW</div>
                    </div>
                    <div style="font-weight: 700;">
                        {{ number_format($item['subtotal']) }} FRW
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grand-total total-row">
            <span>Total Amount</span>
            <span style="color: var(--accent-gold);">{{ number_format($order['totalAmount']) }} FRW</span>
        </div>
    </div>
</div>
@endsection
