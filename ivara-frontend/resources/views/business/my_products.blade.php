@include('layouts.header')
@include('layouts.sidebar')
@include('business.connect')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
    .privacy-sec-container {
        width: 80%;
        margin-left: 250px;
        margin-top: 100px;
    }
    .privacy-sec-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .privacy-sec-auth-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        padding: 30px;
        width: 100%;
        overflow-x: auto;
    }
    .privacy-sec-btn {
        padding: 6px 12px;
        font-size: 0.85rem;
        background: #2563eb;
        border: none;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
    }
    .privacy-sec-btn:hover { background: #1e40af; }
    .btn-danger { background: #dc2626; border: none; }
    .btn-warning { background: #f59e0b; border: none; color:#fff; }
    .table th, .table td {
        border: none;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }
    .action-buttons button, .action-buttons form {
        display: inline-block;
        margin-right: 5px;
    }
    @media (max-width: 1024px) {
        .privacy-sec-container { width: 95%; margin-left: auto; margin-right: auto; margin-top: 50px; }
    }
</style>

<div class="privacy-sec-container">
    <div class="privacy-sec-title d-flex justify-content-between align-items-center">
        <span>My Products</span>
        <button class="privacy-sec-btn" data-bs-toggle="modal" data-bs-target="#createProductModal">
            <i class="fa fa-plus"></i> Create My Product
        </button>
    </div>

    <div class="privacy-sec-auth-box">
        <table class="table">
            <thead class="table-light">
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
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ number_format($product->quantity, 2) }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ number_format($product->total_value, 2) }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="50" height="50">
                        @else N/A
                        @endif
                    </td>
                    <td>{{ $product->created_at->format('Y-m-d H:i') }}</td>
                    <td class="action-buttons">
                        <!-- View -->
                        <button class="privacy-sec-btn btn-sm" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}">
                            <i class="fa fa-eye"></i>
                        </button>
                        <!-- Edit -->
                        <button class="privacy-sec-btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <!-- Publish/Unpublish -->
                        <form action="{{ route('business.products.toggle', $product->id) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="privacy-sec-btn btn-sm">
                                {{ $product->status == 'Available' ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                        <!-- Delete -->
                        <button class="privacy-sec-btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewProductModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">View Product</h5></div>
                            <div class="modal-body">
                                <p><b>Name:</b> {{ $product->name }}</p>
                                <p><b>Category:</b> {{ $product->category }}</p>
                                <p><b>Price:</b> {{ $product->price }}</p>
                                <p><b>Quantity:</b> {{ $product->quantity }}</p>
                                <p><b>Unit:</b> {{ $product->unit }}</p>
                                <p><b>Status:</b> {{ $product->status }}</p>
                                <p><b>Total Value:</b> {{ $product->total_value }}</p>
                                <p><b>Image:</b><br>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" width="100">
                                    @else N/A @endif
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="privacy-sec-btn" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('business.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="modal-header"><h5 class="modal-title">Edit Product</h5></div>
                                <div class="modal-body">
                                    <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}" required>
                                    <input type="text" name="category" class="form-control mb-2" value="{{ $product->category }}" required>
                                    <input type="number" step="0.01" name="price" class="form-control mb-2" value="{{ $product->price }}" required>
                                    <input type="number" step="0.01" name="quantity" class="form-control mb-2" value="{{ $product->quantity }}" required>
                                    <input type="text" name="unit" class="form-control mb-2" value="{{ $product->unit }}" required>
                                    <select name="status" class="form-control mb-2" required>
                                        <option value="Available" @if($product->status=='Available') selected @endif>Available</option>
                                        <option value="Out of Stock" @if($product->status=='Out of Stock') selected @endif>Out of Stock</option>
                                        <option value="Unavailable" @if($product->status=='Unavailable') selected @endif>Unavailable</option>
                                    </select>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button class="privacy-sec-btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="privacy-sec-btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('business.products.destroy', $product->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <div class="modal-header"><h5 class="modal-title">Delete Product</h5></div>
                                <div class="modal-body">Are you sure you want to delete <b>{{ $product->name }}</b>?</div>
                                <div class="modal-footer">
                                    <button class="privacy-sec-btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="privacy-sec-btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('business.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header"><h5 class="modal-title">Create My Product</h5></div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required>
                    <input type="text" name="category" class="form-control mb-2" placeholder="Category" required>
                    <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required>
                    <input type="number" step="0.01" name="quantity" class="form-control mb-2" placeholder="Quantity" required>
                    <input type="text" name="unit" class="form-control mb-2" placeholder="Unit" required>
                    <select name="status" class="form-control mb-2" required>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="privacy-sec-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="privacy-sec-btn">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')
