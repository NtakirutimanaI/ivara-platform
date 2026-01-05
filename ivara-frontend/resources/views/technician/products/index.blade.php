@include('layouts.header')
@include('layouts.sidebar')
@include('technician.connect')

<!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f5f7fa;
        color: #333;
    }

    .container {
        width: 85%;
        margin-left: 240px;
        margin-top: 100px;
        padding: 15px;
    }

    h2 {
        font-weight: 600;
        color: #4f46e5;
        margin-bottom: 15px;
    }

    .btn-create {
        background-color: #4f46e5;
        color: #fff;
        font-weight: 500;
        border-radius: 6px;
        padding: 6px 15px;
        margin-bottom: 10px;
    }

    .btn-create:hover { background-color: #3b36b3; }

    .table {
        font-size: 0.85rem;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }

    .table thead th { 
        background: #e5e7eb; 
        color: #000; 
        text-align: center; 
        padding: 10px; 
        border-bottom: 1px solid #ccc;
    }

    .table tbody td { 
        text-align: center; 
        vertical-align: middle; 
        padding: 8px; 
        border-bottom: 1px solid #ccc;
    }

    .table img { max-width: 60px; height: auto; border-radius: 4px; }

    .btn-sm {
        padding: 3px 8px;
        font-size: 0.75rem;
    }

    .no-data { margin-top: 20px; font-size: 0.9rem; color: #dc2626; }

    @media (max-width: 1200px) { .container { width: 90%; margin-left: 200px; } }
    @media (max-width: 992px) { .container { width: 95%; margin-left: 0; } .table img { max-width: 50px; } }
    @media (max-width: 768px) { h2 { font-size: 1.4rem; } .table { font-size: 0.75rem; } .table img { max-width: 35px; } }
</style>

<div class="container">
    <h2>All Products</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-create" data-bs-toggle="modal" data-bs-target="#createProductModal">+ Create Product</button>

    @if($products->count() > 0)
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Technician</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->brand ?? '-' }}</td>
                    <td>{{ $product->category ?? '-' }}</td>
                    <td>{{ $product->technician->name ?? '-' }}</td>
                    <td>
                        <form action="{{ route('technician.products.toggle', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $product->is_published ? 'btn-success' : 'btn-secondary' }}">
                                {{ $product->is_published ? 'Yes' : 'No' }}
                            </button>
                        </form>
                    </td>
                    <td class="d-flex justify-content-center flex-wrap gap-1">
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}">View</button>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Description:</strong> {{ $product->description }}</p>
                                <p><strong>Price:</strong> ${{ number_format($product->price,2) }}</p>
                                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                                <p><strong>Brand:</strong> {{ $product->brand }}</p>
                                <p><strong>Category:</strong> {{ $product->category }}</p>
                                <p><strong>Technician:</strong> {{ $product->technician->name ?? '-' }}</p>
                                <p><strong>Published:</strong> {{ $product->is_published ? 'Yes' : 'No' }}</p>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mt-2">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('technician.products.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="2">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <label>Price</label>
                                            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Stock</label>
                                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Technician</label>
                                            <select name="technician_id" class="form-control" required>
                                                @foreach($technicians as $tech)
                                                    <option value="{{ $tech->id }}" {{ $tech->id == $product->technician_id ? 'selected' : '' }}>{{ $tech->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-2 mt-2">
                                        <div class="col-md-4">
                                            <label>Brand</label>
                                            <input type="text" name="brand" class="form-control" value="{{ $product->brand }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Category</label>
                                            <input type="text" name="category" class="form-control" value="{{ $product->category }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('technician.products.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{ $product->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="no-data">No products available.</div>
    @endif
</div>

<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form method="POST" action="{{ route('technician.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="0.00" required>
                    </div>
                    <div class="col-md-4">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" value="0" required>
                    </div>
                    <div class="col-md-4">
                        <label>Technician</label>
                        <select name="technician_id" class="form-control" required>
                            @foreach($technicians as $tech)
                                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@include('layouts.footer')
