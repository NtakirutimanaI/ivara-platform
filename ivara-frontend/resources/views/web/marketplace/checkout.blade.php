@extends('layouts.app')

@section('title', 'Checkout - IVARA Marketplace')

@section('content')
<style>
    :root {
        --primary-navy: #0A1128;
        --secondary-navy: #162447;
        --accent-gold: #ffb700;
        --bg-light: #f8f9fa;
        --text-gray: #666;
    }

    .checkout-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Poppins', sans-serif;
    }

    .checkout-layout {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 40px;
    }

    @media (max-width: 992px) {
        .checkout-layout {
            grid-template-columns: 1fr;
        }
    }

    .section-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title i {
        color: var(--accent-gold);
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #444;
        font-size: 0.9rem;
    }

    input, select, textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        font-size: 1rem;
        transition: 0.3s;
    }

    input:focus {
        outline: none;
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 3px rgba(10, 17, 40, 0.1);
    }

    /* Order Summary */
    .order-summary {
        position: sticky;
        top: 100px;
    }

    .summary-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
        gap: 15px;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        background: #f8f9fa;
    }

    .summary-details {
        flex: 1;
    }

    .summary-name {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--primary-navy);
        margin: 0;
    }

    .summary-meta {
        font-size: 0.85rem;
        color: #777;
    }

    .total-card {
        background: var(--primary-navy);
        color: white;
        border-radius: 12px;
        padding: 25px;
        margin-top: 25px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .total-row.grand-total {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 15px;
        margin-top: 15px;
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--accent-gold);
    }

    .btn-place-order {
        width: 100%;
        background: var(--accent-gold);
        color: var(--primary-navy);
        border: none;
        padding: 18px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 1.2rem;
        margin-top: 25px;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .btn-place-order:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 183, 0, 0.3);
        background: #ffc933;
    }

    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        color: #27ae60;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="checkout-container">
    <div class="checkout-layout">
        <!-- Main Form -->
        <div class="checkout-main">
            <div class="section-card">
                <h2 class="section-title"><i class="fas fa-shipping-fast"></i> Shipping Information</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" id="firstName" placeholder="John" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="lastName" placeholder="Doe" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="email" value="{{ auth()->user()->email ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" id="address" placeholder="123 Street Name" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" id="city" placeholder="Kigali" required>
                    </div>
                    <div class="form-group">
                        <label>Province / State</label>
                        <input type="text" id="province" placeholder="Kigali City" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" id="phone" placeholder="+250..." required>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" id="country" value="Rwanda" required>
                    </div>
                </div>
            </div>

            <div class="section-card">
                <h2 class="section-title"><i class="fas fa-credit-card"></i> Payment Method</h2>
                <div class="payment-options">
                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 10px; padding: 15px; border: 1px solid #ddd; border-radius: 10px; cursor: pointer;">
                            <input type="radio" name="payment" checked style="width: auto;">
                            <span>Mobile Money (MTN/Airtel)</span>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/MTN_Logo.svg/1200px-MTN_Logo.svg.png" style="height: 20px; margin-left: auto;">
                        </label>
                    </div>
                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 10px; padding: 15px; border: 1px solid #ddd; border-radius: 10px; cursor: pointer;">
                            <input type="radio" name="payment" style="width: auto;">
                            <span>Credit / Debit Card</span>
                            <div style="margin-left: auto; display: flex; gap: 5px;">
                                <i class="fab fa-cc-visa" style="color: #1a1f71; font-size: 1.5rem;"></i>
                                <i class="fab fa-cc-mastercard" style="color: #eb001b; font-size: 1.5rem;"></i>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="order-summary">
            <div class="section-card">
                <h2 class="section-title"><i class="fas fa-shopping-bag"></i> Order Summary</h2>
                
                <div class="summary-list">
                    @foreach($items as $item)
                    @php
                        $product = $item['productId'] ?? $item['product'] ?? [];
                        $name = $product['name'] ?? ($item['productName'] ?? 'Product');
                        $image = null;
                        if (isset($product['images']) && count($product['images']) > 0) {
                            $image = $product['images'][0];
                        } else {
                            $image = $item['productImage'] ?? null;
                        }

                        if ($image && !str_starts_with($image, 'http')) {
                            $image = rtrim($backendUrl, '/') . '/' . ltrim($image, '/');
                        }
                    @endphp
                    <div class="summary-item">
                        @if($image)
                             <img src="{{ $image }}" class="summary-img" onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-icon').style.display='flex';">
                             <div class="summary-img fallback-icon" style="display: none; align-items: center; justify-content: center; font-size: 1.5rem; color: #ccc;">
                                <i class="fas fa-box"></i>
                             </div>
                        @else
                             <div class="summary-img" style="display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #ccc;">
                                <i class="fas fa-box"></i>
                             </div>
                        @endif
                        <div class="summary-details">
                            <p class="summary-name">{{ $name }}</p>
                            <span class="summary-meta">Qty: {{ $item['quantity'] }} × {{ number_format($item['price']) }} FRW</span>
                        </div>
                        <div style="font-weight: 700; color: var(--primary-navy);">
                            {{ number_format($item['subtotal']) }}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="total-card">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>{{ number_format($total) }} FRW</span>
                    </div>
                    <div class="total-row">
                        <span>Shipping</span>
                        <span>0 FRW</span>
                    </div>
                    <div class="total-row grand-total">
                        <span>Total</span>
                        <span>{{ number_format($total) }} FRW</span>
                    </div>
                </div>

                <button class="btn-place-order" id="placeOrderBtn">
                    Confirm & Pay Now <i class="fas fa-shield-alt"></i>
                </button>

                <div class="secure-badge">
                    <i class="fas fa-lock"></i>
                    <span>Secure Checkout Encryption Enabled</span>
                </div>
                
                <p style="font-size: 0.75rem; color: #777; text-align: center; margin-top: 15px;">
                    By clicking Confirm, you agree to IVARA's <a href="#">Terms of Service</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('placeOrderBtn').addEventListener('click', async function() {
        // Collect form values
        const firstName = document.getElementById('firstName')?.value?.trim() || '';
        const lastName = document.getElementById('lastName')?.value?.trim() || '';
        const address = document.getElementById('address')?.value?.trim() || '';
        const city = document.getElementById('city')?.value?.trim() || '';
        const province = document.getElementById('province')?.value?.trim() || '';
        const phone = document.getElementById('phone')?.value?.trim() || '';
        const country = document.getElementById('country')?.value?.trim() || 'Rwanda';

        // Validate required fields
        const errors = [];
        if (!firstName || !lastName) errors.push('Full Name is required');
        if (!phone) errors.push('Phone number is required');
        if (!address) errors.push('Street address is required');
        if (!city) errors.push('City is required');
        if (!province) errors.push('Province/State is required');

        if (errors.length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Information',
                html: '<ul style="text-align:left;">' + errors.map(e => '<li>' + e + '</li>').join('') + '</ul>',
                confirmButtonColor: '#0A1128'
            });
            return;
        }

        Swal.fire({
            title: 'Processing Payment...',
            text: 'Please wait while we secure your transaction',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            // Create order via Laravel proxy
            const response = await fetch('{{ route("cart.placeOrder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    shippingAddress: {
                        fullName: firstName + ' ' + lastName,
                        phone: phone,
                        addressLine1: address,
                        city: city,
                        province: province,
                        country: country
                    },
                    paymentMethod: document.querySelector('input[name="payment"]:checked')?.nextElementSibling?.textContent?.trim() || 'Mobile Money'
                })
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Order Placed!',
                    text: 'Your order has been successfully placed. Order #' + (data.data?.orderId || 'confirmed'),
                    confirmButtonColor: '#0A1128'
                }).then(() => {
                    window.location.href = "{{ route('orders.index') }}";
                });
            } else {
                throw new Error(data.message || 'Failed to place order');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Order Failed',
                text: error.message || 'Unable to place order. Please try again.',
                confirmButtonColor: '#0A1128'
            });
        }
    });
</script>
@endsection
