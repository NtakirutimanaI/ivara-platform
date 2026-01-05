@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')
<style>
/* Base Reset & Styling */
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background:#f9f9f9; color:#333; margin-top:40px; padding:0; }
.container { width: 80%; margin-left: 240px; max-width: 1200px; padding: 20px; }
h1 { text-align:center; margin-bottom: 20px; color:#071839; font-size:1.8rem; }

/* Form Styling */
form div { display:flex; flex-wrap:wrap; gap:10px; justify-content:center; margin-bottom:30px; }
form input, form button { padding:6px 10px; border-radius:5px; border:1px solid #ccc; font-size:13px; }
form button { background:#071839; color:#fff; cursor:pointer; transition:0.3s; }
form button:hover { background:#ffc107; color:#071839; }

/* Table Styling */
table { width:100%; border-collapse: collapse; margin-bottom:30px; font-size:13px; }
th, td { padding:8px; text-align:center; border-bottom:1px solid #ddd; }
th { background:#071839; color:#fff; font-size:13px; }
tr:hover { background:#f1f1f1; }
img { border-radius:5px; max-width:40px; }

/* Publish Button */
button.toggle { padding:4px 8px; border:none; border-radius:4px; cursor:pointer; transition:0.3s; font-size:12px; }
button.toggle.published { background:#924FC2; color:#fff; }
button.toggle.unpublished { background:#00C853; color:#fff; }
button.toggle.published:hover{ background:#00C853; color:#fff; }
button.toggle.unpublished:hover{ background:#ffb74d; color:#fff; }

/* Responsive */
@media(max-width:1200px){
    .container { width:90%; margin-left:150px; padding:15px; }
    h1 { font-size:1.6rem; }
    form input, form button { font-size:12px; padding:5px 8px; }
    table th, table td { font-size:12px; padding:6px; }
    img { max-width:35px; }
}
@media(max-width:992px){
    .container { width:85%; margin-left:100px; }
}
@media(max-width:768px){
    .container { width:95%; margin-left:0; padding:10px; }
    form div { flex-direction: column; align-items:center; }
    table th, table td { font-size:11px; padding:5px; }
    img { max-width:30px; }
}
@media(max-width:576px){
    h1 { font-size:1.4rem; }
    form input, form button { font-size:11px; padding:4px 6px; }
    table th, table td { font-size:10px; padding:4px; }
    img { max-width:25px; }
}
</style>

<div class="container">
    <h1>Manage Team</h1>

    @if(session('success'))
        <div style="color:green; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Team Member -->
    <form action="{{ route('manager.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="text" name="position" placeholder="Position" required>
            <input type="text" name="contact" placeholder="Contact">
            <input type="email" name="email" placeholder="Email">
            <input type="url" name="facebook" placeholder="Facebook URL">
            <input type="url" name="twitter" placeholder="Twitter URL">
            <input type="url" name="linkedin" placeholder="LinkedIn URL">
            <input type="url" name="instagram" placeholder="Instagram URL">
            <input type="file" name="image">
            <button type="submit">Add Member</button>
        </div>
    </form>

    <!-- Team Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Social</th>
                <th>Image</th>
                <th>Published</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($team as $member)
            <tr id="member-{{ $member->id }}">
                <td>{{ $member->id }}</td>
                <td>{{ $member->full_name }}</td>
                <td>{{ $member->position }}</td>
                <td>{{ $member->contact }}</td>
                <td>{{ $member->email }}</td>
                <td>
                    @if($member->facebook) <a href="{{ $member->facebook }}" target="_blank">FB</a> @endif
                    @if($member->twitter) <a href="{{ $member->twitter }}" target="_blank">TW</a> @endif
                    @if($member->linkedin) <a href="{{ $member->linkedin }}" target="_blank">LI</a> @endif
                    @if($member->instagram) <a href="{{ $member->instagram }}" target="_blank">IG</a> @endif
                </td>
                <td>@if($member->image) <img src="{{ asset('storage/'.$member->image) }}"> @endif</td>
                <td id="status-{{ $member->id }}">{{ $member->published ? 'Published' : 'Unpublished' }}</td>
                <td>
                    <button class="toggle {{ $member->published ? 'published' : 'unpublished' }}" onclick="togglePublish({{ $member->id }})">
                        {{ $member->published ? 'Unpublish' : 'Publish' }}
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function togglePublish(id){
    fetch(`/manager/team/toggle/${id}`, {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
            'Accept':'application/json'
        }
    })
    .then(res=>res.json())
    .then(data=>{
        let statusCell = document.getElementById('status-'+id);
        let btn = document.querySelector('#member-'+id+' button.toggle');
        if(data.status){
            statusCell.innerText = 'Published';
            btn.innerText = 'Unpublish';
            btn.classList.remove('unpublished'); 
            btn.classList.add('published');
        } else{
            statusCell.innerText = 'Unpublished';
            btn.innerText = 'Publish';
            btn.classList.remove('published'); 
            btn.classList.add('unpublished');
        }
    })
    .catch(err => console.error('Error:', err));
}
</script>
@include('layouts.footer')
