@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technicians</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Modal Styles */
        .technician-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .technician-modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 5px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .technician-close {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .technician-input, .technician-select {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .technician-modal-btn {
            background-color: #924FC2;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .technician-modal-btn:hover {
            background-color: #924FC2;
        }

        /* Base Styling */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            font-size: 14px;
        }

        .technician-container {
            width: 80%;
            margin-left: 270px;
            padding: 15px;
            margin-top: 40px;
        }

        .technician-title {
            text-align: center;
            color: #333;
            margin: 20px 0;
            font-size: 20px;
        }

        .technician-add-button {
            display: inline-block;
            background-color: #924FC2;
            color: #fff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            float: right;
            margin-bottom: 10px;
        }

        .technician-clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .technician-table-wrapper {
            overflow-x: auto;
        }

        .technician-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            font-size: 13px;
        }

        .technician-table th, .technician-table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .technician-table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .technician-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .technician-actions a {
            margin-right: 5px;
            text-decoration: none;
            font-size: 12px;
        }

        .technician-view-btn {
            color: #924FC2;
        }

        .technician-edit-btn {
            color: #fd7e14;
        }

        .technician-delete-btn {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .technician-add-button {
                float: none;
                display: block;
                width: 100%;
                text-align: center;
                margin-bottom: 15px;
            }

            .technician-title {
                font-size: 18px;
            }

            .technician-table th, .technician-table td {
                padding: 6px 8px;
            }

            .technician-container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="technician-container">
    <h2 class="technician-title">Technicians Table</h2>

    <div class="technician-clearfix">
        <a href="#" class="technician-add-button" onclick="openModal('addModal')">+ Add</a>
    </div>

    <div class="technician-table-wrapper">
        <table class="technician-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Expertise</th>
                <th>Status</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 1; @endphp
            @foreach ($technicians as $technician)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $technician->name }}</td>
                    <td>{{ $technician->email }}</td>
                    <td>{{ $technician->phone }}</td>
                    <td>{{ $technician->expertise }}</td>
                    <td>{{ ucfirst($technician->status) }}</td>
                    <td>{{ $technician->location }}</td>
                    <td class="technician-actions">
                        <a href="#" class="technician-view-btn" onclick="openModal('viewModal-{{ $technician->id }}')">View</a>
                        <a href="#" class="technician-edit-btn" onclick="openModal('editModal-{{ $technician->id }}')">Edit</a>
                        <a href="#" class="technician-delete-btn" onclick="openModal('deleteModal-{{ $technician->id }}')">Delete</a>
                    </td>
                </tr>

                <!-- View Modal -->
                <div id="viewModal-{{ $technician->id }}" class="technician-modal">
                    <div class="technician-modal-content">
                        <span class="technician-close" onclick="closeModal('viewModal-{{ $technician->id }}')">&times;</span>
                        <h3>View Technician</h3>
                        <p><strong>Name:</strong> {{ $technician->name }}</p>
                        <p><strong>Email:</strong> {{ $technician->email }}</p>
                        <p><strong>Phone:</strong> {{ $technician->phone }}</p>
                        <p><strong>Expertise:</strong> {{ $technician->expertise }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($technician->status) }}</p>
                        <p><strong>Location:</strong> {{ $technician->location }}</p>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div id="editModal-{{ $technician->id }}" class="technician-modal">
                    <div class="technician-modal-content">
                        <span class="technician-close" onclick="closeModal('editModal-{{ $technician->id }}')">&times;</span>
                        <h3>Edit Technician</h3>
                        <form action="{{ route('technicians.update', $technician->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" class="technician-input" value="{{ $technician->name }}" required>
                            <input type="email" name="email" class="technician-input" value="{{ $technician->email }}" required>
                            <input type="text" name="phone" class="technician-input" value="{{ $technician->phone }}">
                            <input type="text" name="expertise" class="technician-input" value="{{ $technician->expertise }}">
                            <input type="text" name="location" class="technician-input" value="{{ $technician->location }}">
                            <select name="status" class="technician-select">
                                <option value="active" {{ $technician->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $technician->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <button type="submit" class="technician-modal-btn">Update</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div id="deleteModal-{{ $technician->id }}" class="technician-modal">
                    <div class="technician-modal-content">
                        <span class="technician-close" onclick="closeModal('deleteModal-{{ $technician->id }}')">&times;</span>
                        <h3>Confirm Delete</h3>
                        <p>Are you sure you want to delete {{ $technician->name }}?</p>
                        <form action="{{ route('technicians.destroy', $technician->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="technician-modal-btn">Yes, Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="technician-modal">
    <div class="technician-modal-content">
        <span class="technician-close" onclick="closeModal('addModal')">&times;</span>
        <h3>Add Technician</h3>
        <form action="{{ route('technicians.store') }}" method="POST">
            @csrf
            <input type="text" name="name" class="technician-input" placeholder="Name" required>
            <input type="email" name="email" class="technician-input" placeholder="Email" required>
            <input type="text" name="phone" class="technician-input" placeholder="Phone">
            <input type="text" name="expertise" class="technician-input" placeholder="Expertise">
            <input type="text" name="location" class="technician-input" placeholder="Location">
            <select name="status" class="technician-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <button type="submit" class="technician-modal-btn">Add Technician</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'block';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('technician-modal')) {
            event.target.style.display = "none";
        }
    }
</script>
</body>
</html>
@include('layouts.footer')
