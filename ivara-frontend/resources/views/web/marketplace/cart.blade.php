@extends('layouts.app')

@section('title', 'Shopping Cart - IVARA Marketplace')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #924FC2;
        --bg-light: #f8f9fa;
        --text-gray: #666;
    }

    .cart-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .cart-header {
        margin-bottom: 30px;
        border-bottom: 2px solid #eee;
        padding-bottom: 15px;
    }
    
    .cart-header h1 {
        font-size: 2rem;
        color: var(--primary-navy);
        font-weight: 800;
        margin: 0;
    }

    .cart-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    @media (max-width: 768px) {
        .cart-layout {
            grid-template-columns: 1fr;
        }
    }

    /* Cart Items */
    .cart-items-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .cart-item {
        display: flex;
        padding: 20px;
        border-bottom: 1px solid #eee;
        align-items: center;
        gap: 20px;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 100px;
        height: 100px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .item-placeholder {
        font-size: 2rem;
        color: #ddd;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 5px;
        text-decoration: none;
        display: block;
    }
    
    .item-name:hover {
        color: var(--accent-gold);
    }

    .item-price {
        color: #555;
        font-weight: 600;
    }

    .item-actions {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 10px;
    }

    .qty-control {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .qty-btn {
        background: #f8f9fa;
        border: none;
        width: 30px;
        height: 30px;
        cursor: pointer;
        color: var(--primary-navy);
        font-weight: bold;
    }
    
    .qty-val {
        width: 40px;
        text-align: center;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        background: transparent;
    }

    .btn-remove {
        color: #dc3545;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-remove:hover {
        text-decoration: underline;
    }

    .item-total {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--primary-navy);
        min-width: 100px;
        text-align: right;
    }

    /* Summary */
    .cart-summary {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 25px;
        height: fit-content;
    }

    .summary-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #555;
        font-size: 1rem;
    }
    
    .summary-row.total {
        border-top: 2px solid #eee;
        padding-top: 15px;
        margin-top: 15px;
        font-weight: 800;
        color: var(--primary-navy);
        font-size: 1.3rem;
    }

    .btn-checkout {
        width: 100%;
        background: var(--primary-navy);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        text-decoration: none;
    }

    .btn-checkout:hover {
        background: var(--accent-gold);
        color: var(--primary-navy);
        transform: translateY(-2px);
    }
    
    .empty-cart {
        text-align: center;
        padding: 60px;
        background: white;
        border-radius: 12px;
    }
    
    .empty-cart i {
        font-size: 5rem;
        color: #eee;
        margin-bottom: 20px;
    }
    
    .empty-cart h2 {
        color: var(--primary-navy);
        margin-bottom: 10px;
    }
    
    .btn-continue {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        background: var(--accent-gold);
        color: var(--primary-navy);
        font-weight: 600;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s;
    }
    
    .btn-continue:hover {
        background: #ffc933;
    }

    /* Dark Mode Overrides */
    [data-theme="dark"] .cart-items-wrapper,
    [data-theme="dark"] .cart-summary,
    [data-theme="dark"] .empty-cart,
    [data-theme="dark"] .qty-btn {
        background: #1e293b;
        color: #f8fafc;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    [data-theme="dark"] .cart-header h1 {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .cart-item,
    [data-theme="dark"] .summary-title,
    [data-theme="dark"] .summary-row.total,
    [data-theme="dark"] .cart-header {
        border-color: rgba(255, 255, 255, 0.1);
    }

    [data-theme="dark"] .item-name {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .item-price,
    [data-theme="dark"] .summary-row {
        color: #94a3b8;
    }
    
    [data-theme="dark"] .qty-control {
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    [data-theme="dark"] .qty-val {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .qty-btn {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .item-image {
        background: #0f172a;
    }
    
    [data-theme="dark"] .summary-row.total,
    [data-theme="dark"] .item-total,
    [data-theme="dark"] .summary-title {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .empty-cart i {
        color: #334155;
    }
    
    [data-theme="dark"] .empty-cart h2 {
        color: #f8fafc;
    }
    
    [data-theme="dark"] .empty-cart p {
        color: #94a3b8;
    }
</style>

<div class="cart-container">
    <div class="cart-header">
        <h1>Your Shopping Cart</h1>
    </div>
    
    @if(isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    @if(count($items) > 0)
    <div class="cart-layout">
        <div class="cart-items-wrapper">
            @foreach($items as $item)
            @php
                // Backend populates 'productId' with the Product object
                $product = $item['productId'] ?? [];
                
                // If productId wasn't populated for some reason, it might be a string ID
                $pId = is_array($product) ? ($product['_id'] ?? '') : $product;
                
                // Use redundant fields from item as fallback for resilience
                $name = is_array($product) ? ($product['name'] ?? ($item['productName'] ?? 'Unknown Product')) : ($item['productName'] ?? 'Unknown Product');
                $price = $item['price'] ?? 0;
                $quantity = $item['quantity'] ?? 1;
                $subtotal = $item['subtotal'] ?? ($price * $quantity);
                
                // Handle image
                $image = null;
                if (is_array($product) && isset($product['images']) && count($product['images']) > 0) {
                    $image = $product['images'][0];
                } else {
                    $image = $item['productImage'] ?? null;
                }
                
                // Construct full URL if path is relative
                if ($image && !str_starts_with($image, 'http')) {
                    $image = rtrim($backendUrl, '/') . '/' . ltrim($image, '/');
                }
                
                // Ensure pId is a string for the data-id attribute
                if (is_array($pId)) {
                    $pId = $pId['$oid'] ?? '';
                }
                // Extract Cart Item ID for updates/removals
                $itemId = $item['_id'] ?? '';
                if (is_array($itemId)) {
                    $itemId = $itemId['$oid'] ?? '';
                }
            @endphp
            <div class="cart-item" data-id="{{ $pId }}" data-item-id="{{ $itemId }}">
                <div class="item-image">
                    @if($image)
                        <img src="{{ $image }}" alt="{{ $name }}" onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-icon').style.display='block';">
                        <i class="fas fa-box item-placeholder fallback-icon" style="display: none; font-size: 2rem; color: #ddd;"></i>
                    @else
                        <i class="fas fa-box item-placeholder"></i>
                    @endif
                </div>
                
                <div class="item-details">
                    <a href="{{ route('product.show', $pId) }}" class="item-name">{{ $name }}</a>
                    <div class="item-price">{{ number_format($price) }} FRW</div>
                    
                    <div class="item-actions">
                        <div class="qty-control">
                            <button class="qty-btn" onclick="updateCartItem('{{ $itemId }}', {{ $quantity - 1 }})">-</button>
                            <input type="text" class="qty-val" value="{{ $quantity }}" readonly>
                            <button class="qty-btn" onclick="updateCartItem('{{ $itemId }}', {{ $quantity + 1 }})">+</button>
                        </div>
                        
                        <button class="btn-remove" onclick="removeCartItem('{{ $itemId }}')">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
                
                <div class="item-total">
                    {{ number_format($subtotal) }} FRW
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="cart-summary">
            <div class="summary-title">Order Summary</div>
            
            <div class="summary-row">
                <span>Subtotal</span>
                <span>{{ number_format($total) }} FRW</span>
            </div>
            <div class="summary-row">
                <span>Shipping</span>
                <span>Calculated at checkout</span>
            </div>
            
            <div class="summary-row total">
                <span>Total</span>
                <span style="color: var(--accent-gold);">{{ number_format($total) }} FRW</span>
            </div>
            
            <a href="{{ route('cart.checkout') }}" class="btn-checkout">
                Proceed to Checkout <i class="fas fa-arrow-right"></i>
            </a>
            
            <div style="margin-top: 15px; text-align: center; font-size: 0.9rem; color: #777;">
                <i class="fas fa-lock"></i> Secure Checkout
            </div>
        </div>
    </div>
    @else
    <div class="empty-cart">
        <i class="fas fa-shopping-cart"></i>
        <h2>Your cart is empty</h2>
        <p>Looks like you haven't added anything to your cart yet.</p>
        <a href="{{ route('marketplace.index') }}" class="btn-continue">
            Start Shopping
        </a>
    </div>
    @endif
</div>

<script>
    function updateCartItem(itemId, newQty) {
        if (newQty < 1) return;

        fetch('{{ rtrim($backendUrl, "/") }}/api/cart/update', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                userId: '{{ auth()->id() ?? "" }}',
                itemId: itemId,
                quantity: newQty
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload(); 
            } else {
                alert('Failed to update cart');
            }
        });
    }
    
    function removeCartItem(itemId) {
        if(!confirm('Are you sure you want to remove this item?')) return;
        
        const userId = '{{ auth()->id() ?? "" }}';
        
        fetch(`{{ rtrim($backendUrl, "/") }}/api/cart/remove/${userId}/${itemId}`, {
            method: 'DELETE'
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to remove item');
            }
        });
    }
</script>
@endsection
