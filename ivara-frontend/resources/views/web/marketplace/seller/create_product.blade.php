@extends('layouts.app')

@section('title', 'Add New Product - Seller Dashboard')

@section('content')
<style>
    .seller-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 30px;
        align-items: start;
    }
    
    @media (max-width: 992px) {
        .seller-container {
            grid-template-columns: 1fr;
        }
    }
    
    .header-area {
        grid-column: 1 / -1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .form-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--primary-navy, #0A1128);
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: 0.3s;
    }
    
    .form-control:focus {
        border-color: var(--accent-gold, #ffb700);
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 183, 0, 0.1);
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .btn-submit {
        background: var(--primary-navy, #0A1128);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
    }
    
    .btn-submit:hover {
        background: var(--secondary-navy, #162447);
        transform: translateY(-2px);
    }
    
    .preview-container {
        margin-top: 15px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .preview-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    small.text-muted {
        display: block;
        margin-top: 5px;
        color: #777;
        font-size: 0.85rem;
    }
</style>

<div class="seller-container">
    <div class="header-area">
        <h1>Add New Product</h1>
        <a href="{{ route('seller.dashboard') }}" style="text-decoration: none; color: #666;">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger" style="grid-column: 1 / -1;">{{ session('error') }}</div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success" style="grid-column: 1 / -1;">{{ session('success') }}</div>
    @endif
    
    <div class="form-card">
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Vintage Leather Bag">
            </div>
            
            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="technical">Technical Repair</option>
                    <option value="transport">Transport & Travel</option>
                    <option value="creative">Creative & Lifestyle</option>
                    <option value="food-fashion">Food & Fashion</option>
                    <option value="education">Education & Knowledge</option>
                    <option value="agriculture">Agriculture & Environment</option>
                    <option value="media">Media & Entertainment</option>
                    <option value="legal">Legal & Professional</option>
                    <option value="other">Other Services</option>
                </select>
            </div>
            
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Price (FRW)</label>
                    <input type="number" name="price" class="form-control" required min="1" placeholder="0">
                </div>
                <div>
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" name="stockQuantity" class="form-control" required min="1" value="1">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required placeholder="Describe your product..."></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required onchange="previewImage(this)">
                <small class="text-muted">Upload a high-quality image (JPG, PNG). Max 5MB.</small>
                <div class="preview-container" id="imagePreview"></div>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-plus-circle"></i> Publish Product
            </button>
        </form>
    </div>

    <!-- User Products List -->
    <div class="form-card" style="margin-top: 0;">
        <h2 style="margin-bottom: 20px; font-size: 1.5rem;">Your Products</h2>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #eee;">Image</th>
                    <th style="padding: 12px; border-bottom: 2px solid #eee;">Name</th>
                    <th style="padding: 12px; border-bottom: 2px solid #eee;">Price</th>
                    <th style="padding: 12px; border-bottom: 2px solid #eee;">Stock</th>
                    <th style="padding: 12px; border-bottom: 2px solid #eee;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">
                        @php
                            $img = $product['images'][0] ?? null;
                            if($img && !str_starts_with($img, 'http')) {
                             $img = rtrim($backendUrl, '/') . '/' . ltrim($img, '/');
                            }
                        @endphp
                        @if($img)
                            <img src="{{ $img }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px;"></div>
                        @endif
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">{{ $product['name'] }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">{{ number_format($product['price']) }} FRW</td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">
                        <span style="padding: 4px 8px; border-radius: 12px; font-size: 0.8rem; {{ $product['stockQuantity'] > 0 ? 'background:#d4edda; color:#155724;' : 'background:#f8d7da; color:#721c24;' }}">
                            {{ $product['stockQuantity'] }}
                        </span>
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">
                        <a href="{{ route('product.show', $product['_id']) }}" target="_blank" style="color: #007bff; margin-right: 10px;" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('seller.products.edit', $product['_id']) }}" style="color: #ffc107; margin-right: 10px;" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('seller.products.delete', $product['_id']) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer;" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #777;">No products created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function previewImage(input) {
        const container = document.getElementById('imagePreview');
        container.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-img';
                container.appendChild(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
