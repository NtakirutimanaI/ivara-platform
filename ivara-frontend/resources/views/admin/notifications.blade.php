@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Notifications List</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    margin: 0;
    padding: 0.5rem 1rem;
    color: #924FC2;
    margin-left: 250px;
    margin-right: 20px;
    margin-top: 80px;
  }
  h1 {
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 0.25rem;
  }
  .table-container {
    border-bottom: 1px solid #e0e0e0;
  }
  table {
    border-collapse: collapse;
    width: 100%;
    font-size: 0.8rem;
  }
  thead th {
    text-align: left;
    font-weight: 600;
    font-size: 0.75rem;
    padding: 6px 8px;
    color: #5f6368;
    border-bottom: 1px solid #dadce0;
  }
  tbody td {
    padding: 6px 8px;
    font-size: 0.75rem;
    color: #202124;
    vertical-align: middle;
    max-width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-bottom: 1px solid #f1f3f4;
    transition: background-color 0.15s ease-in-out;
  }
  tbody td:hover {
    background-color: #f5f5f5;
  }
  tbody td[data-label="Message"] {
    white-space: normal;
    max-width: 200px;
  }
  .btn {
    padding: 3px 6px;
    font-size: 0.7rem;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  .btn-reply {
    background-color: #924FC2;
    color: white;
  }
  .btn-delete {
    background-color: #f44336;
    color: white;
  }
  .btn-reply:hover {
    background-color: #924FC2;
  }
  .btn-delete:hover {
    background-color: #e53935;
  }
  .reply-form {
    display: none;
    margin-top: 5px;
  }
  .reply-form textarea {
    width: 100%;
    padding: 5px;
    font-size: 0.75rem;
    margin-bottom: 5px;
  }
  @media (max-width: 768px) {
    body {
      width: 100%;
      margin-left: 0;
      padding: 0.5rem;
    }
    table, thead, tbody, th, td, tr {
      display: block;
    }
    thead tr {
      display: none;
    }
    tbody tr {
      margin-bottom: 0.5rem;
    }
    tbody td {
      display: flex;
      justify-content: space-between;
      padding: 4px 6px;
      white-space: normal;
      max-width: none;
    }
    tbody td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #5f6368;
      flex: 1;
      padding-right: 5px;
      font-size: 0.75rem;
    }
  }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Notifications List</h1>

<div id="alert" style="display:none; margin-bottom: 10px; font-size:0.85rem;"></div>

<!-- Mark All as Read Button -->
<button id="markAllBtn" class="btn btn-mark" style="margin-bottom: 10px;">Mark All as Read</button>

<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Type</th>
        <th>Message</th>
        <th>User</th>
        <th>Related</th>
        <th>Read</th>
        <th>Sent At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($notifications as $index => $notification)
        <tr id="notification-{{ $notification->id }}">
          <td data-label="#">{{ $index + 1 }}</td>
          <td data-label="Type">{{ $notification->type }}</td>
          <td data-label="Message">{{ Str::limit($notification->message, 80) }}</td>
          <td data-label="User">{{ $notification->user ? $notification->user->email : '-' }}</td>
          <td data-label="Related">{{ $notification->related_type ? $notification->related_type . ' #' . $notification->related_id : '-' }}</td>
          <td data-label="Read" class="read-status">{{ $notification->is_read ? 'Yes' : 'No' }}</td>
          <td data-label="Sent At">{{ $notification->sent_at ? $notification->sent_at->format('Y-m-d H:i') : '-' }}</td>
          <td data-label="Actions">
            <button class="btn btn-mark mark-single-btn" data-id="{{ $notification->id }}">
              {{ $notification->is_read ? 'Unread' : 'Mark Read' }}
            </button>
            <button class="btn btn-delete delete-btn" data-id="{{ $notification->id }}">Delete</button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" style="text-align:center; padding: 1rem; color: #6b7280;">No notifications found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });

    // MARK ALL AS READ
    $('#markAllBtn').click(function() {
        $.post("{{ route('notifications.markAllRead') }}", {}, function(data) {
            $('#alert').text(data.message || 'All notifications marked as read').css('color','green').show().fadeOut(3000);
            $('td.read-status').text('Yes');
            $('.mark-single-btn').text('Unread');
        });
    });

    // MARK SINGLE AS READ
    $('.mark-single-btn').click(function() {
        let id = $(this).data('id');
        let btn = $(this);
        $.post('/admin/notifications/' + id + '/mark-read', {}, function(data) {
            $('#alert').text(data.message || 'Notification marked as read').css('color','green').show().fadeOut(3000);
            $('#notification-' + id + ' .read-status').text('Yes');
            btn.text('Unread');
        });
    });

    // DELETE NOTIFICATION
    $('.delete-btn').click(function() {
        if (!confirm('Are you sure?')) return;
        let id = $(this).data('id');
        $.ajax({
            url: '/admin/notifications/' + id,
            type: 'DELETE',
            success: function(data) {
                $('#alert').text(data.message || 'Notification deleted').css('color','green').show().fadeOut(3000);
                $('#notification-' + id).remove();
            }
        });
    });
});
</script>

</body>
</html>

@include('layouts.footer')
