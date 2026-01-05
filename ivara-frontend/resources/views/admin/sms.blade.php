@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')
@include('admin.fruits')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>SMS Contacts List</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    margin: 0;
    padding: 0.5rem 1rem;
    color: #924FC2;
    width: 80%;
    margin-left: 240px;
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
  /* Responsive small screen */
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
</head>
<body>

<h1 style="text-align:center;">SMS Contacts (Website Contact Forms)</h1>

@if(session('success'))
<div style="color: green; font-size: 0.85rem; margin-bottom: 10px;">
    {{ session('success') }}
</div>
@endif

<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($contacts as $index => $contact)
        <tr>
          <td data-label="#">{{ $contacts->firstItem() + $index }}</td>
          <td data-label="Email">{{ $contact->email }}</td>
          <td data-label="Phone">{{ $contact->phone ?? '-' }}</td>
          <td data-label="Subject">{{ $contact->subject }}</td>
          <td data-label="Message">{{ Str::limit($contact->message, 80) }}</td>
          <td data-label="Created At">{{ $contact->created_at ? $contact->created_at->format('Y-m-d H:i') : '-' }}</td>
          <td data-label="Actions">
            <button type="button" class="btn btn-reply" onclick="toggleReplyForm({{ $contact->id }})">Reply</button>
            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</button>
            </form>
          </td>
        </tr>
        <tr id="reply-form-{{ $contact->id }}" class="reply-form">
          <td colspan="7">
            <form action="{{ route('contacts.sendReply', $contact->id) }}" method="POST">
              @csrf
              <textarea name="reply_message" rows="3" placeholder="Type your reply here..." required></textarea>
              <br>
              <button type="submit" class="btn btn-reply">Send Reply</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" style="text-align:center; padding: 1rem; color: #6b7280;">No contacts found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<script>
function toggleReplyForm(id) {
    var formRow = document.getElementById('reply-form-' + id);
    formRow.style.display = (formRow.style.display === 'table-row') ? 'none' : 'table-row';
}
</script>

</body>
</html>
@include('layouts.footer')
