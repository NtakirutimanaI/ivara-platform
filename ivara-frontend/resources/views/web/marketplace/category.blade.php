@extends('layouts.app')

@section('title', ucfirst($category) . ' Marketplace - IVARA')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #ffb700;
        --bg-light: #f8f9fa;
    }

    .marketplace-container {
        max-width: 1400px;
        margin: 10px auto 60px;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .marketplace-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .marketplace-header h1 {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }

    .marketplace-header p {
        font-size: 1.1rem;
        color: #666;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 30px;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(10, 17, 40, 0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(10, 17, 40, 0.05);
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(10, 17, 40, 0.12);
    }

    .product-image {
        width: 100%;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .product-like-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .product-like-btn:hover {
        transform: scale(1.1);
        background: white;
    }

    .product-like-btn i {
        color: #ccc;
        font-size: 1.1rem;
        transition: all 0.3s;
    }

    .product-like-btn.liked i {
        color: #e74c3c;
    }

    .product-like-btn:hover i {
        color: #e74c3c;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        color: var(--accent-gold);
        font-size: 2.5rem;
    }

    .product-info {
        padding: 15px;
    }

    .product-category {
        display: inline-block;
        background: var(--accent-gold);
        color: var(--primary-navy);
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .product-name {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--primary-navy);
        margin-bottom: 8px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-description {
        color: #666;
        font-size: 0.8rem;
        line-height: 1.4;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--accent-gold);
        margin-bottom: 8px;
    }

    .product-price .currency {
        font-size: 0.75rem;
        color: var(--primary-navy);
        font-weight: 600;
    }

    .stock-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.75rem;
        margin-bottom: 10px;
    }

    .stock-status.in-stock {
        color: #28a745;
    }

    .stock-status.low-stock {
        color: #ffc107;
    }

    .stock-status.out-of-stock {
        color: #dc3545;
    }

    .stock-status i {
        font-size: 0.6rem;
    }

    .product-actions {
        display: flex;
        gap: 8px;
    }

    .btn-view {
        flex: 1;
        background: var(--primary-navy);
        color: white;
        border: none;
        padding: 10px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
        display: inline-block;
    }

    .btn-view:hover {
        background: var(--secondary-navy);
        color: white;
        transform: translateY(-2px);
    }

    .btn-cart {
        flex: 1;
        background: var(--accent-gold);
        color: var(--primary-navy);
        border: none;
        padding: 10px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-cart:hover {
        background: #ffc933;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 183, 0, 0.4);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 5rem;
        color: var(--accent-gold);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--primary-navy);
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .marketplace-header h1 {
            font-size: 2rem;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="marketplace-container">
    <div class="marketplace-header">
        <h1>{{ ucfirst($category) }} Marketplace</h1>
        <p>Discover amazing products and services in {{ ucfirst($category) }}</p>
    </div>

    @if(isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    @if(count($products) > 0)
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        <button class="product-like-btn" onclick="toggleLike('{{ $product['_id'] ?? $product['id'] ?? '' }}', this)" title="Like this product">
                            <i class="far fa-heart"></i>
                        </button>
                        
                        @php
                            $image = null;
                            if(!empty($product['images']) && isset($product['images'][0])) {
                                $image = $product['images'][0];
                                // Construct full URL if path is relative
                                if ($image && !str_starts_with($image, 'http')) {
                                    $image = rtrim($backendUrl, '/') . '/' . ltrim($image, '/');
                                }
                            }
                        @endphp
                        
                        @if($image)
                            <img src="{{ $image }}" alt="{{ $product['name'] ?? 'Product' }}" 
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.product-image-placeholder').style.display='flex';">
                            <div class="product-image-placeholder" style="display: none; position: absolute; top: 0; left: 0;">
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
                                    $icon = $icons[$product['category'] ?? 'other'] ?? 'fa-box';
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                        @else
                            <div class="product-image-placeholder">
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
                                    $icon = $icons[$product['category'] ?? 'other'] ?? 'fa-box';
                                @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="product-info">
                        <span class="product-category">{{ ucfirst($product['category'] ?? 'Other') }}</span>
                        <h3 class="product-name">{{ $product['name'] ?? 'Unnamed Product' }}</h3>
                        <p class="product-description">{{ $product['description'] ?? 'No description available' }}</p>
                        
                        <div class="product-price">
                            {{ number_format($product['price'] ?? 0) }} 
                            <span class="currency">FRW</span>
                        </div>
                        
                        <div class="stock-status {{ strtolower(str_replace(' ', '-', $product['stockStatus'] ?? 'in-stock')) }}">
                            <i class="fas fa-circle"></i>
                            {{ $product['stockStatus'] ?? 'In Stock' }} ({{ $product['stockQuantity'] ?? 0 }} available)
                        </div>
                        
                        <div class="product-actions">
                            @php
                                // Try to get ID from various possible fields
                                $productId = $product['_id'] ?? $product['id'] ?? $product['productId'] ?? null;
                                
                                // Convert MongoDB ObjectId to string if it's an object
                                if (is_object($productId) && method_exists($productId, '__toString')) {
                                    $productId = (string) $productId;
                                }
                                
                                // Fallback to loop index if no ID found
                                if (!$productId) {
                                    $productId = $loop->index;
                                }
                            @endphp
                            
                            <a href="{{ route('product.show', $productId) }}" class="btn-view">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            <button class="btn-cart" onclick="addToCart('{{ $productId }}')">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(isset($pagination))
            <div style="margin-top: 40px; text-align: center;">
                <p>Showing page {{ $pagination['page'] }} of {{ $pagination['pages'] }} ({{ $pagination['total'] }} total products)</p>
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>No Products Yet</h3>
            <p>We're working on adding amazing products to this category. Check back soon!</p>
        </div>
    @endif
</div>

<script>
// Toggle like functionality
function toggleLike(productId, button) {
    @guest
        alert('Please login to like products');
        window.location.href = '{{ route("login") }}';
        return;
    @endguest

    const icon = button.querySelector('i');
    const isLiked = button.classList.contains('liked');
    
    if (isLiked) {
        // Unlike
        button.classList.remove('liked');
        icon.classList.remove('fas');
        icon.classList.add('far');
        
        // Call API to remove like
        fetch('{{ rtrim($backendUrl, "/") }}/api/products/unlike', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                userId: '{{ auth()->id() ?? "" }}',
                productId: productId
            })
        });
    } else {
        // Like
        button.classList.add('liked');
        icon.classList.remove('far');
        icon.classList.add('fas');
        
        // Animate
        button.style.transform = 'scale(1.3)';
        setTimeout(() => {
            button.style.transform = 'scale(1)';
        }, 200);
        
        // Call API to save like
        fetch('{{ rtrim($backendUrl, "/") }}/api/products/like', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                userId: '{{ auth()->id() ?? "" }}',
                productId: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Product liked successfully');
            }
        });
    }
}

function addToCart(productId) {
    // Check if user is logged in
    @guest
        alert('Please login to add items to cart');
        window.location.href = '{{ route("login") }}';
        return;
    @endguest

    // Add to cart via API
    fetch('{{ rtrim($backendUrl, "/") }}/api/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            userId: '{{ auth()->id() ?? "" }}',
            productId: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Product added to cart successfully!');
            
            // Update cart badge
            const badge = document.getElementById('authCartCount');
            if(badge) {
                const currentCount = parseInt(badge.textContent) || 0;
                badge.textContent = currentCount + 1;
                badge.style.display = 'flex';
                badge.style.alignItems = 'center';
                badge.style.justifyContent = 'center';
            }
        } else {
            alert(data.message || 'Failed to add to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to add to cart');
    });
}
</script>

@include('layouts.footer')
@endsection
