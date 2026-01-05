@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f5f7fa;
    color: #333;
  }

  .container {
    width: 80%;
    margin-left: 240px;
    margin-top: 70px;
    max-width: 1200px;
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
    color: #071839;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.1);
  }

  .my-orders-btn {
    display: block;
    width: 220px;
    margin: 15px auto;
    padding: 10px;
    background: #4caf50;
    color: #fff;
    text-align: center;
    font-weight: bold;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.3s;
  }

  .my-orders-btn:hover {
    background: #388e3c;
  }

  .products {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(250px,1fr));
    gap: 15px;
    margin-top: 20px;
  }

  .product-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    flex-direction: column;
    
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  }

  .product-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-bottom: 1px solid #eee;
  }

  .product-info {
    padding: 10px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .product-info h3 {
    font-size: 1.2rem;
    margin-bottom: 8px;
    color: #071839;
  }
  .btnEdit{
    width:70px; 
    height:32px;
    justify-content: center;
    align-items: center;
  }

  .product-info p {
    font-size: 0.85rem;
    margin-bottom: 8px;
    color: #555;
    flex: 1;
  }

  .product-info .price {
    font-weight: bold;
    color: #ff9800;
    font-size: 1rem;
    margin-bottom: 8px;
  }

  .product-info button,
  .product-info form button {
    padding: 8px 12px;
    background: #071839;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
    margin-bottom: 5px;
  }

  .product-info button:hover,
  .product-info form button:hover {
    background: #ff9800;
    color: #071839;
  }

  /* Modal */
  .modal {
    display: none;
    position: fixed;
    top:0; left:0;
    width:100%; height:70%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 5px;
    overflow-y: auto;
  }

  .modal-content {
    background: #fff;
    border-radius: 12px;
    max-width: 500px;
    width: 100%;
    max-height: 60vh;
    padding: 15px;
    position: relative;
    animation: fadeIn 0.5s ease;
    overflow-y: auto;
  }

  .modal-content h2 {
    margin-bottom: 10px;
    color: #071839;
    font-size: 1.5rem;
  }

  .modal-content label {
    display: block;
    margin: 8px 0 4px;
    font-weight: bold;
    font-size: 0.9rem;
  }

  .modal-content input,
  .modal-content select,
  .modal-content textarea {
    width: 100%;
    padding: 6px 8px;
    margin-bottom: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
  }

  .modal-content button {
    width: 100%;
    padding: 10px;
    background: #ff9800;
    color: #071839;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
  }

  .modal-content button:hover {
    background: #071839;
    color: #ff9800;
  }

  .modal-content .close {
    position: absolute;
    top:8px; right:12px;
    font-size: 1.3rem;
    cursor: pointer;
    color: #333;
  }

  @keyframes fadeIn {
    from { opacity:0; transform: scale(0.8); }
    to { opacity:1; transform: scale(1); }
  }

  /* Responsive */
  @media(max-width:768px){
    .products { grid-template-columns: repeat(auto-fill,minmax(200px,1fr)); }
    h1 { font-size: 1.8rem; }
    .container{margin-left: 20px; margin-top: 100px; width: 95%;}
  }
  @media(max-width:480px){
    .products { grid-template-columns: repeat(auto-fill,minmax(150px,1fr)); }
  }

  .highlight {
    background: #fff4e5;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 10px;
  }
</style>

<div class="container">
    <h1><i class="fa fa-store"></i>My Products & Services</h1>

    <!-- Create Product Button -->
    <button class="my-orders-btn" id="btnOpenCreateModal">➕ Create Product/Service</button>

    <!-- Success message -->
    @if(session('success'))
        <div class="highlight">{{ session('success') }}</div>
    @endif

    @if($products_services->isEmpty())
        <div class="highlight">No products or services yet.</div>
    @else
        <div class="products">
            @foreach($products_services as $item)
                <div class="product-card">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}">
                    @endif
                    <div class="product-info">
                        <h3>{{ $item->title }}</h3>
                        <p>Type: {{ ucfirst($item->type) }}</p>
                        <p class="price">${{ number_format($item->price, 2) }}</p>
                        <p>Status: {{ $item->status }}</p>
                        @if($item->description)
                            <p>{{ $item->description }}</p>
                        @endif
                        <div style="display:flex; gap:5px; flex-wrap:wrap;">
                            <!-- Edit button -->
                            <button class="btnEdit" 
                                    data-id="{{ $item->id }}"
                                    data-type="{{ $item->type }}"
                                    data-title="{{ $item->title }}"
                                    data-price="{{ $item->price }}"
                                    data-status="{{ $item->status }}"
                                    data-description="{{ $item->description ?? '' }}"
                                    data-image="{{ $item->image ?? '' }}">
                                    Edit
                            </button>

                            <!-- Publish/Unpublish -->
                            <form action="{{ route('client.products.toggle', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background:#ff9800;">{{ $item->status == 'Active' ? 'Unpublish' : 'Publish' }}</button>
                            </form>

                            <!-- Delete -->
                            <form action="{{ route('client.products.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:red;">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Create/Edit Modal -->
<div class="modal" id="modalProduct">
    <div class="modal-content">
        <span class="close" id="modalClose">&times;</span>
        <h2 id="modalTitle">Create Product/Service</h2>
        <form id="formProduct" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" id="product_id">

            <label for="type">Type</label>
            <select name="type" id="type">
                <option value="product">Product</option>
                <option value="service">Service</option>
            </select>

            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Enter product/service title" required>

            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" placeholder="Enter price in USD" required>

            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Enter description"></textarea>

            <label for="image">Image</label>
            <input type="file" name="image" id="image">
            <img id="previewImage" src="" style="width:100%; max-height:350px; margin-top:10px; display:none; border-radius:6px;">

            <button type="submit">Save</button>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById('modalProduct');
const btnOpenCreate = document.getElementById('btnOpenCreateModal');
const modalClose = document.getElementById('modalClose');
const form = document.getElementById('formProduct');
const modalTitle = document.getElementById('modalTitle');
const previewImage = document.getElementById('previewImage');

// Open Create Modal
btnOpenCreate.addEventListener('click', () => {
    modal.style.display = 'flex';
    modalTitle.textContent = 'Create Product/Service';
    form.action = "{{ route('client.products.store') }}"; // POST route
    form.reset();
    previewImage.style.display = 'none';
});

// Close Modal
modalClose.addEventListener('click', () => modal.style.display = 'none');
window.addEventListener('click', e => { if(e.target == modal) modal.style.display = 'none'; });

// Image preview
document.getElementById('image').addEventListener('change', function(e){
    if(this.files && this.files[0]){
        let reader = new FileReader();
        reader.onload = function(ev){
            previewImage.src = ev.target.result;
            previewImage.style.display = 'block';
        }
        reader.readAsDataURL(this.files[0]);
    }
});

// Edit Buttons
document.querySelectorAll('.btnEdit').forEach(btn => {
    btn.addEventListener('click', () => {
        modal.style.display = 'flex';
        modalTitle.textContent = 'Edit Product/Service';
        form.action = "{{ url('/client/products/update') }}/" + btn.dataset.id; // POST route
        document.getElementById('product_id').value = btn.dataset.id;
        document.getElementById('type').value = btn.dataset.type;
        document.getElementById('title').value = btn.dataset.title;
        document.getElementById('price').value = btn.dataset.price;
        document.getElementById('status').value = btn.dataset.status;
        document.getElementById('description').value = btn.dataset.description;
        if(btn.dataset.image){
            previewImage.src = "{{ asset('storage') }}/" + btn.dataset.image;
            previewImage.style.display = 'block';
        } else {
            previewImage.style.display = 'none';
        }
    });
});
</script>
@include('layouts.footer')
