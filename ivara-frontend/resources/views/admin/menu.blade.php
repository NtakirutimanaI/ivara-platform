<div class="menu-builder-container">

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <h1 class="page-title">Menu & Page Builder</h1>

    <!-- CREATE MENU & PAGE FORM -->
    <form method="POST" action="{{ route('admin.menus.store') }}" class="menu-form">
        @csrf

        <!-- Menu Fields -->
        <input name="title" placeholder="Menu Title" required>
        <input name="icon" placeholder="Menu Icon (optional)">
        <input name="slug" placeholder="Slug (for URL)" required>

        <select name="parent_id">
            <option value="">-- Parent Menu --</option>
            @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->title }}</option>
            @endforeach
        </select>

        <input type="number" name="order" placeholder="Order" value="0">

        <label class="active-label">
            <input type="checkbox" name="is_active" value="1" checked>
            <span>Active</span>
        </label>

        <!-- Roles -->
        <label>Visible to Roles</label>
        <select name="roles[]" multiple>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <!-- Page Content -->
        <label>Page Content</label>
        <textarea name="content" id="content-editor" placeholder="Enter page content here..."></textarea>

        <button type="submit">Create Menu & Page</button>
    </form>

    <!-- Existing Menus Table -->
    <div class="menus-table-wrapper">
        <h2>Existing Menus</h2>
        <table class="menus-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Icon</th>
                    <th>Parent</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->title }}</td>
                    <td>{{ $menu->slug }}</td>
                    <td>{{ $menu->icon }}</td>
                    <td>{{ $menu->parent?->title ?? '-' }}</td>
                    <td>{{ $menu->order }}</td>
                    <td>{{ $menu->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ $menu->roles->pluck('name')->join(', ') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="edit-btn">Edit</a>
                        <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" class="delete-form" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content-editor');
    function confirmDelete() { return confirm('Are you sure you want to delete this menu?'); }
</script>

<style>
/* Container */
.menu-builder-container {
    width: 90%;
    max-width: 1200px;
    margin: 2rem auto;
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
    color: #1f2937;
}

/* Success Alert */
.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    padding: 0.75rem 1rem;
    margin-bottom: 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

/* Page Title */
.page-title {
    font-size: 2.25rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
}

/* Form Styles */
.menu-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    margin-bottom: 3rem;
}

.menu-form input,
.menu-form select,
.menu-form textarea {
    width: 100%;
    padding: 0.65rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    font-size: 1rem;
    transition: all 0.2s;
}

.menu-form input:focus,
.menu-form select:focus,
.menu-form textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
}

/* Checkbox Label */
.active-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

/* Submit Button */
.menu-form button {
    grid-column: 1 / -1;
    background-color: #3b82f6;
    color: white;
    padding: 0.85rem;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s;
}

.menu-form button:hover {
    background-color: #2563eb;
    box-shadow: 0 4px 10px rgba(59,130,246,0.3);
}

/* Table Wrapper */
.menus-table-wrapper {
    background-color: #ffffff;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    overflow-x: auto;
}

.menus-table-wrapper h2 {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

/* Table */
.menus-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
}

.menus-table th,
.menus-table td {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
    font-size: 0.95rem;
}

.menus-table th {
    background-color: #f3f4f6;
    font-weight: 600;
    color: #374151;
}

.menus-table tr:hover {
    background-color: #f9fafb;
    transition: background-color 0.2s;
}

/* Actions */
.actions {
    display: flex;
    gap: 0.5rem;
}

.edit-btn {
    color: #3b82f6;
    font-weight: 500;
    text-decoration: none;
}

.edit-btn:hover {
    text-decoration: underline;
}

.delete-btn {
    color: #ef4444;
    background: transparent;
    border: none;
    font-weight: 500;
    cursor: pointer;
}

.delete-btn:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 1024px) {
    .menu-builder-container { width: 95%; }
}

@media (max-width: 768px) {
    .menu-form { grid-template-columns: 1fr; }
    .menus-table { font-size: 0.875rem; }
    .page-title { font-size: 2rem; }
}
</style>
