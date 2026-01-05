@include('layouts.header')
@include('layouts.sidebar')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: Arial; background: #f5f7fa; margin: 0; padding: 0; }
.container { padding: 20px; margin-left: 300px; margin-top: 100px; width: 70%; }
h2 { color: #4f46e5; margin-bottom: 15px; }
.step-box { margin-bottom: 30px; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
select, input, textarea { padding: 8px; margin-top: 8px; border-radius: 5px; border: 1px solid #ccc; width: 100%; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th, td { padding: 10px; border-bottom: 1px solid #4f46e5; text-align: left; }
th { background: #f1f1f1; }
.btn { background: #4f46e5; color: #fff; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; margin-top:20px; }
.btn:hover { background: #4338ca; }
.modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); }
.modal-content { background: #fff; margin: 5% auto; padding: 20px; border-radius: 10px; width: 80%; max-width: 500px; box-shadow: 0 4px 8px rgba(0,0,0,0.3); text-align:center; }
.close { float: right; font-size: 22px; font-weight: bold; cursor: pointer; color: #333; }
.close:hover { color: red; }
.spinner { display: none; margin: 20px auto; border: 6px solid #f3f3f3; border-top: 6px solid #4f46e5; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; }
@keyframes spin { 100% { transform: rotate(360deg); } }
.highlight { background-color: #d1fae5 !important; transition: background-color 1.5s ease; }
</style>

<div class="container">
    <h2>Find a Mediator Near You</h2>

    <div class="step-box">
        <label>Select Location:</label>
        <select id="locationSelect">
            <option value="">-- Choose Location --</option>
            @foreach($locations as $loc)
                <option value="{{ $loc }}">{{ $loc }}</option>
            @endforeach
        </select>
    </div>

    <div id="loadingSpinner" class="spinner"></div>

    <div id="mediatorResults" class="step-box hidden">
        <h3>Available Mediators</h3>
        <table>
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="mediatorTableBody"></tbody>
        </table>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
        <h3>Request Sent</h3>
        <p>Your connection request was sent successfully.</p>
        <button class="btn" onclick="closeModal('successModal')">OK</button>
    </div>
</div>

<!-- Error Modal -->
<div id="errorModal" class="modal">
    <div class="modal-content">
        <i class="fas fa-times-circle text-3xl text-red-500 mb-2"></i>
        <h3>Request Failed</h3>
        <p>Something went wrong. Please try again later.</p>
        <button class="btn" onclick="closeModal('errorModal')">Close</button>
    </div>
</div>

<script>
const locationSelect = document.getElementById('locationSelect');
const tbody = document.getElementById('mediatorTableBody');
const resultsDiv = document.getElementById('mediatorResults');
const spinner = document.getElementById('loadingSpinner');

locationSelect.addEventListener('change', function() {
    const location = this.value;
    tbody.innerHTML = '';
    if(location) {
        spinner.style.display = 'block';
        fetch(`/client/mediators/search?location=${encodeURIComponent(location)}`)
            .then(res => res.json())
            .then(data => {
                spinner.style.display = 'none';
                resultsDiv.classList.remove('hidden');

                if(data.length) {
                    tbody.innerHTML = '';
                    data.forEach(m => {
                        tbody.innerHTML += `
                        <tr id="mediatorRow${m.source}-${m.id}">
                            <td>${m.fullname}</td>
                            <td>${m.phone}</td>
                            <td>${m.email}</td>
                            <td>${m.location}</td>
                            <td>${m.level}</td>
                            <td><button class="btn" onclick="connectMediator(${m.id}, '${m.source}')">Connect Now</button></td>
                        </tr>`;
                    });
                } else {
                    tbody.innerHTML = `<tr><td colspan="6" class="text-center">No mediators found in this location.</td></tr>`;
                }
            })
            .catch(err => {
                console.error(err);
                spinner.style.display = 'none';
                tbody.innerHTML = `<tr><td colspan="6" class="text-center">Error fetching mediators.</td></tr>`;
                resultsDiv.classList.remove('hidden');
            });
    } else {
        resultsDiv.classList.add('hidden');
    }
});

function connectMediator(mediatorId, source) {
    fetch("{{ route('client.mediators.connect') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ mediator_id: mediatorId, source: source })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            openModal('successModal');
            const row = document.getElementById(`mediatorRow${source}-${mediatorId}`);
            if(row) {
                row.classList.add('highlight');
                setTimeout(() => row.classList.remove('highlight'), 2000);
            }
        } else {
            openModal('errorModal');
        }
    })
    .catch(() => openModal('errorModal'));
}

function openModal(id) { document.getElementById(id).style.display = 'block'; }
function closeModal(id) { document.getElementById(id).style.display = 'none'; }
</script>

@include('layouts.footer')
