@extends('layouts.app')

@section('title', 'Edit Product - Seller Dashboard')

@section('content')
<style>
    .seller-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }
    
    .header-area {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .form-card {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        border: 1px solid #eee;
    }
    
    .form-group {
        margin-bottom: 25px;
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
        border-color: var(--accent-gold, #924FC2);
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
        <h1>Edit Product</h1>
        <a href="{{ route('seller.products.create') }}" style="text-decoration: none; color: #666;">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="form-card">
        <form action="{{ route('seller.products.update', $product['_id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required value="{{ $product['name'] }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach(['technical', 'transport', 'creative', 'food-fashion', 'education', 'agriculture', 'media', 'legal', 'other'] as $cat)
                        <option value="{{ $cat }}" {{ $product['category'] == $cat ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' & ', $cat)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label class="form-label">Price (FRW)</label>
                    <input type="number" name="price" class="form-control" required min="0" value="{{ $product['price'] }}">
                </div>
                <div>
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" name="stockQuantity" class="form-control" required min="0" value="{{ $product['stockQuantity'] }}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" required>{{ $product['description'] }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                <small class="text-muted">Upload to replace current image. Max 5MB.</small>
                
                <div class="preview-container" id="imagePreview">
                    @php
                        $img = $product['images'][0] ?? null;
                        if($img && !str_starts_with($img, 'http')) {
                            $img = rtrim($backendUrl, '/') . '/' . ltrim($img, '/');
                        }
                    @endphp
                    @if($img)
                        <img src="{{ $img }}" class="preview-img">
                    @endif
                </div>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Update Product
            </button>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const container = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                container.innerHTML = '';
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
