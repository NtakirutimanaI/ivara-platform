@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')
@include('admin.fruits')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Roles & Permissions Management</title>
  <style>
    body, html {
      margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f9fafb; color: #333; height: 100vh; overflow-x: hidden;
    }
    .container {
      width: 80%;
      margin-left: 270px;
      margin-top: 60px;
      padding: 20px;
      box-sizing: border-box;
    }
    h1 { margin-bottom: 20px; color: #924FC2; }
    .flex-row {
      display: flex;
      gap: 20px;
      flex-wrap: nowrap;
      align-items: flex-start;
    }
    .card {
      background: white;
      border-radius: 8px;
      box-shadow: 0 1px 6px rgb(0 0 0 / 0.1);
      padding: 15px;
      flex: 0 0 30%;
      max-width: 30%;
      min-width: 250px;
      box-sizing: border-box;
    }
    .roles-list, .permissions-list {
      max-height: 300px;
      overflow-y: auto;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 5px;
    }
    .role-item, .permission-item {
      padding: 10px 15px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      transition: background 0.2s;
    }
    .role-item.active { background: #924FC2; color: white; font-weight: bold; }
    .permission-item label { margin-left: 10px; }
    .role-item:hover { background: #eef2ff; }

    label {
      font-weight: 600;
    }
    select, input[type="text"] {
      width: 100%;
      padding: 8px 12px;
      margin-top: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #924FC2;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s ease;
      margin-top: 10px;
    }
    button:hover { background-color: #924FC2; }

    .user-result-list {
      border: 1px solid #ccc;
      border-radius: 4px;
      max-height: 150px;
      overflow-y: auto;
      margin-top: 5px;
    }
    .user-result {
      padding: 10px 15px;
      border-bottom: 1px solid #eee;
      cursor: pointer;
      transition: background 0.2s;
    }
    .user-result:hover {
      background: #eef2ff;
    }
    .selected-users {
      margin-top: 10px;
    }
    .selected-users .user-item {
      background: #e0e7ff;
      margin-bottom: 4px;
      padding: 10px 15px;
      border-radius: 4px;
    }

    @media (max-width: 1200px) {
      .flex-row {
        flex-wrap: wrap;
      }
      .card {
        flex: 1 1 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Roles & Permissions</h1>
  <div class="flex-row">
    <!-- Roles Column -->
    <section class="card" aria-label="Roles">
      <h2>Roles</h2>
      <div class="roles-list" id="rolesList"></div>
      <div style="margin-top: 15px;">
        <input type="text" id="newRoleInput" placeholder="New role name" />
        <button id="addRoleBtn">Add Role</button>
      </div>
    </section>

    <!-- Permissions Column -->
    <section class="card" aria-label="Permissions">
      <h2>Permissions</h2>
      <div class="permissions-list" id="permissionsList"></div>
      <button id="savePermissionsBtn">Save Permissions</button>
    </section>

    <!-- User Selection Column -->
    <section class="card" aria-label="Users">
      <h2>Assign Users</h2>
      <label for="modelSelect">From:</label>
      <select id="modelSelect">
        <option value="users">Users</option>
        <option value="team">Team</option>
        <option value="technicians">Technicians</option>
      </select>

      <input type="text" id="userSearchInput" placeholder="Search full name" />
      <div class="user-result-list" id="userResults"></div>
      <div class="selected-users" id="selectedUsersList"></div>
      <button id="assignRoleBtn">Assign Role</button>
    </section>
  </div>
</div>

<script>
  // --- Roles & Permissions Logic ---
  const roles = [
    { id: 1, name: 'Admin', permissions: ['manage_users', 'edit_content', 'view_reports'] },
    { id: 2, name: 'Mentor', permissions: ['view_content', 'manage_lessons'] },
    { id: 3, name: 'Business Owner', permissions: ['create_campaigns', 'edit_profile'] },
  ];
  const permissions = [
    'manage_users', 'edit_content', 'view_reports',
    'view_content', 'manage_lessons', 'create_campaigns', 'edit_profile'
  ];
  let selectedRoleId = null;
  const rolesList = document.getElementById('rolesList');
  const permissionsList = document.getElementById('permissionsList');
  const newRoleInput = document.getElementById('newRoleInput');
  const addRoleBtn = document.getElementById('addRoleBtn');
  const savePermissionsBtn = document.getElementById('savePermissionsBtn');

  function renderRoles() {
    rolesList.innerHTML = '';
    roles.forEach(role => {
      const div = document.createElement('div');
      div.className = 'role-item' + (role.id === selectedRoleId ? ' active' : '');
      div.textContent = role.name;
      div.onclick = () => selectRole(role.id);
      rolesList.appendChild(div);
    });
  }

  function renderPermissions() {
    permissionsList.innerHTML = '';
    if (selectedRoleId === null) {
      permissionsList.innerHTML = '<p>Select a role to edit permissions.</p>';
      return;
    }
    const role = roles.find(r => r.id === selectedRoleId);
    permissions.forEach(permission => {
      const div = document.createElement('div');
      div.className = 'permission-item';
      const input = document.createElement('input');
      input.type = 'checkbox';
      input.checked = role.permissions.includes(permission);
      input.onchange = () => {
        if (input.checked) {
          if (!role.permissions.includes(permission)) role.permissions.push(permission);
        } else {
          role.permissions = role.permissions.filter(p => p !== permission);
        }
      };
      const label = document.createElement('label');
      label.textContent = permission;
      div.appendChild(input);
      div.appendChild(label);
      permissionsList.appendChild(div);
    });
  }

  function selectRole(roleId) {
    selectedRoleId = roleId;
    renderRoles();
    renderPermissions();
  }

  addRoleBtn.onclick = () => {
    const name = newRoleInput.value.trim();
    if (!name) return alert('Enter a role name');
    if (roles.some(r => r.name.toLowerCase() === name.toLowerCase())) {
      alert('Role already exists');
      return;
    }
    const newRole = {
      id: Math.max(...roles.map(r => r.id)) + 1,
      name,
      permissions: []
    };
    roles.push(newRole);
    newRoleInput.value = '';
    selectRole(newRole.id);
  };

  savePermissionsBtn.onclick = () => {
    if (selectedRoleId === null) return alert('Select a role first');
    const role = roles.find(r => r.id === selectedRoleId);
    alert(`Permissions for ${role.name} saved:\n${role.permissions.join(', ')}`);
  };

  if (roles.length) {
    selectRole(roles[0].id);
  }

  // --- User Assignment Logic ---
  const users = @json($users);
  const team = @json($team);
  const technicians = @json($technicians);

  const modelSelect = document.getElementById('modelSelect');
  const userSearchInput = document.getElementById('userSearchInput');
  const userResults = document.getElementById('userResults');
  const selectedUsersList = document.getElementById('selectedUsersList');
  const assignRoleBtn = document.getElementById('assignRoleBtn');

  const selectedUserIds = new Set();

  userSearchInput.oninput = () => {
    const term = userSearchInput.value.toLowerCase();
    userResults.innerHTML = '';
    if (!term) return;

    const dataset = { users, team, technicians }[modelSelect.value];

    dataset.filter(u => (u.full_name || u.name || "").toLowerCase().includes(term))
      .forEach(u => {
        const div = document.createElement('div');
        div.className = 'user-result';
        div.textContent = u.full_name || u.name;
        div.onclick = () => {
          if (!selectedUserIds.has(u.id)) {
            selectedUserIds.add(u.id);
            renderSelectedUsers();
          }
          userSearchInput.value = '';
          userResults.innerHTML = '';
        };
        userResults.appendChild(div);
      });
  };

  function renderSelectedUsers() {
    selectedUsersList.innerHTML = '';
    [...selectedUserIds].forEach(id => {
      const u = users.concat(team, technicians).find(x => x.id === id);
      if (!u) return;
      const div = document.createElement('div');
      div.className = 'user-item';
      div.textContent = u.full_name || u.name;
      selectedUsersList.appendChild(div);
    });
  }

  assignRoleBtn.onclick = () => {
    if (!selectedUserIds.size) return alert('Select at least one user');
    axios.post("{{ route('admin.users.assign_role') }}", {
      role_id: selectedRoleId,
      user_ids: Array.from(selectedUserIds)
    })
    .then(() => {
      alert('Role assigned');
      selectedUserIds.clear();
      renderSelectedUsers();
    })
    .catch(() => alert('Error assigning role'));
  };
</script>

</body>
</html>

@include('layouts.footer')
