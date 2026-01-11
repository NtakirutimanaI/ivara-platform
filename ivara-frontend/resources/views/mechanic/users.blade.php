@include('layouts.header')
@include('layouts.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Customers</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="p-6 mx-auto bg-gray-50 min-h-screen" style="width: 80%; margin-left: 242px;">
    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow-md hover:shadow-lg transition-shadow rounded-xl p-5 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Total Customers</p>
                <h3 class="text-3xl font-bold text-green-600">5,423</h3>
            </div>
            <i class="fas fa-users text-4xl text-green-400"></i>
        </div>
        <div class="bg-white shadow-md hover:shadow-lg transition-shadow rounded-xl p-5 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Members</p>
                <h3 class="text-3xl font-bold text-green-600">1,893</h3>
            </div>
            <i class="fas fa-user-circle text-4xl text-green-400"></i>
        </div>
        <div class="bg-white shadow-md hover:shadow-lg transition-shadow rounded-xl p-5 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm mb-1">Active Now</p>
                <h3 class="text-3xl font-bold text-green-600">189</h3>
            </div>
            <i class="fas fa-signal text-4xl text-green-400"></i>
        </div>
    </div>
    <!-- User Table Card -->
    <div class="bg-white shadow-md rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('success') }}
            <button onclick="this.parentElement.style.display='none'" class="ml-2 font-bold">x</button>
        </div>
    @endif
    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-600 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('error') }}
            <button onclick="this.parentElement.style.display='none'" class="ml-2 font-bold">x</button>
        </div>
    @endif

            <h2 class="text-xl font-bold text-gray-800">All Customers</h2>
            <button onclick="document.getElementById('addUserModal').classList.remove('hidden')" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-lg transition">
                + Add Member
            </button>
        </div>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full text-sm text-left border-separate border-spacing-y-2">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="py-3 px-4">Name</th>
                        <th class="py-3 px-4">Username</th>
                        <th class="py-3 px-4">Phone</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Country</th>
                        <th class="py-3 px-4">Role</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                    <tr class="bg-white shadow-sm rounded-xl">
                        <td class="py-2 px-4 font-medium">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->username }}</td>
                        <td class="py-2 px-4">{{ $user->phone }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">{{ $user->country_code }}</td>
                        <td class="py-2 px-4 capitalize">{{ $user->role }}</td>
                        <td class="py-2 px-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $user->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                            <!-- Change Status Button -->
                            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Are you sure to change status?')" class="text-sm text-indigo-600 hover:underline">
                                    {{ $user->status == 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                        <td class="py-2 px-4">
                            <div class="flex space-x-2 text-xs">
                                <button onclick='openViewUser(@json($user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT))' class="text-blue-600 hover:underline">View</button>
                                <button onclick='openEditUser(@json($user, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT), "{{ route('admin.users.update', $user->id) }}")' class="text-[#924FC2] hover:underline">Edit</button>
                                <button onclick='openChangeRole("{{ route('admin.users.role', $user->id) }}", "{{ $user->getRoleNames()->first() }}")' class="text-purple-600 hover:underline">Change Role</button>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6 space-y-4">
        <h3 class="text-lg font-bold text-gray-800">Add New User</h3>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Full Name" required class="border border-gray-300 px-3 py-2 rounded-lg focus:ring focus:ring-green-200" />
                <input type="text" name="username" placeholder="Username" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="text" name="phone" placeholder="Phone" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="text" name="country_code" placeholder="Country Code" value="RW - 250" class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="email" name="email" placeholder="Email" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="password" name="password" placeholder="Password" required class="border border-gray-300 px-3 py-2 rounded-lg" />
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- View User Modal -->
<div id="viewUserModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-800">User Details</h3>
        <div class="space-y-2">
            <p><strong>Name:</strong> <span id="viewName"></span></p>
            <p><strong>Username:</strong> <span id="viewUsername"></span></p>
            <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
            <p><strong>Email:</strong> <span id="viewEmail"></span></p>
            <p><strong>Country:</strong> <span id="viewCountry"></span></p>
            <p><strong>Role:</strong> <span id="viewRole"></span></p>
            <p><strong>Status:</strong> <span id="viewStatus"></span></p>
        </div>
        <div class="mt-4 flex justify-end">
            <button onclick="document.getElementById('viewUserModal').classList.add('hidden')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6">
        <h3 class="text-lg font-bold text-gray-800">Edit User</h3>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <input type="text" id="editName" name="name" placeholder="Full Name" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="text" id="editUsername" name="username" placeholder="Username" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="text" id="editPhone" name="phone" placeholder="Phone" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="text" id="editCountry" name="country_code" placeholder="Country Code" class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="email" id="editEmail" name="email" placeholder="Email" required class="border border-gray-300 px-3 py-2 rounded-lg" />
                <input type="password" id="editPassword" name="password" placeholder="New Password (Optional)" class="border border-gray-300 px-3 py-2 rounded-lg" />
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('editUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-[#924FC2] hover:bg-[#7a3b9e] text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Change Role Modal -->
<div id="changeRoleModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Change User Role</h3>
        <form id="changeRoleForm" method="POST">
    @csrf
        <select name="role" id="roleSelect" class="w-full border border-gray-300 px-3 py-2 rounded-lg">
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="businessperson">BusinessPerson</option>
                <option value="technician">Technician</option>
                <option value="mechanic">Mechanic</option>
                <option value="tailor">Tailor</option>
                <option value="craftsperson">Craftsperson</option>
                <option value="mediator">Mediator</option>
                <option value="client">Client</option>
                <option value="staff">Staff</option>
            </select>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="hideChangeRoleModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
             <button onclick="showChangeRoleModal({{ $user->id }})" class="text-sm text-purple-600 hover:underline">
                 Change Role
             </button>

            </div>
        </form>
    </div>
</div>



</body>

<script>
    
 function showChangeRoleModal(userId) {
        const form = document.getElementById('changeRoleForm');
        form.action = `/admin/users/${userId}/change-role`; // Should match your route
        document.getElementById('changeRoleModal').classList.remove('hidden');
    }

    function hideChangeRoleModal() {
        document.getElementById('changeRoleModal').classList.add('hidden');
    }
    // View User Modal
    function openViewUser(user) {
        document.getElementById('viewName').textContent = user.name;
        document.getElementById('viewUsername').textContent = user.username;
        document.getElementById('viewPhone').textContent = user.phone;
        document.getElementById('viewEmail').textContent = user.email;
        document.getElementById('viewCountry').textContent = user.country_code;
        document.getElementById('viewRole').textContent = user.role;
        document.getElementById('viewStatus').textContent = user.status;
        document.getElementById('viewUserModal').classList.remove('hidden');
    }

    // Edit User Modal
    function openEditUser(user, actionUrl) {
        const form = document.getElementById('editUserForm');
        form.action = actionUrl;
        document.getElementById('editName').value = user.name;
        document.getElementById('editUsername').value = user.username;
        document.getElementById('editPhone').value = user.phone;
        document.getElementById('editCountry').value = user.country_code;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editPassword').value = '';
        document.getElementById('editUserModal').classList.remove('hidden');
    }

    // Change Role Modal
    function openChangeRole(actionUrl, currentRole) {
        const form = document.getElementById('changeRoleForm');
        form.action = actionUrl;
        document.getElementById('roleSelect').value = currentRole;
        document.getElementById('changeRoleModal').classList.remove('hidden');
    }
    function openChangeRole(actionUrl, currentRole) {
    const form = document.getElementById('changeRoleForm');
    form.action = actionUrl;
    document.getElementById('roleSelect').value = currentRole;
    document.getElementById('changeRoleModal').classList.remove('hidden');
}
</script>
</html>
