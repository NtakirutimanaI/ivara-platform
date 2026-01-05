@include('layouts.header')
@include('layouts.sidebar')
@include('client.connect')
@include('client.fruits')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Table - Mini View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .container {
            width: 80%;
            margin-left: 240px;
            font-size:12px;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .add-button {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 15px;
            float: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f8f9fa;
            color: #333;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .view-btn { color: #4f46e5; }
        .edit-btn { color: orange; }
        .delete-btn { color: red; }

        .action-header {
            text-align: center;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Clients Table</h2>

        <div class="clearfix">
            <a href="#" class="add-button" data-bs-toggle="modal" data-bs-target="#addClientModal">+ Add</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th class="action-header">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email }}</td>
                        <td class="action-buttons">
                            <a class="view-btn" data-bs-toggle="modal" data-bs-target="#viewModal{{ $client->id }}">View</a>
                            <a class="edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $client->id }}">Edit</a>
                            <a class="delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $client->id }}">Delete</a>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $client->id }}" tabindex="-1" aria-labelledby="viewLabel{{ $client->id }}" aria-hidden="true">
                        <div class="modal-dialog"><div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewLabel{{ $client->id }}">View Client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> {{ $client->name }}</p>
                                <p><strong>Email:</strong> {{ $client->email }}</p>
                                <p><strong>Phone:</strong> {{ $client->phone }}</p>
                                <p><strong>Address:</strong> {{ $client->address }}</p>
                                <p><strong>City:</strong> {{ $client->city }}</p>
                                <p><strong>Country:</strong> {{ $client->country }}</p>
                            </div>
                        </div></div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $client->id }}" tabindex="-1" aria-labelledby="editLabel{{ $client->id }}" aria-hidden="true">
                        <div class="modal-dialog"><div class="modal-content">
                            <form method="POST" action="{{ route('clients.update', $client->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLabel{{ $client->id }}">Edit Client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ $client->name }}" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $client->email }}" class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ $client->phone }}" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div></div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $client->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $client->id }}" aria-hidden="true">
                        <div class="modal-dialog"><div class="modal-content">
                            <form method="POST" action="{{ route('clients.destroy', $client->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteLabel{{ $client->id }}">Delete Client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete <strong>{{ $client->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div></div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientLabel" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content">
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientLabel">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Client</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div></div>
    </div>

</body>
</html>
@include('layouts.footer')
