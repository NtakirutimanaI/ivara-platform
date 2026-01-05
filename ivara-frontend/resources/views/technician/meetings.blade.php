@include('layouts.header')
@include('layouts.sidebar')
@include('technician.connect')

<style>
/* Container */
.container {
    width: 80%;
    margin-left: 240px;
    margin-top: 50px;
    padding: 1rem;
    box-sizing: border-box;
}

/* Headings */
h1, h2, h3 { font-family: 'Inter', sans-serif; }
h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; }

/* Tables */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

table { width: 100%; border-collapse: collapse; font-size: 0.875rem; min-width: 600px; }
th, td { padding: 0.75rem 1rem; text-align: left; vertical-align: middle; border: none; }
thead th, tbody td { border-bottom: 1px solid #4f46e5; }
tbody tr:hover { background-color: #f9fafb; }

/* Alert messages */
.bg-green-100 { background-color: #d1fae5; color: #047857; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem; }
.bg-red-100 { background-color: #fee2e2; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem; }

/* Links */
a { text-decoration: none; }
a:hover { text-decoration: underline; color: #1d4ed8; }

/* Responsive adjustments */
@media (max-width: 1024px) {
    .container { width: 90%; margin-left: 0; margin-top: 20px; padding: 1rem; }
}

@media (max-width: 640px) {
    h1 { font-size: 1.5rem; }
    table { font-size: 0.75rem; }
}
</style>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Published Meetings</h1>

    @php
        // Filter only published meetings
        $publishedMeetings = $meetings->filter(function($meeting){
            return trim($meeting->status) === 'Published';
        });
    @endphp

    @if($publishedMeetings->isEmpty())
        <div class="bg-red-100">No published meetings available!</div>
    @else
        <div class="table-responsive">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4">#</th>
                        <th class="py-2 px-4">Time</th>
                        <th class="py-2 px-4">Link</th>
                        <th class="py-2 px-4">Description</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publishedMeetings as $index => $meeting)
                    <tr>
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $meeting->time }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ $meeting->link }}" target="_blank" class="text-blue-500">
                                Join Meeting
                            </a>
                        </td>
                        <td class="py-2 px-4">{{ $meeting->description ?? '-' }}</td>
                        <td class="py-2 px-4 text-green-600 font-semibold">{{ $meeting->status }}</td>
                        <td class="py-2 px-4">{{ $meeting->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('layouts.footer')
