@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Google Font & Bootstrap (for pagination if needed) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f5f7fa;
    color: #333;
    font-size: 14px;
}
.page-container {
    width: 80%;
    margin-left: 240px;
    margin-top: 100px;
    max-width: 1400px;
}
.page-container h2 {
    font-size: 16px;
}
input, select, button {
    font-size: 12px;
    padding: 0.25rem 0.5rem;
}
table th, table td {
    padding: 0.25rem 0.5rem;
    word-break: break-word;
}
@media (max-width: 1024px) {
    .page-container {
        margin-left: 0;
        width: 95%;
    }
}
@media (max-width: 640px) {
    .page-container {
        width: 100%;
        padding: 5px;
    }
    table {
        font-size: 11px;
    }
    input, select, button {
        font-size: 10px;
    }
}
</style>

<div class="page-container">
    <h1 class="text-3xl font-bold mb-6">Manager Dashboard</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    {{-- ===== BOOKINGS ===== --}}
    <h2 class="text-2xl font-semibold mb-3">Bookings</h2>
    <table class="table-auto w-full mb-6 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th>ID</th><th>Client</th><th>Service</th><th>Technician</th><th>Status</th><th>Date</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bookings as $b)
            <tr class="border-b">
                <td>{{ $b->id }}</td>
                <td>{{ $b->client->name ?? 'N/A' }}</td>
                <td>{{ $b->service->title ?? 'N/A' }}</td>
                <td>{{ $b->technician->name ?? '-' }}</td>
                <td>{{ $b->status }}</td>
                <td>{{ $b->preferred_date }}</td>
                <td class="flex flex-wrap gap-2">
                    {{-- Assign Technician --}}
                    <form method="POST" action="{{ route('manager.bookings.assign') }}">
                        @csrf
                        <select name="technician_id" class="border rounded">
                            @foreach($technicians as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="booking_id" value="{{ $b->id }}">
                        <button class="bg-blue-500 text-white px-2 rounded">Assign</button>
                    </form>
                    {{-- Update Status --}}
                    <form method="POST" action="{{ route('manager.bookings.updateStatus') }}">
                        @csrf
                        <select name="status" class="border rounded">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                        <input type="hidden" name="booking_id" value="{{ $b->id }}">
                        <button class="bg-green-500 text-white px-2 rounded">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- ===== PRODUCTS/SERVICES ===== --}}
    <h2 class="text-2xl font-semibold mb-3">Products & Services</h2>
    <button onclick="openModal('addProduct')" class="bg-blue-600 text-white px-3 py-1 rounded mb-2">Add Product/Service</button>
    <table class="table-auto w-full mb-6 border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th>ID</th><th>Title</th><th>Type</th><th>Price</th><th>Status</th><th>Published</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($productsServices as $p)
            <tr class="border-b">
                <td>{{ $p->id }}</td>
                <td>{{ $p->title }}</td>
                <td>{{ $p->type }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->status }}</td>
                <td>{{ $p->published ? 'Yes' : 'No' }}</td>
                <td class="flex flex-wrap gap-2">
                    {{-- Publish/Unpublish --}}
                    <form method="POST" action="{{ route('manager.productsServices.publish') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $p->id }}">
                        <button class="bg-blue-500 text-white px-2 rounded">{{ $p->published ? 'Unpublish' : 'Publish' }}</button>
                    </form>
                    {{-- Edit Modal --}}
                    <button onclick="openEditModal({{ $p->id }}, '{{ $p->title }}','{{ $p->type }}','{{ $p->price }}','{{ $p->description }}','{{ $p->status }}')" class="bg-yellow-500 text-white px-2 rounded">Edit</button>
                    {{-- Delete --}}
                    <form method="POST" action="{{ route('manager.productsServices.delete') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $p->id }}">
                        <button class="bg-red-500 text-white px-2 rounded">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- ===== CLIENT SERVICES ===== --}}
    <h2 class="text-2xl font-semibold mb-3">Client Services</h2>
    <table class="table-auto w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th>ID</th><th>Client</th><th>Service</th><th>Status</th><th>Assigned</th><th>Completed</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clientServices as $cs)
            <tr class="border-b">
                <td>{{ $cs->id }}</td>
                <td>{{ $cs->client->name ?? 'N/A' }}</td>
                <td>{{ $cs->service->title ?? 'N/A' }}</td>
                <td>{{ $cs->status }}</td>
                <td>{{ $cs->assigned_at }}</td>
                <td>{{ $cs->completed_at }}</td>
                <td>
                    <form method="POST" action="{{ route('manager.clientServices.updateStatus') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $cs->id }}">
                        <select name="status" class="border rounded">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="canceled">Canceled</option>
                        </select>
                        <button class="bg-green-500 text-white px-2 rounded">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- ===== MODALS ===== --}}
    <div id="addProduct" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-4 rounded w-96">
            <h3 class="text-lg font-bold mb-2">Add Product/Service</h3>
            <form method="POST" action="{{ route('manager.productsServices.store') }}">
                @csrf
                <input type="text" name="title" placeholder="Title" class="w-full mb-2 p-1 border rounded">
                <select name="type" class="w-full mb-2 p-1 border rounded">
                    <option value="product">Product</option>
                    <option value="service">Service</option>
                </select>
                <input type="text" name="price" placeholder="Price" class="w-full mb-2 p-1 border rounded">
                <textarea name="description" placeholder="Description" class="w-full mb-2 p-1 border rounded"></textarea>
                
                {{-- NEW: Client Selection --}}
                <select name="client_id" class="w-full mb-2 p-1 border rounded">
                    <option value="">Select Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>

                <button class="bg-blue-600 text-white px-3 py-1 rounded">Add</button>
                <button type="button" onclick="closeModal('addProduct')" class="ml-2 bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
            </form>
        </div>
    </div>

    <div id="editProduct" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-4 rounded w-96">
            <h3 class="text-lg font-bold mb-2">Edit Product/Service</h3>
            <form method="POST" action="{{ route('manager.productsServices.update') }}">
                @csrf
                <input type="hidden" name="id" id="edit_id">
                <input type="text" name="title" id="edit_title" class="w-full mb-2 p-1 border rounded">
                <select name="type" id="edit_type" class="w-full mb-2 p-1 border rounded">
                    <option value="product">Product</option>
                    <option value="service">Service</option>
                </select>
                <input type="text" name="price" id="edit_price" class="w-full mb-2 p-1 border rounded">
                <textarea name="description" id="edit_description" class="w-full mb-2 p-1 border rounded"></textarea>
                <select name="status" id="edit_status" class="w-full mb-2 p-1 border rounded">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                <button class="bg-green-500 text-white px-3 py-1 rounded">Update</button>
                <button type="button" onclick="closeModal('editProduct')" class="ml-2 bg-gray-500 text-white px-3 py-1 rounded">Cancel</button>
            </form>
        </div>
    </div>

</div>

{{-- ===== SCRIPTS ===== --}}
<script>
function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

function openEditModal(id,title,type,price,desc,status){
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_description').value = desc;
    document.getElementById('edit_status').value = status;
    openModal('editProduct');
}
</script>

@include('layouts.footer')
