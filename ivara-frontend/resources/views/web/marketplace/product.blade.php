@extends('layouts.app')

@section('title', $product['name'] . ' - IVARA Marketplace')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #ffb700;
        --bg-light: #f8f9fa;
        --text-gray: #666;
    }

    .product-page-container {
        max-width: 1400px;
        margin: 20px auto 80px;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .breadcrumbs {
        margin-bottom: 20px;
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .breadcrumbs a {
        color: var(--primary-navy);
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumbs a:hover {
        color: var(--accent-gold);
    }

    .product-detail-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    @media (max-width: 900px) {
        .product-detail-wrapper {
            grid-template-columns: 1fr;
        }
    }

    /* Left Column: Images */
    .product-gallery {
        position: relative;
    }

    .main-image-container {
        width: 100%;
        height: 400px;
        background: #f0f0f0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .main-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        color: var(--accent-gold);
        font-size: 4rem;
    }

    .main-image-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .thumbnails {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        border-radius: 6px;
        border: 2px solid transparent;
        cursor: pointer;
        object-fit: cover;
        opacity: 0.7;
        transition: 0.3s;
    }

    .thumbnail.active {
        border-color: var(--accent-gold);
        opacity: 1;
    }

    .thumbnail:hover {
        opacity: 1;
    }

    /* Right Column: Info */
    .product-details {
        display: flex;
        flex-direction: column;
    }

    .product-cat-badge {
        display: inline-block;
        background: var(--accent-gold);
        color: var(--primary-navy);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        align-self: flex-start;
        margin-bottom: 15px;
    }

    .product-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .rating {
        color: #ffc107;
        font-size: 0.9rem;
    }
    
    .rating-count {
        color: var(--text-gray);
        font-size: 0.85rem;
    }

    .product-price-section {
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #eee;
    }

    .final-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-navy);
    }

    .currency {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-gray);
    }
    
    .stock-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .in-stock { background: #d4edda; color: #155724; }
    .low-stock { background: #fff3cd; color: #856404; }
    .out-of-stock { background: #f8d7da; color: #721c24; }

    .product-description {
        color: var(--text-gray);
        line-height: 1.7;
        margin-bottom: 30px;
        font-size: 1rem;
    }

    .product-actions-area {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    
    .qty-selector {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .qty-btn {
        background: #f8f9fa;
        border: none;
        width: 40px;
        height: 45px;
        font-size: 1.2rem;
        cursor: pointer;
        color: var(--primary-navy);
        transition: 0.2s;
    }
    
    .qty-btn:hover { background: #e2e6ea; }
    
    .qty-input {
        width: 50px;
        height: 45px;
        border: none;
        text-align: center;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--primary-navy);
    }

    .btn-add-cart {
        flex: 2;
        background: var(--accent-gold);
        color: var(--primary-navy);
        border: none;
        border-radius: 8px;
        padding: 0 30px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 180px;
    }

    .btn-add-cart:hover {
        background: #ffc933;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 183, 0, 0.4);
    }

    .btn-like {
        width: 45px;
        height: 45px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        color: #ccc;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-like:hover {
        border-color: var(--primary-navy);
        color: var(--primary-navy);
    }
    
    .btn-like.liked {
        color: #e74c3c;
        border-color: #e74c3c;
    }
    
    .seller-info-card {
        margin-top: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #eee;
    }
    
    .seller-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .seller-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--secondary-navy);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }
    
    .seller-details h4 {
        margin: 0;
        font-size: 1.1rem;
        color: var(--primary-navy);
    }
    
    .seller-verified {
        color: #28a745;
        font-size: 0.8rem;
        margin-top: 2px;
    }
    
    .btn-contact {
        width: 100%;
        padding: 10px;
        background: white;
        border: 1px solid var(--primary-navy);
        color: var(--primary-navy);
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }
    
    .btn-contact:hover {
        background: var(--primary-navy);
        color: white;
    }

    /* Specs & Tabs */
    .product-tabs {
        margin-top: 50px;
    }

    .tab-headers {
        display: flex;
        gap: 30px;
        border-bottom: 2px solid #eee;
        margin-bottom: 30px;
    }

    .tab-btn {
        padding-bottom: 15px;
        border: none;
        background: none;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-gray);
        cursor: pointer;
        position: relative;
    }

    .tab-btn.active {
        color: var(--primary-navy);
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--accent-gold);
    }
    
    .tab-content {
        display: none;
        line-height: 1.7;
        color: #555;
    }
    
    .tab-content.active {
        display: block;
    }
    
    .spec-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .spec-table tr {
        border-bottom: 1px solid #eee;
    }
    
    .spec-table td {
        padding: 12px 0;
    }
    
    .spec-label {
        font-weight: 600;
        color: var(--primary-navy);
        width: 30%;
    }

</style>

<div class="product-page-container">
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">Home</a> > 
        <a href="{{ route('marketplace.index') }}">Marketplace</a> > 
        <a href="{{ route('market.category', $product['category']) }}">{{ ucfirst($product['category']) }}</a> > 
        <span>{{ \Illuminate\Support\Str::limit($product['name'], 30) }}</span>
    </div>

    <div class="product-detail-wrapper">
        <!-- Left: Gallery -->
        <div class="product-gallery">
            <div class="main-image-container">
                @php
                    $mainImage = null;
                    if(!empty($product['images']) && isset($product['images'][0])) {
                        $mainImage = $product['images'][0];
                        // Construct full URL if path is relative
                        if ($mainImage && !str_starts_with($mainImage, 'http')) {
                            $mainImage = rtrim($backendUrl, '/') . '/' . ltrim($mainImage, '/');
                        }
                    }
                @endphp
                
                @if($mainImage)
                    <img id="mainImage" src="{{ $mainImage }}" alt="{{ $product['name'] }}"
                         onerror="this.style.display='none'; this.parentElement.querySelector('.main-image-placeholder').style.display='flex';">
                    <div class="main-image-placeholder" style="display: none;">
                        @php
                            $icons = [
                                'technical' => 'fa-tools',
                                'creative' => 'fa-palette',
                                'transport' => 'fa-truck',
                                'food-fashion' => 'fa-shopping-bag',
                                'education' => 'fa-graduation-cap',
                                'agriculture' => 'fa-seedling',
                                'media' => 'fa-video',
                                'legal' => 'fa-balance-scale',
                                'other' => 'fa-concierge-bell'
                            ];
                            $icon = $icons[$product['category']] ?? 'fa-box';
                        @endphp
                        <i class="fas {{ $icon }}"></i>
                    </div>
                @else
                    <div class="main-image-placeholder">
                        @php
                            $icons = [
                                'technical' => 'fa-tools',
                                'creative' => 'fa-palette',
                                'transport' => 'fa-truck',
                                'food-fashion' => 'fa-shopping-bag',
                                'education' => 'fa-graduation-cap',
                                'agriculture' => 'fa-seedling',
                                'media' => 'fa-video',
                                'legal' => 'fa-balance-scale',
                                'other' => 'fa-concierge-bell'
                            ];
                            $icon = $icons[$product['category']] ?? 'fa-box';
                        @endphp
                        <i class="fas {{ $icon }}"></i>
                    </div>
                @endif
            </div>

            @if(!empty($product['images']) && count($product['images']) > 1)
                <div class="thumbnails">
                    @foreach($product['images'] as $key => $image)
                        @php
                            $thumbImage = $image;
                            if ($thumbImage && !str_starts_with($thumbImage, 'http')) {
                                $thumbImage = rtrim($backendUrl, '/') . '/' . ltrim($thumbImage, '/');
                            }
                        @endphp
                        <img src="{{ $thumbImage }}" class="thumbnail {{ $key === 0 ? 'active' : '' }}" 
                             onclick="changeImage(this, '{{ $thumbImage }}')" alt="Thumbnail {{ $key + 1 }}">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Right: Details -->
        <div class="product-details">
            <span class="product-cat-badge">{{ ucfirst($product['category']) }}</span>
            <h1 class="product-title">{{ $product['name'] }}</h1>
            
            <div class="product-meta">
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <span class="rating-count">(No reviews yet)</span>
            </div>

            <div class="product-price-section">
                <div class="final-price">{{ number_format($product['price']) }} <span class="currency">FRW</span></div>
            </div>
            
            <div style="margin-bottom: 20px;">
                @php
                    $statusClass = match(strtolower($product['stockStatus'] ?? '')) {
                        'in stock' => 'in-stock',
                        'low stock' => 'low-stock',
                        'out of stock' => 'out-of-stock',
                        default => 'in-stock'
                    };
                    $quantity = $product['stockQuantity'] ?? 0;
                @endphp
                <span class="stock-tag {{ $statusClass }}">
                    <i class="fas fa-box"></i> {{ $product['stockStatus'] ?? 'In Stock' }} 
                    @if($quantity > 0) ({{ $quantity }} available) @endif
                </span>
            </div>

            <p class="product-description">{{ $product['description'] }}</p>

            <div class="product-actions-area">
                <div class="qty-selector">
                    <button class="qty-btn" onclick="updateQty(-1)">-</button>
                    <input type="text" id="qtyInput" class="qty-input" value="1" readonly>
                    <button class="qty-btn" onclick="updateQty(1)">+</button>
                </div>
                
                <button class="btn-add-cart" onclick="addToCart('{{ $product['_id'] }}')">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                
                <button class="btn-like" onclick="toggleLike('{{ $product['_id'] }}', this)" title="Add to Wishlist">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            
            @if(isset($product['seller']))
            <div class="seller-info-card">
                <div class="seller-header">
                    <div class="seller-avatar">S</div>
                    <div class="seller-details">
                        <h4>Seller #{{ \Illuminate\Support\Str::limit(is_array($product['seller']) ? ($product['seller']['name'] ?? 'Unknown') : $product['seller'], 15) }}</h4>
                        <div class="seller-verified"><i class="fas fa-check-circle"></i> Verified Seller</div>
                    </div>
                </div>
                <button class="btn-contact"><i class="far fa-envelope"></i> Contact Seller</button>
            </div>
            @endif
        </div>
    </div>

    <!-- Tabs -->
    <div class="product-tabs">
        <div class="tab-headers">
            <button class="tab-btn active" onclick="switchTab('desc')">Description</button>
            <button class="tab-btn" onclick="switchTab('specs')">Specifications</button>
            <button class="tab-btn" onclick="switchTab('reviews')">Reviews</button>
        </div>

        <div id="desc-tab" class="tab-content active">
            <p>{{ $product['description'] }}</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>

        <div id="specs-tab" class="tab-content">
            <table class="spec-table">
                @if(isset($product['variants']) && count($product['variants']) > 0)
                    @foreach($product['variants'] as $variant)
                        <tr>
                            <td class="spec-label">{{ $variant['name'] ?? 'Variant' }}</td>
                            <td>{{ json_encode($variant['options'] ?? '') }}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td class="spec-label">Category</td>
                    <td>{{ ucfirst($product['category']) }}</td>
                </tr>
                <tr>
                    <td class="spec-label">SKU</td>
                    <td>IVR-{{ substr($product['_id'], -8) }}</td>
                </tr>
            </table>
        </div>

        <div id="reviews-tab" class="tab-content">
            <div style="text-align: center; padding: 40px; color: #777;">
                <i class="fas fa-star" style="font-size: 2rem; color: #eee; margin-bottom: 15px;"></i>
                <p>No reviews yet. Be the first to review this product!</p>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(thumb, src) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }
    
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        
        document.getElementById(tabName + '-tab').classList.add('active');
        event.target.classList.add('active');
    }
    
    function updateQty(change) {
        const input = document.getElementById('qtyInput');
        let val = parseInt(input.value) + change;
        if (val < 1) val = 1;
        // Check max stock if available
        const max = {{ $product['stockQuantity'] ?? 99 }};
        if (val > max) val = max;
        
        input.value = val;
    }
    
    function addToCart(productId) {
        @guest
            alert('Please login to add items to cart');
            window.location.href = '{{ route("login") }}';
            return;
        @endguest
        
        const qty = document.getElementById('qtyInput').value;
        const btn = document.querySelector('.btn-add-cart');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
        btn.disabled = true;

        fetch('{{ rtrim($backendUrl, "/") }}/api/cart/add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                userId: '{{ auth()->id() ?? "" }}',
                productId: productId,
                quantity: parseInt(qty)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success feedback
                btn.style.background = '#28a745';
                btn.style.color = 'white';
                btn.innerHTML = '<i class="fas fa-check"></i> Added!';
                
                setTimeout(() => {
                    btn.style.background = ''; // reset
                    btn.style.color = '';
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    
                    // Update cart count if badge exists
                    const badge = document.getElementById('authCartCount');
                    if(badge) {
                        const currentCount = parseInt(badge.textContent) || 0;
                        badge.textContent = currentCount + 1;
                        badge.style.display = 'block';
                    }
                }, 1000);
            } else {
                alert(data.message || 'Failed to add to cart');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to add to cart');
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }
    
    function toggleLike(productId, button) {
        @guest
            alert('Please login to like products');
            window.location.href = '{{ route("login") }}';
            return;
        @endguest

        const icon = button.querySelector('i');
        const isLiked = button.classList.contains('liked');
        
        if (isLiked) {
            button.classList.remove('liked');
            icon.classList.remove('fas');
            icon.classList.add('far');
            
            fetch('{{ rtrim($backendUrl, "/") }}/api/products/unlike', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: '{{ auth()->id() ?? "" }}', productId: productId })
            });
        } else {
            button.classList.add('liked');
            icon.classList.remove('far');
            icon.classList.add('fas');
            
            // Animate
            button.style.transform = 'scale(1.1)';
            setTimeout(() => button.style.transform = 'scale(1)', 200);
            
            fetch('{{ rtrim($backendUrl, "/") }}/api/products/like', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: '{{ auth()->id() ?? "" }}', productId: productId })
            });
        }
    }
</script>
@endsection
