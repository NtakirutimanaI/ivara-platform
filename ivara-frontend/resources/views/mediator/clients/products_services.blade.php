@include('layouts.header')
@include('layouts.sidebar')
@include('mediator.connect')

<style>
/* General Layout */
.container {
    margin-left: 300px;
    margin-top: 70px;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}

/* Header box */
.step-box {
    background: #4f46e5;
    color: #fff;
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    font-size: 18px;
    font-weight: 500;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Highlight messages */
.highlight {
    background: #e0f7fa;
    padding: 12px 15px;
    border-left: 5px solid #4f46e5;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

/* Table container for responsiveness */
.table-container {
    overflow-x: auto;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
    margin-top: 15px;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    font-size: 14px;
}

th {
    background: #f3f4f6;
    font-weight: 600;
}

tr {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

tr td:first-child, tr th:first-child {
    border-radius: 10px 0 0 10px;
}

tr td:last-child, tr th:last-child {
    border-radius: 0 10px 10px 0;
}

/* Product Image */
.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

/* Buttons */
.btn {
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.btn-success {
    background: #22c55e;
    color: #fff;
}

.btn-success:hover {
    background: #16a34a;
}

.btn-view {
    background: #3b82f6;
    color: #fff;
}

.btn-view:hover {
    background: #2563eb;
}

.btn-like {
    background: #ef4444;
    color: #fff;
}

.btn-like.active {
    background: #10b981; /* green if liked */
}

.btn-cart {
    background: #f59e0b;
    color: #fff;
}

.btn-cart:hover {
    background: #b45309;
}

.btn-connect {
    background: #6366f1;
    color: #fff;
}

.btn-connect:hover {
    background: #4f46e5;
}

/* Buttons row container */
.buttons-row {
    display: flex;
    gap: 10px;
    align-items: center;
    justify-content: center; /* CENTERED BUTTONS */
    flex-wrap: wrap; /* Wrap on smaller screens */
    margin-top: 15px;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0; top: 0;
    width: 100%; height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
    align-items: center;
    justify-content: center;
    padding: 10px; /* small padding for mobile responsiveness */
    box-sizing: border-box;
}

.modal-content {
    background: #fff;
    margin: auto;
    padding: 20px;
    border-radius: 12px;
    width: 100%;
    max-width: 600px;
    position: relative;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    text-align: center;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    font-weight: bold;
    cursor: pointer;
}

/* Zoomable image */
.modal-image-container {
    width: 100%;
    overflow: auto;
    cursor: grab;
    border-radius: 10px;
    margin-bottom: 15px;
}

.modal-image-container img {
    max-width: 100%;
    max-height: 400px;
    transition: transform 0.3s ease;
    border-radius: 10px;
}

/* Responsive */
@media (max-width: 992px) {
    .container { margin-left: 0; width: 100%; padding: 15px; }
    th, td { font-size: 12px; padding: 8px; }
    .btn { font-size: 12px; padding: 5px 10px; }
    .modal-content { max-width: 90%; padding: 15px; }
}

@media (max-width: 576px) {
    .buttons-row { flex-direction: column; gap: 8px; }
    .modal-image-container img { max-height: 300px; }
}
</style>


<div class="container">
    <h2 class="step-box">👥 Client Products & Services</h2>

    @if(session('success'))
        <div class="highlight">{{ session('success') }}</div>
    @endif

    @if($products_services->isEmpty())
        <div class="highlight">No active products/services available.</div>
    @else
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Client</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products_services as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" class="product-image">
                                @else
                                    <img src="{{ asset('images/default-product.png') }}" alt="No Image" class="product-image">
                                @endif
                            </td>
                            <td>{{ $item->client_name }}</td>
                            <td>{{ ucfirst($item->type) }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description ?? '---' }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>
                                <form action="{{ route('mediator.joinProduct') }}" method="POST" class="join-form" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success btn-join">
                                        <i class="fa fa-handshake"></i> Join
                                    </button>
                                </form>
                                <button class="btn btn-view" onclick="openModal({{ $item->id }})">
                                    <i class="fa fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modals -->
        @foreach($products_services as $item)
            <div id="modal-{{ $item->id }}" class="modal">
                <div class="modal-content">
                    <span class="modal-close" onclick="closeModal({{ $item->id }})">&times;</span>
                    <div class="modal-image-container" id="image-container-{{ $item->id }}">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image" id="image-{{ $item->id }}">
                        @else
                            <img src="{{ asset('images/default-product.png') }}" alt="No Image" id="image-{{ $item->id }}">
                        @endif
                    </div>
                    <h3>{{ $item->title }}</h3>
                    <p><strong>Type:</strong> {{ ucfirst($item->type) }}</p>
                    <p><strong>Description:</strong> {{ $item->description ?? '---' }}</p>
                    <p><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                    <p><strong>Client:</strong> {{ $item->client_name }}</p>

                    <div class="buttons-row">
                        <button class="btn btn-like {{ $item->isLikedByAuth() ? 'active' : '' }}" 
                            onclick="toggleLike({{ $item->id }})" id="like-btn-{{ $item->id }}">
                            <i class="fa fa-thumbs-up"></i> {{ $item->isLikedByAuth() ? 'Liked' : 'Like' }}
                        </button>
                        <span id="like-count-{{ $item->id }}">{{ $item->likes_count }} Likes</span>

                        <form action="{{ route('cart.add', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    @endif
</div>

<script>
// Confirm before joining
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.join-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const confirmed = confirm('Are you sure you want to join this product/service and earn commission?');
            if (!confirmed) e.preventDefault();
        });
    });
});

// Modal functions
function openModal(id) {
    document.getElementById('modal-' + id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
}
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if(event.target == modal) modal.style.display = 'none';
    });
}

// Like / Dislike toggle using AJAX
function toggleLike(productId) {
    const btn = document.getElementById('like-btn-' + productId);
    fetch('/mediator/like-product/' + productId, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
    })
    .then(res => res.json())
    .then(data => {
        btn.classList.toggle('active', data.liked);
        btn.innerHTML = `<i class="fa fa-thumbs-up"></i> ${data.liked ? 'Liked' : 'Like'}`;
        document.getElementById('like-count-' + productId).innerText = data.likes_count + ' Likes';
    });
}

// Zoom / Pan image
document.querySelectorAll('.modal-image-container').forEach(container => {
    const img = container.querySelector('img');
    let scale = 1, originX = 0, originY = 0;
    let isDragging = false, startX, startY;

    container.onwheel = function(e) {
        e.preventDefault();
        scale += e.deltaY * -0.001;
        scale = Math.min(Math.max(1, scale), 3);
        img.style.transform = `scale(${scale}) translate(${originX/scale}px, ${originY/scale}px)`;
    };

    container.onmousedown = function(e) {
        isDragging = true;
        startX = e.pageX - originX;
        startY = e.pageY - originY;
        container.style.cursor = 'grabbing';
    };
    container.onmouseup = function() { isDragging = false; container.style.cursor = 'grab'; };
    container.onmouseleave = function() { isDragging = false; container.style.cursor = 'grab'; };
    container.onmousemove = function(e) {
        if(!isDragging) return;
        originX = e.pageX - startX;
        originY = e.pageY - startY;
        img.style.transform = `scale(${scale}) translate(${originX/scale}px, ${originY/scale}px)`;
    };
});
</script>
