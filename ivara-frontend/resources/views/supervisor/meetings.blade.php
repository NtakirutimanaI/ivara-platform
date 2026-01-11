@include('layouts.header')
@include('layouts.sidebar')
@include('supervisor.connect')

<style>
/* === GENERAL PAGE STYLING === */
body {
    font-family: 'Inter', sans-serif;
    background-color: #f4f6f8;
    margin: 0;
    padding: 0;
}

/* === MAIN CONTAINER === */
.container {
    display: flex;
    gap: 1.5rem;
    margin-left: 240px;
    margin-top: 80px;
    padding: 1rem;
    width: 78%;
    min-height: calc(80vh - 100px);
    box-sizing: border-box;
}

/* === COLUMNS === */
.left-column, .right-column {
    background-color: #ffffff;
    padding: 1rem;
    border-radius: 0.6rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    box-sizing: border-box;
}

.left-column { flex: 1; }
.right-column { flex: 2; overflow-x: auto; }

/* === HEADINGS === */
h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: #333; }
h2 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.75rem; color: #555; }

/* === FORM STYLING === */
form label { display: block; font-weight: 500; margin-bottom: 0.25rem; color: #333; }

form input, form textarea, form select {
    width: 100%;
    padding: 0.5rem;
    font-size: 0.9rem;
    border: 1px solid #d1d5db;
    border-radius: 0.4rem;
    margin-bottom: 0.75rem;
}

form textarea { resize: vertical; min-height: 80px; }

.link-buttons { display: flex; gap: 0.5rem; margin-bottom: 0.5rem; }

/* === BUTTONS === */
button {
    font-size: 0.85rem;
    font-weight: 500;
    border: none;
    border-radius: 0.4rem;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}
button:hover { opacity: 0.9; }


button.bg-blue-600 { background-color: #4f46e5; color: #fff; width:45px; }
button.bg-green-600 { background-color: #10b981; color: #fff; }
button.bg-yellow-600 { background-color: #924FC2; color: #fff; }
button.bg-red-600 { background-color: #ef4444; color: #fff; margin-top:13px; }
button.bg-gray-600 { background-color: #6b7280; color: #fff;margin-top:13px; }
button.bg-teal-600 { background-color: #14b8a6; color: #fff; }

/* Small action buttons in tables */
td.flex button {
    padding: 0.25rem 0.4rem;
    font-size: 0.7rem;
    border-radius: 0.3rem;
}

/* === TABLE STYLING === */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

th, td {
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}

thead { background-color: #f3f4f6; font-weight: 600; }
tbody tr:hover { background-color: #f9fafb; }

td.flex {
    display: flex;
    gap: 0.2rem;
    flex-wrap: nowrap;
    align-items: center;
}

/* === ALERT === */
.alert-success, .bg-green-100 {
    background-color: #d1fae5;
    color: #047857;
    padding: 0.5rem 0.75rem;
    border-radius: 0.4rem;
    margin-bottom: 1rem;
    font-size: 0.85rem;
}

/* === MODALS === */
.modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 50;
}
.modal.flex { display: flex; }

.modal-content {
    background-color: #fff;
    padding: 1rem;
    border-radius: 0.6rem;
    width: 20rem;
    max-width: 90%;
}

/* === RESPONSIVENESS === */
@media (max-width: 1024px) {
    .container { flex-direction: column; margin-left: 0; width: 100%; }
    td.flex { flex-wrap: wrap; gap: 0.25rem; }
}
</style>

<div class="container">
    <div class="left-column">
        <h2>Create Meeting</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/supervisor/meetings/create') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Time</label>
                    <input type="time" name="time" required>
                </div>
                <div>
                    <label>Link</label>
                    <div class="link-buttons">
                        <button type="button" class="bg-teal-600" onclick="generateGoogleMeet()">Google Meet</button>
                        <button type="button" class="bg-blue-600" onclick="generateZoom()">Zoom</button>
                    </div>
                    <input type="url" name="link" id="meetingLink" placeholder="https://..." required>
                </div>
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" placeholder="Optional"></textarea>
            </div>
            <div>
                <button type="submit" class="bg-blue-600">Create Meeting</button>
            </div>
        </form>
    </div>

    <div class="right-column">
        <h2>Meetings</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Link</th>
                    <th>Description</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meetings as $meeting)
                @php
                    $roles = is_string($meeting->roles) ? json_decode($meeting->roles, true) : $meeting->roles;
                @endphp
                <tr>
                    <td>{{ $meeting->id }}</td>
                    <td>{{ $meeting->time }}</td>
                    <td><a href="{{ $meeting->link }}" target="_blank" class="text-blue-600">Open Link</a></td>
                    <td>{{ $meeting->description }}</td>
                    <td>{{ $meeting->status == 'Unpublished' ? 'No role selected' : (is_array($roles) ? implode(', ', $roles) : '') }}</td>
                    <td class="flex">
                        <button onclick="openViewModal({{ $meeting->id }})" class="bg-green-600">View</button>
                        <button onclick="openEditModal({{ $meeting->id }})" class="bg-yellow-600">Edit</button>
                        <form action="{{ url('/supervisor/meetings/'.$meeting->id.'/delete') }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            <button type="submit" class="bg-red-600">Delete</button>
                        </form>
                        @if($meeting->status == 'Unpublished')
                        <button onclick="openPublishModal({{ $meeting->id }})" class="bg-blue-600">Pub</button>
                        @else
                        <form action="{{ url('/supervisor/meetings/'.$meeting->id.'/unpublish') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-600">Unpub</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modals --}}
<div id="viewModal" class="modal">
    <div class="modal-content">
        <h3>Meeting Details</h3>
        <div id="viewContent"></div>
        <button onclick="closeViewModal()" class="bg-gray-600 mt-2">Close</button>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Meeting</h3>
        <form id="editForm" method="POST">@csrf
            <div><label>Time</label><input type="time" name="time" id="editTime" required></div>
            <div><label>Link</label><input type="url" name="link" id="editLink" required></div>
            <div><label>Description</label><textarea name="description" id="editDescription"></textarea></div>
            <div class="mt-2 flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>

<div id="publishModal" class="modal">
    <div class="modal-content">
        <h3>Select Roles to Publish</h3>
        <form id="publishForm" method="POST">@csrf
            <select name="roles[]" id="publishRoles" multiple required>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="technician">Technician</option>
                <option value="mechanic">Mechanic</option>
                <option value="mediator">Mediator</option>
                <option value="client">Client</option>
                <option value="tailor">Tailor</option>
                <option value="businessperson">Businessperson</option>
                <option value="craftsperson">Craftsperson</option>
            </select>
            <div class="mt-2 flex justify-end gap-2">
                <button type="button" onclick="closePublishModal()" class="bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-600">Publish</button>
            </div>
        </form>
    </div>
</div>

@php
$meetingsForJS = $meetings->map(function($m){
    $mArray = $m->toArray();
    $mArray['roles'] = is_string($mArray['roles']) ? json_decode($mArray['roles'], true) : $mArray['roles'];
    return $mArray;
});
@endphp

<script>
const meetings = @json($meetingsForJS);

function openViewModal(id){
    const meeting = meetings.find(m => m.id === id);
    const roles = meeting.status === 'Unpublished' ? 'No role selected' : (meeting.roles ? meeting.roles.join(', ') : '');
    const content = `<p><strong>Time:</strong> ${meeting.time}</p>
                     <p><strong>Link:</strong> <a href="${meeting.link}" target="_blank">${meeting.link}</a></p>
                     <p><strong>Description:</strong> ${meeting.description}</p>
                     <p><strong>Roles:</strong> ${roles}</p>`;
    document.getElementById('viewContent').innerHTML = content;
    document.getElementById('viewModal').classList.add('flex');
}
function closeViewModal(){ document.getElementById('viewModal').classList.remove('flex'); }

function openEditModal(id){
    const meeting = meetings.find(m => m.id === id);
    document.getElementById('editTime').value = meeting.time;
    document.getElementById('editLink').value = meeting.link;
    document.getElementById('editDescription').value = meeting.description;
    document.getElementById('editForm').action = `/supervisor/meetings/${id}/update`;
    document.getElementById('editModal').classList.add('flex');
}
function closeEditModal(){ document.getElementById('editModal').classList.remove('flex'); }

function openPublishModal(id){
    document.getElementById('publishForm').action = `/supervisor/meetings/${id}/publish`;
    document.getElementById('publishModal').classList.add('flex');
}
function closePublishModal(){ document.getElementById('publishModal').classList.remove('flex'); }

function generateGoogleMeet(){
    document.getElementById('meetingLink').value = 'https://meet.google.com/new';
}

function generateZoom(){
    document.getElementById('meetingLink').value = 'https://zoom.us/start/videomeeting';
}
</script>

@include('layouts.footer')
