{{-- Partial Table View for AJAX --}}
<div id="userTableContainer">
    <table class="premium-table">
        <thead>
            <tr>
                <th width="40"><input type="checkbox" id="selectAll"></th>
                <th>User Profile</th>
                <th>System Role</th>
                <th>Contact Info</th>
                <th>Status</th>
                <th>Joined Date</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><input type="checkbox" class="user-checkbox" value="{{ $user->id }}"></td>
                <td>
                    <div class="user-profile-cell">
                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <div class="user-meta">
                            <span class="name">{{ $user->name }}</span>
                            <span class="username">@ {{ $user->username }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="role-badge {{ strtolower($role->name) }}">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <div class="contact-info">
                        <span class="email"><i class="far fa-envelope"></i> {{ $user->email }}</span>
                        <span class="phone"><i class="fas fa-mobile-alt"></i> {{ $user->phone ?? 'No phone' }}</span>
                    </div>
                </td>
                <td>
                    <span class="status-indicator {{ $user->status == 'active' ? 'active' : 'inactive' }}">
                        {{ ucfirst($user->status ?? 'inactive') }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td class="text-right">
                    <div class="dropdown-actions">
                        <button class="btn-icon" type="button">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div id="dropdown-{{ $user->id }}" class="dropdown-menu">
                            <button onclick="openViewModal({{ $user->id }})"><i class="far fa-eye"></i> View Profile</button>
                            <button onclick="openEditModal({{ $user->id }})"><i class="far fa-edit"></i> Edit User</button>
                            <button onclick="openResetModal({{ $user->id }})"><i class="fas fa-key"></i> Reset Password</button>
                            <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" onsubmit="return ajaxSubmit(event, this)">
                                @csrf
                                <button type="submit"><i class="fas fa-sync-alt"></i> Toggle Access</button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form" onsubmit="return ajaxSubmit(event, this)">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-danger"><i class="far fa-trash-alt"></i> Delete User</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
