@include('layouts.header')

<!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif; /* Changed to Poppins */
    background: #f5f7fa;
    color: #333;
  }

  .container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2.5rem;
    color: #071839;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.1);
  }

  .products {
    display: grid;
    grid-template-columns: repeat(auto-fill,minmax(200px,1fr));
    gap: 15px;
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
    height: 150px;
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

  .product-info p {
    font-size: 0.95rem; /* Slightly larger for Poppins readability */
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

  .product-info button {
    padding: 8px 12px;
    background: #071839;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s;
  }

  .product-info button:hover {
    background: #ff9800;
    color: #071839;
  }

  /* Modal */
  .modal {
    display: none;
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 5px;
  }

  .modal-content {
    background: #fff;
    border-radius: 12px;
    max-width: 400px;
    width: 100%;
    padding: 15px;
    position: relative;
    animation: fadeIn 0.5s ease;
    font-family: 'Poppins', sans-serif;
  }

  .modal-content h2 {
    margin-bottom: 10px;
    color: #071839;
    font-size: 1.5rem;
  }

  .modal-content p.price {
    color: #ff9800;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 1rem;
  }

  .modal-content label {
    display: block;
    margin: 8px 0 4px;
    font-weight: bold;
    font-size: 0.95rem;
  }

  .modal-content input,
  .modal-content select {
    width: 100%;
    padding: 6px 8px;
    margin-bottom: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
  }

  .modal-content button {
    width: 100%;
    padding: 8px;
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
    .products { grid-template-columns: repeat(auto-fill,minmax(150px,1fr)); }
    h1 { font-size: 2rem; }
    .container{margin-top:160px;}
  }

  @media(max-width:600px){
    .container{margin-top:160px;}
  }

  /* My Orders Button */
  .my-orders-btn {
    display: block;
    width: 150px;
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
</style>

<div class="container">

  <h1>Our Products</h1>

  <!-- My Orders Button (Visible only if logged in) -->
  @auth
    <a href="{{ url('/web/orders') }}" class="my-orders-btn">My Orders</a>
  @endauth

  <div class="products" id="productList">
    @foreach($products as $product)
      <div class="product-card">
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
        <div class="product-info">
          <h3>{{ $product->name }}</h3>
          <p>{{ Str::limit($product->description, 50) }}</p>
          <p class="price">${{ $product->price }}</p>
          <button onclick="viewDetails({{ $product->id }})">View Details</button>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Product Modal -->
  <div class="modal" id="productModal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2 id="modalName"></h2>
      <img id="modalImg" src="" style="width:100%; max-height:200px; object-fit:cover; margin-bottom:10px;">
      <p id="modalDesc"></p>
      <p class="price" id="modalPrice"></p>
      <label>Quantity:</label>
      <input type="number" id="quantity" value="1" min="1">
      <label>Payment method:</label>
      <select id="payment">
        <option value="cash">Cash on Delivery</option>
        <option value="card">Card Payment</option>
      </select>
      <button onclick="placeOrder()">Place Order</button>
    </div>
  </div>

</div>

<script>
let selectedProductId = null;

function viewDetails(id){
  fetch('/products/'+id)
  .then(res=>res.json())
  .then(data=>{
    selectedProductId = data.id;
    document.getElementById('modalName').textContent = data.name;
    document.getElementById('modalImg').src = '/storage/'+data.image;
    document.getElementById('modalDesc').textContent = data.description;
    document.getElementById('modalPrice').textContent = "$"+data.price;
    document.getElementById('productModal').style.display='flex';
  });
}

function closeModal(){
  document.getElementById('productModal').style.display='none';
}

function placeOrder(){
  let qty = document.getElementById('quantity').value;
  let payment = document.getElementById('payment').value;
  fetch('/orders', {
    method:'POST',
    headers:{
      'Content-Type':'application/json',
      'X-CSRF-TOKEN':'{{ csrf_token() }}'
    },
    body: JSON.stringify({product_id:selectedProductId, quantity:qty, payment_method:payment})
  })
  .then(res=>res.json())
  .then(data=>{
    if(data.id){
      alert('Order placed successfully!');
      closeModal();
    }else{
      alert('Error placing order');
    }
  });
}
</script>

@include('layouts.footer')
