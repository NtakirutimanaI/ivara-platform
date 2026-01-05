@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fa;
    color: #333;
  }
  .container {
    width: 75%;
    margin-left: 270px;
    margin-top: 40px;
    padding: 15px;
  }
  h1 {
    text-align: center;
    font-size: 2rem;
    color: #924FC2;
    margin-bottom: 20px;
  }
  .product-form {
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
  }
  .product-form label {
    display: block;
    margin: 8px 0 4px;
    font-weight: bold;
  }
  .product-form input,
  .product-form textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
    border: none;
    border-bottom: 2px solid #ccc;
    border-radius: 0;
    background: transparent;
    outline: none;
    transition: border-color 0.3s;
  }
  .product-form input:focus,
  .product-form textarea:focus {
    border-bottom-color: #924FC2;
  }
  .product-form button {
    padding: 10px 18px;
    background: linear-gradient(135deg, #924FC2, #ffb74d);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  .product-form button:hover {
    background: linear-gradient(135deg, #924FC2, #0d2557);
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    font-size: 0.85rem;
  }
  th, td {
    padding: 6px 8px;
    text-align: left;
    vertical-align: middle;
  }
  th {
    background: #924FC2;
    color: #fff;
    font-weight: bold;
    font-size: 0.8rem;
  }
  tr:nth-child(even) {
    background: #f4f4f4;
  }
  tr:hover {
    background: #924FC2;
    color: #fff;
  }
  .actions {
    display: flex;
    flex-wrap: wrap;
    gap: 3px;
  }
  .actions button {
    padding: 6px 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    font-size: 0.75rem;
    transition: 0.3s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  .actions .edit {
    background: #924FC2;
    color: #fff;
    width: 60px;
    height: 26px;
  }
  .actions .edit:hover {
    background: #4caf50;
    color: #fff;
  }
  .actions .delete {
    background: #e53935;
    color: #fff;
  }
  .actions .publish {
    background: #4caf50;
    color: #fff;
  }
  .actions .unpublish {
    background: #00C853;
    color: #fff;
  }
  .message {
    padding: 10px 16px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-weight: bold;
    text-align: center;
  }
  .success { background: #4caf50; color: #fff; }
  .error { background: #e53935; color: #fff; }
  @media(max-width:1024px){
    .container {
      width: 80%;
      margin-left: 0;
      padding: 10px;
    }
    .product-form button, .actions button {
      width: 100%;
      margin-bottom: 8px;
      font-size: 0.8rem;
      padding: 6px 10px;
    }
    th, td {
      font-size: 0.75rem;
      padding: 4px 6px;
    }
  }
  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    align-items: center; justify-content: center;
  }
  .modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    position: relative;
  }
  .close {
    position: absolute;
    right: 10px; top: 10px;
    font-size: 1.2rem;
    cursor: pointer;
  }
</style>

<div class="container">

  <h1>Admin Product Management</h1>

  @if(session('success'))
    <div class="message success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="message error">{{ session('error') }}</div>
  @endif

  <div class="product-form">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label for="name">Product Name</label>
      <input type="text" name="name" id="name" placeholder="Enter product name" required>

      <label for="description">Description</label>
      <textarea name="description" id="description" rows="4" placeholder="Enter product description" required></textarea>

      <label for="price">Price (FRW)</label>
      <input type="number" name="price" step="0.01" id="price" placeholder="Enter price" required>

      <label for="image">Image</label>
      <input type="file" name="image" id="image" required>

      <button type="submit">Create Product</button>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price (FRW)</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:50px; height:40px; object-fit:cover; border-radius:6px;">
        </td>
        <td>{{ Str::limit($product->name, 20) }}</td>
        <td>{{ Str::limit($product->description, 30) }}</td>
        <td>{{ number_format($product->price) }} FRW</td>
        <td>{{ $product->status ?? 'Draft' }}</td>
        <td>{{ $product->created_at }}</td>
        <td class="actions">
          <button type="button" class="edit" onclick="openEditModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ addslashes($product->description) }}', '{{ $product->price }}')">Edit</button>

          <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="delete" onclick="return confirm('Are you sure?')">Delete</button>
          </form>

          @if($product->status !== 'Published')
          <form action="{{ route('products.publish', $product->id) }}" method="POST">
            @csrf
            <button class="publish">Publish</button>
          </form>
          @else
          <form action="{{ route('products.unpublish', $product->id) }}" method="POST">
            @csrf
            <button class="unpublish">Unpublish</button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>

<div class="modal" id="editModal">
  <div class="modal-content">
    <span class="close" onclick="closeEditModal()">&times;</span>
    <h2>Edit Product</h2>
    <form id="editForm" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <label for="edit_name">Product Name</label>
      <input type="text" name="name" id="edit_name" required>

      <label for="edit_description">Description</label>
      <textarea name="description" id="edit_description" rows="4" required></textarea>

      <label for="edit_price">Price (FRW)</label>
      <input type="number" name="price" step="0.01" id="edit_price" required>

      <label for="edit_image">Image</label>
      <input type="file" name="image" id="edit_image">

      <button type="submit">Update Product</button>
    </form>
  </div>
</div>

<script>
  function openEditModal(id, name, description, price) {
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_price').value = price;
    document.getElementById('editForm').action = '/products/' + id;
    document.getElementById('editModal').style.display = 'flex';
  }
  function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
  }
  window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
      closeEditModal();
    }
  }
</script>

@include('layouts.footer')
