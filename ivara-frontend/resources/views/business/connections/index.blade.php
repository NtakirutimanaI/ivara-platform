@include('layouts.header')
@include('layouts.sidebar')
@include('business.connect')

<!-- Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7fa;
        color: #333;
    }

    .container {
        width: 80%;
        margin-left: 270px; /* space for sidebar */
        margin-top: 50px;
        padding: 20px;
    }

    h2 {
        font-weight: 600;
        color: #4f46e5;
    }

    .form-select {
        border-radius: 8px;
        width: 300px;
        padding: 10px;
        font-size: 0.95rem;
    }

    .btn-primary {
        background-color: #4f46e5;
        color: #fff;
        border: none;
        font-weight: 500;
        padding: 8px 20px;
        border-radius: 8px;
        display: flex;
        margin-top: 20px;
        width: 150px;
        align-items: center;
        justify-content: center;
    }

    .btn-primary:hover {
        background-color: #3b36b3;
    }

    .spinner-border {
        width: 1rem;
        height: 1rem;
        margin-left: 8px;
        display: none; /* hidden by default */
    }

    .table {
        font-size: 0.9rem;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        color: #000;
        text-align: center;
        background: #e5e7eb;
        padding: 12px;
    }

    .table tbody td {
        vertical-align: middle;
        text-align: center;
        padding: 10px;
    }

    .alert {
        font-size: 0.95rem;
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .container {
            width: 90%;
            margin-left: 200px;
        }
    }

    @media (max-width: 992px) {
        .container {
            width: 95%;
            margin-left: 0;
        }
        .row.g-3 .col-md-6,
        .row.g-3 .col-md-2 {
            width: 100%;
        }
        .row.g-3 .col-md-2 {
            margin-top: 10px;
        }
    }

    @media (max-width: 768px) {
        table {
            font-size: 0.8rem;
        }
        h2 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4">Find Mediators by Location</h2>

    <!-- Location Selection Form -->
    <form method="GET" action="{{ route('business.connections.index') }}" class="mb-4" onsubmit="return confirmSearch()">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <select id="locationSelect" name="location" class="form-select" required>
                    <option value="" disabled {{ request('location') ? '' : 'selected' }}>-- Select a Location --</option>
                    @foreach($locations as $loc)
                        @if(!empty($loc->location))
                            <option value="{{ $loc->location }}" 
                                {{ request('location') == $loc->location ? 'selected' : '' }}>
                                {{ $loc->location }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    Search
                    <div class="spinner-border text-light" role="status" id="loadingSpinner">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>

    <!-- Mediators Section (Hidden until searched) -->
    @if(request('location'))
        @if(count($mediators) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">Full Name</th>
                            <th style="width: 20%;">Email</th>
                            <th style="width: 15%;">Phone</th>
                            <th style="width: 10%;">Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mediators as $mediator)
                            @if(!empty($mediator->location))
                                <tr>
                                    <td>{{ $mediator->id }}</td>
                                    <td>{{ $mediator->fullname }}</td>
                                    <td>{{ $mediator->email }}</td>
                                    <td>{{ $mediator->phone }}</td>
                                    <td>{{ ucfirst($mediator->level) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning mt-3">
                No mediators found in "{{ request('location') }}".
            </div>
        @endif
    @endif
</div>

<script>
    function confirmSearch() {
        let location = document.getElementById("locationSelect").value;
        if (!location) return false;

        let confirmAction = confirm("Do you want to see the mediators in " + location + "?");
        if (confirmAction) {
            document.getElementById("loadingSpinner").style.display = "inline-block";
            return true; // proceed with submission
        } else {
            return false; // cancel submission
        }
    }
</script>

@include('layouts.footer')
