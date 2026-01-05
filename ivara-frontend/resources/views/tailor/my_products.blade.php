@include('layouts.header') <!-- optional header include -->
@include('layouts.sidebar')
@include('tailor.connect')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
.products-page {
    width: 80%;
    margin-left: 240px;
    margin-top: 100px;
}
.products-table {
    width: 100%;
    border-collapse: collapse;
}
.products-table th, .products-table td {
    vertical-align: middle;
    text-align: center;
    border: none;
    padding: 12px 8px;
}
.products-table th {
    border-bottom: 2px solid #333;
}
.products-table td {
    border-bottom: 1px solid #ddd;
}
.products-table img {
    max-width: 80px;
    height: auto;
    border-radius: 5px;
}
@media (max-width: 992px) {
    .products-page {
        width: 95%;
        margin-left: 0;
        margin-top: 60px;
    }
    .products-table th, .products-table td {
        font-size: 12px;
        padding: 8px 4px;
    }
    .products-table img {
        max-width: 60px;
    }
}
</style>

<div class="products-page">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2>My Products</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="fas fa-plus"></i> Add Product
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table products-table">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Category</th><th>Price</th><th>Quantity</th>
                    <th>Unit</th><th>Status</th><th>Image</th><th>Created At</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>${{ number_format($product->price,2) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>
                        @if($product->status == 'Available')
                            <span class="badge bg-success">{{ $product->status }}</span>
                        @elseif($product->status == 'Out of Stock')
                            <span class="badge bg-warning text-dark">{{ $product->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $product->status }}</span>
                        @endif
                    </td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image">
                        @else
                            <i class="fas fa-image fa-2x text-muted"></i>
                        @endif
                    </td>
                    <td>{{ $product->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('tailor.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <form action="{{ route('tailor.products.toggleStatus', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">
                                @if($product->status == 'Available') <i class="fas fa-eye-slash"></i> @else <i class="fas fa-eye"></i> @endif
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- View Modal --}}
                <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-center">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid mb-3">
                                @endif
                                <p><strong>Category:</strong> {{ $product->category }}</p>
                                <p><strong>Price:</strong> ${{ number_format($product->price,2) }}</p>
                                <p><strong>Quantity:</strong> {{ $product->quantity }} {{ $product->unit }}</p>
                                <p><strong>Status:</strong> {{ $product->status }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('tailor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Product - {{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}" required>
                                    <input type="text" name="category" class="form-control mb-2" value="{{ $product->category }}" required>
                                    <input type="number" name="price" step="0.01" class="form-control mb-2" value="{{ $product->price }}" required>
                                    <input type="number" name="quantity" step="0.01" class="form-control mb-2" value="{{ $product->quantity }}" required>
                                    <input type="text" name="unit" class="form-control mb-2" value="{{ $product->unit }}" required>
                                    <select name="status" class="form-control mb-2">
                                        <option value="Available" @if($product->status=='Available') selected @endif>Available</option>
                                        <option value="Out of Stock" @if($product->status=='Out of Stock') selected @endif>Out of Stock</option>
                                        <option value="Unavailable" @if($product->status=='Unavailable') selected @endif>Unavailable</option>
                                    </select>
                                    <input type="file" name="image" class="form-control mb-2">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="11" class="text-center text-muted">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Create Product Modal --}}
<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('tailor.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="text" name="category" class="form-control mb-2" placeholder="Category" required>
                    <input type="number" name="price" step="0.01" class="form-control mb-2" placeholder="Price" required>
                    <input type="number" name="quantity" step="0.01" class="form-control mb-2" placeholder="Quantity" required>
                    <input type="text" name="unit" class="form-control mb-2" placeholder="Unit" required>
                    <select name="status" class="form-control mb-2" required>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                    <input type="file" name="image" class="form-control mb-2">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')