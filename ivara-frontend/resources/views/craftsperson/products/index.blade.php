@include('layouts.header')
@include('layouts.sidebar')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
body { font-family:'Segoe UI', sans-serif; background:#f0f2f8; color:#333; }
h2 { color:#4f46e5; text-align:center; margin-bottom:20px; }
.profile-form-container {
    background:#fff; padding:20px; border-radius:12px;
    max-width:100%; margin-left:270px; margin-top:70px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
}
table { border-collapse:collapse; width:100%; }
table thead { background:#4f46e5; color:#fff; }
table th, table td { border:none; border-bottom:1px solid #ddd; padding:8px; }
table tbody tr:hover { background:#f9f9f9; }
.btn-sm { padding:4px 10px; font-size:13px; }
.pagination { justify-content:center; margin-top:20px; }

/* Responsive */
@media(max-width: 991px){
    .profile-form-container { margin:100px auto; width:95%; }
    table { font-size: 13px; }
    .btn-sm { font-size:12px; padding:3px 8px; }
}
@media(max-width: 576px){
    h2 { font-size:18px; }
    table { font-size:12px; }
    .profile-form-container { padding:10px; }
}
</style>

<div class="profile-form-container">
    <h2>My Products</h2>

    <!-- Top Action -->
    <div class="mb-3 d-flex justify-content-end">
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus"></i> Add Product
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Total Value</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr>
                    <td>{{ $products->firstItem() + $index }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category ?? '-' }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ $product->status }}</td>
                    <td>${{ number_format($product->total_value, 2) }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" width="50" alt="{{ $product->name }}">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('craftsperson.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>

                        <form action="{{ route('craftsperson.products.toggleStatus', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $product->status == 'Available' ? 'btn-success' : 'btn-secondary' }}">
                                {{ $product->status == 'Available' ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Product Modal -->
                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductLabel{{ $product->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <form action="{{ route('craftsperson.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductLabel{{ $product->id }}">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Enter product name" required>
                                </div>
                                <div class="mb-3">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control" value="{{ $product->category }}" placeholder="Enter category">
                                </div>
                                <div class="mb-3">
                                    <label>Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" placeholder="Enter price" required>
                                </div>
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" placeholder="Enter quantity" required>
                                </div>
                                <div class="mb-3">
                                    <label>Unit</label>
                                    <input type="text" name="unit" class="form-control" value="{{ $product->unit }}" placeholder="e.g. pcs, kg" required>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="Available" {{ $product->status == 'Available' ? 'selected' : '' }}>Available</option>
                                        <option value="Out of Stock" {{ $product->status == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                                        <option value="Discontinued" {{ $product->status == 'Discontinued' ? 'selected' : '' }}>Discontinued</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" width="50" class="mt-2">
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>

                @empty
                <tr>
                    <td colspan="10" class="text-center">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $products->links('pagination::bootstrap-5') }}
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('craftsperson.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" placeholder="Enter category">
                </div>
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price" required>
                </div>
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" required>
                </div>
                <div class="mb-3">
                    <label>Unit</label>
                    <input type="text" name="unit" class="form-control" placeholder="e.g. pcs, kg" required>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Discontinued">Discontinued</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Product</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
