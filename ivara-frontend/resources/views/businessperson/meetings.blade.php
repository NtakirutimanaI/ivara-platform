@include($role . '.header')
@include($role . '.sidebar')
@include($role . '.connect')

<style>
/* Container */
.container {
    width: 80%;
    margin-left: 240px;
    margin-top: 50px;
    padding: 1rem;
}

/* Headings */
h1, h2, h3 { font-family: 'Inter', sans-serif; }
h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; }

/* Tables */
table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
th, td { border: 1px solid #e5e7eb; padding: 0.75rem 1rem; text-align: left; vertical-align: middle; }
thead tr { background-color: #f3f4f6; }
tbody tr:hover { background-color: #f9fafb; }

/* Alert messages */
.bg-green-100 { 
    background-color: #d1fae5; 
    color: #047857; 
    padding: 0.75rem 1rem; 
    border-radius: 0.375rem; 
    margin-bottom: 1.5rem; 
}
</style>

<div class="container">
    <h1>{{ ucfirst($role) }} Meetings</h1>

    @if(session('success'))
        <div class="bg-green-100">
            {{ session('success') }}
        </div>
    @endif

    @if($meetings->isEmpty())
        <p>No meeting published!</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date & Time</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($meeting->time)->format('d M Y, H:i') }}</td>
                        <td>{{ $meeting->description ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@include($role . '.footer')
