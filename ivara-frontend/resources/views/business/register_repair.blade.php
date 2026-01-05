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
        font-size: 0.9rem;
        background: #2563eb;
        border: none;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
    }
    .privacy-sec-btn:hover {
        background: #1e40af;
    }
    @media (max-width: 1024px) {
        .privacy-sec-container { width: 95%; margin-left: auto; margin-right: auto; }
    }
</style>

<div class="privacy-sec-container">
    <h1 class="privacy-sec-title">Registered Items</h1>

    <!-- Register Material Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fa fa-plus"></i> Register Material
    </button>

    <div class="privacy-sec-auth-box">
        <h2>Business Registered Devices / Materials / Properties</h2>

        <!-- Page Size Selector -->
        <div class="mb-3">
            <label for="pageSize" class="form-label fw-bold">Show entries:</label>
            <select id="pageSize" class="form-select w-auto d-inline-block">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="15">15</option>
            </select>
        </div>

        <!-- Table -->
        <table class="table table-striped mt-3" id="itemsTable">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $index => $item)
                <tr>
                    <td class="row-number"></td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category ?? '-' }}</td>
                    <td>{{ $item->quantity ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $item->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item->id }}">View</button>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                    </td>
                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">View Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Type:</strong> {{ $item->type }}</p>
                                <p><strong>Name:</strong> {{ $item->name }}</p>
                                <p><strong>Category:</strong> {{ $item->category }}</p>
                                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                <p><strong>Status:</strong> {{ $item->status }}</p>
                                <p><strong>Description:</strong> {{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('business.register_repair.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title">Edit Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label>Type</label>
                                    <input type="text" name="type" class="form-control" placeholder="Enter item type" required>
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter item name" required>
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control" placeholder="Enter category">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" class="form-control" placeholder="Enter quantity">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('business.register_repair.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Delete Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{ $item->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No items registered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('business.register_repair.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Register Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control" placeholder="Enter item type" required>
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter item name" required>
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" placeholder="Enter category">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" placeholder="Enter quantity">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <label>Description</label>
                    <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("itemsTable").getElementsByTagName("tbody")[0];
    const rows = Array.from(table.getElementsByTagName("tr"));
    const pagination = document.getElementById("pagination");
    const pageSizeSelect = document.getElementById("pageSize");

    let currentPage = 1;
    let pageSize = parseInt(pageSizeSelect.value);

    function renderTable() {
        const totalRows = rows.length;
        const totalPages = Math.ceil(totalRows / pageSize);

        rows.forEach((row, index) => {
            row.style.display = "none";
            if (index >= (currentPage - 1) * pageSize && index < currentPage * pageSize) {
                row.style.display = "";
                row.querySelector(".row-number").innerText = index + 1; // continuous numbering
            }
        });

        pagination.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            let li = document.createElement("li");
            li.className = "page-item " + (i === currentPage ? "active" : "");
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener("click", (e) => {
                e.preventDefault();
                currentPage = i;
                renderTable();
            });
            pagination.appendChild(li);
        }
    }

    pageSizeSelect.addEventListener("change", function () {
        pageSize = parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>
@include('layouts.footer')
