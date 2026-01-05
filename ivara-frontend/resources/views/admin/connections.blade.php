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
    width: 80%;
    margin-left: 240px;
    margin-top: 40px;
    padding: 15px;
}
h2 {
    text-align: center;
    font-size: 2rem;
    color: #4f46e5;
    margin-bottom: 20px;
}
.search-container {
    margin-bottom: 15px;
}
.search-container input {
    width: 100%;
    padding: 8px 10px;
    border: none;
    border-bottom: 1px solid #924FC2;
    outline: none;
    font-size: 0.9rem;
}

table {
    width: 100%;
    margin-top: 10px;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    font-size: 0.85rem;
}
th, td {
    padding: 6px 8px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #924FC2;
}
th {
    background: #f5f5f5;
    color: #4f46e5;
    font-weight: bold;
    font-size: 0.8rem;
}
tr:nth-child(even) {
    background: #fafafa;
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
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.actions .edit { background: #4f46e5; color: #fff; width:60px; height:26px; }
.actions .edit:hover { background: #4caf50; }
.actions .delete { background: #e53935; color: #fff; width:70px; height:25px; }
.actions .delete:hover { background: #e53935; color: #4f46e5; }
.actions .approve { background: #4caf50; color: #fff; }
.actions .approve:hover { background: #00C853; color: #fff; }
/* Mediator Button */
#addMediatorBtn {
    padding: 10px 20px;
    background:  #4f46e5;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
#addMediatorBtn:hover { background: linear-gradient(135deg, #4f46e5, #0d2557); color: #fff; transform: translateY(-2px); }
#addMediatorBtn:active { transform: translateY(0); }
/* Modal */
.modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; }
.modal-content { background: #fff; padding: 20px; border-radius: 12px; width: 90%; max-width: 500px; position: relative; }
.close { position: absolute; right: 10px; top: 10px; font-size: 1.2rem; cursor: pointer; }
@media(max-width:1024px){
    .container { width: 80%; margin-left: 0; padding: 10px; }
    .actions button { width: 100%; margin-bottom: 8px; font-size: 0.8rem; padding: 6px 10px; }
    th, td { font-size: 0.75rem; padding: 4px 6px; }
}
</style>

<div class="container">
    <h2>Mediators Management</h2>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search Mediators...">
    </div>

    <div class="mb-4">
        <button id="addMediatorBtn" class="product-form-button">Add Mediator</button>
    </div>

    <table id="mediatorTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Level</th>
                <th>Total Clients</th>
                <th>Total Transactions</th>
                <th>Status</th>
                <th>Approved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mediators as $index => $mediator)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mediator->fullname }}</td>
                <td>{{ $mediator->email }}</td>
                <td>{{ $mediator->phone }}</td>
                <td>{{ $mediator->location }}</td>
                <td>{{ ucfirst($mediator->level) }}</td>
                <td>{{ $mediator->total_clients }}</td>
                <td>{{ $mediator->total_transactions }}</td>
                <td>{{ $mediator->status }}</td>
                <td>{{ $mediator->approved_by_admin ? 'Yes' : 'No' }}</td>
                <td class="actions">
                    <button class="edit" data-id="{{ $mediator->id }}">Edit</button>
                    <button class="delete" data-id="{{ $mediator->id }}">Delete</button>
                    @if(!$mediator->approved_by_admin)
                    <form action="{{ route('admin.mediators.approve', $mediator->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="approve">Approve</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination Links --}}
    <div class="mt-3">
        {{ $mediators->links() }}
    </div>
</div>

<div id="addMediatorModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeAddModal">&times;</span>
        <h3>Add New Mediator</h3>
        <form action="{{ route('admin.mediators.store') }}" method="POST" class="product-form">
            @csrf
            <label>Full Name</label>
            <input type="text" name="fullname" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Phone</label>
            <input type="text" name="phone" required>
            <label>Location</label>
            <input type="text" name="location" required>
            <label>Level</label>
            <select name="level">
                <option value="basic">Basic</option>
                <option value="advanced">Advanced</option>
                <option value="premium">Premium</option>
            </select>
            <button type="submit">Add Mediator</button>
        </form>
    </div>
</div>

<script>
    // Modal
    const addBtn = document.getElementById('addMediatorBtn');
    const addModal = document.getElementById('addMediatorModal');
    const closeAddModal = document.getElementById('closeAddModal');
    addBtn.onclick = () => addModal.style.display = 'flex';
    closeAddModal.onclick = () => addModal.style.display = 'none';
    window.onclick = (e) => { if(e.target == addModal) addModal.style.display = 'none'; }

    // Edit/Delete
    document.querySelectorAll('.edit').forEach(btn => {
        btn.addEventListener('click', () => alert('Edit mediator ID: ' + btn.dataset.id));
    });
    document.querySelectorAll('.delete').forEach(btn => {
        btn.addEventListener('click', () => {
            if(confirm('Delete mediator ID: ' + btn.dataset.id + '?')) {
                window.location.href = '/admin/mediators/delete/' + btn.dataset.id;
            }
        });
    });

    // Search Functionality
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#mediatorTable tbody tr');
        rows.forEach(row => {
            let match = false;
            row.querySelectorAll('td').forEach(td => {
                if(td.textContent.toLowerCase().includes(filter)) match = true;
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>

@include('layouts.footer')
