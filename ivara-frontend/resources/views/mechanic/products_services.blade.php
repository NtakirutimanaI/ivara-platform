@include('layouts.header')
@include('layouts.sidebar')
@include('mechanic.connect')

<style>
.mechanic-products-body {
    font-family: 'DejaVu Sans', sans-serif;
    font-size: 14px;
    margin-top: 100px;
    margin-left: 240px;
    width: 80%;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.mechanic-products-header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #4f46e5;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.mechanic-products-title {
    font-size: 28px;
    font-weight: bold;
    color: #4f46e5;
}

.create-product-btn {
    background-color: #4f46e5;
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.create-product-btn:hover { background-color: #3730a3; }

.products-list {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.products-list > div {
    background: #fff;
    padding: 15px;
    border-bottom: 1px solid #4f46e5;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    transition: background-color 0.2s ease;
}

.products-list > div:hover { background-color: #f3f4f6; }

.product-details {
    flex: 1;
    padding-right: 15px;
}

.product-details h3 {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #0a1128;
}

.product-details p {
    margin: 0;
    font-size: 0.9rem;
    color: #6b7280;
}

.product-image {
    max-width: 100px;
    max-height: 100px;
    border-radius: 8px;
    object-fit: cover;
}

.action-buttons button {
    margin-right: 5px;
    padding: 5px 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.85rem;
}
.view-btn { background-color: #3b82f6; color: #fff; }
.edit-btn { background-color: #10b981; color: #fff; }
.delete-btn { background-color: #ef4444; color: #fff; }
.publish-btn { background-color: #f59e0b; color: #fff; }

@media(max-width: 1024px) {
    .mechanic-products-body { width: 90%; margin-left: 10px; top: 100px; }
    .products-list > div { flex-direction: column; align-items: flex-start; }
    .product-image { margin-top: 10px; width: 300px; height:100px; }
}

/* Modal styles */
.modal-bg {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    width: 100%;
    max-width: 500px;
    position: relative;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    font-weight: bold;
}
</style>

<div class="mechanic-products-body">

    <div class="mechanic-products-header">
        <button class="create-product-btn" id="openModalBtn">Create Product</button>
        <div class="mechanic-products-title">My Products & Services</div>
    </div>

    @if(session('success'))
        <div style="margin-bottom:10px; color:green; font-weight:bold;">{{ session('success') }}</div>
    @endif

    <div class="products-list">
        @foreach($products as $product)
        <div>
            <div class="product-details">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <p>Price: {{ number_format($product->price,2) }} FRW | Stock: {{ $product->stock }}</p>
                <p>Category: {{ $product->category ?? 'N/A' }} | Type: {{ ucfirst($product->type) }}</p>
                <p>Status: {{ $product->is_published ? 'Published' : 'Unpublished' }}</p>
            </div>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="product-image" alt="{{ $product->name }}">
            @endif
            <div class="action-buttons">
                <button class="view-btn" onclick="openViewModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ $product->category }}', '{{ $product->type }}', '{{ $product->is_published }}', '{{ $product->image ? asset('storage/'.$product->image) : '' }}')">View</button>
                <button class="edit-btn" onclick="openEditModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ $product->category }}', '{{ $product->type }}')">Edit</button>
                <button class="delete-btn" onclick="openDeleteModal({{ $product->id }})">Delete</button>

                <form action="{{ route('mechanic.products_services.publish', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="publish-btn">
                        {{ $product->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- CREATE Modal -->
<div class="modal-bg" id="createModal">
    <div class="modal-content">
        <span class="modal-close" id="closeModal">&times;</span>
        <h3>Create New Product/Service</h3>
        <form action="{{ route('mechanic.products_services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:10px;">
                <label>Name</label><br>
                <input type="text" name="name" placeholder="Enter product or service name" required style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Description</label><br>
                <textarea name="description" rows="3" placeholder="Enter a short description" style="width:100%; padding:5px;"></textarea>
            </div>
            <div style="margin-bottom:10px;">
                <label>Price</label><br>
                <input type="number" step="0.01" name="price" placeholder="Enter price in FRW" required style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Stock</label><br>
                <input type="number" name="stock" placeholder="Enter stock quantity" required style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Category</label><br>
                <input type="text" name="category" placeholder="Enter category" style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Type</label><br>
                <select name="type" style="width:100%; padding:5px;">
                    <option value="product">Product</option>
                    <option value="service">Service</option>
                </select>
            </div>
            <div style="margin-bottom:10px;">
                <label>Image</label><br>
                <input type="file" name="image">
            </div>
            <button type="submit" style="background:#4f46e5; color:#fff; padding:0.5rem 1rem; border:none; border-radius:6px;">Save Product</button>
        </form>
    </div>
</div>

<!-- VIEW Modal -->
<div class="modal-bg" id="viewModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModalWindow('viewModal')">&times;</span>
        <h3>Product Details</h3>
        <div id="viewContent"></div>
    </div>
</div>

<!-- EDIT Modal -->
<div class="modal-bg" id="editModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModalWindow('editModal')">&times;</span>
        <h3>Edit Product</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editId">
            <div style="margin-bottom:10px;">
                <label>Name</label><br>
                <input type="text" name="name" id="editName" style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Description</label><br>
                <textarea name="description" id="editDescription" rows="3" style="width:100%; padding:5px;"></textarea>
            </div>
            <div style="margin-bottom:10px;">
                <label>Price</label><br>
                <input type="number" step="0.01" name="price" id="editPrice" style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Stock</label><br>
                <input type="number" name="stock" id="editStock" style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Category</label><br>
                <input type="text" name="category" id="editCategory" style="width:100%; padding:5px;">
            </div>
            <div style="margin-bottom:10px;">
                <label>Type</label><br>
                <select name="type" id="editType" style="width:100%; padding:5px;">
                    <option value="product">Product</option>
                    <option value="service">Service</option>
                </select>
            </div>
            <div style="margin-bottom:10px;">
                <label>Image</label><br>
                <input type="file" name="image">
            </div>
            <button type="submit" style="background:#10b981; color:#fff; padding:0.5rem 1rem; border:none; border-radius:6px;">Update</button>
        </form>
    </div>
</div>

<!-- DELETE Modal -->
<div class="modal-bg" id="deleteModal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModalWindow('deleteModal')">&times;</span>
        <h3>Confirm Delete</h3>
        <p>Are you sure you want to delete this product?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:#ef4444; color:#fff; padding:0.5rem 1rem; border:none; border-radius:6px;">Yes, Delete</button>
        </form>
    </div>
</div>

<script>
// CREATE modal
const openModalBtn = document.getElementById('openModalBtn');
const createModal = document.getElementById('createModal');
const closeModal = document.getElementById('closeModal');
openModalBtn.addEventListener('click', () => createModal.style.display = 'flex');
closeModal.addEventListener('click', () => createModal.style.display = 'none');

// Generic close
function closeModalWindow(id) {
    document.getElementById(id).style.display = 'none';
}

// VIEW modal
function openViewModal(id, name, description, price, stock, category, type, published, image) {
    let html = `
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Description:</strong> ${description}</p>
        <p><strong>Price:</strong> ${price} FRW</p>
        <p><strong>Stock:</strong> ${stock}</p>
        <p><strong>Category:</strong> ${category}</p>
        <p><strong>Type:</strong> ${type}</p>
        <p><strong>Status:</strong> ${published == 1 ? 'Published' : 'Unpublished'}</p>
    `;
    if (image) html += `<img src="${image}" style="max-width:100%; margin-top:10px;">`;
    document.getElementById('viewContent').innerHTML = html;
    document.getElementById('viewModal').style.display = 'flex';
}

// EDIT modal
function openEditModal(id, name, description, price, stock, category, type) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editDescription').value = description;
    document.getElementById('editPrice').value = price;
    document.getElementById('editStock').value = stock;
    document.getElementById('editCategory').value = category;
    document.getElementById('editType').value = type;
    document.getElementById('editForm').action = '/mechanic/products_services/' + id;
    document.getElementById('editModal').style.display = 'flex';
}

// DELETE modal
function openDeleteModal(id) {
    document.getElementById('deleteForm').action = '/mechanic/products_services/' + id;
    document.getElementById('deleteModal').style.display = 'flex';
}

// Click outside to close
window.addEventListener('click', (e) => {
    ['createModal','viewModal','editModal','deleteModal'].forEach(id=>{
        let modal = document.getElementById(id);
        if(e.target === modal) modal.style.display='none';
    });
});
</script>

@include('layouts.footer')
