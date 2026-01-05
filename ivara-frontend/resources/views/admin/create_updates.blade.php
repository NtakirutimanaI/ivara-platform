@include('layouts.header')
@include('layouts.sidebar')
@include('admin.connect')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Updates Report</title>
    <style>
        /* Unique container class */
        .updates-report-body {
            font-size: 16px;
            margin-top:40px;
            padding: 20px;
            background-color: #fff;
            color: #333;
            margin-left: 270px;
            font-family: 'Poppins', sans-serif;
        }

        /* Header style */
        .updates-report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #924FC2;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .updates-report-logo img {
            max-height: 60px;
        }

        .updates-report-title {
            font-size: 24px;
            font-weight: bold;
        }

        /* Info section */
        .updates-report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .updates-report-info > div {
            flex: 1 1 48%;
            min-width: 200px;
        }

        .updates-report-info strong {
            display: block;
            margin-bottom: 5px;
        }

        /* Table styles if needed */
        .updates-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .updates-report-table th, 
        .updates-report-table td {
            border: 1px solid #666;
            padding: 8px;
            text-align: left;
        }

        .updates-report-table th {
            background-color: #f0f0f0;
        }

        /* Signature area */
        .updates-report-signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .updates-report-sign-box {
            width: 250px;
            text-align: center;
        }

        .updates-report-sign-box img {
            max-height: 60px;
        }

        .updates-report-sign-box .label {
            border-top: 1px solid #000;
            margin-top: 10px;
            padding-top: 5px;
            font-style: italic;
            font-size: 13px;
        }


        /* Your original container with Tailwind-like classes for layout */
        .updates-form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Responsive form and updates list */
        form.updates-form {
            margin-bottom: 2rem;
            border-bottom: 1px solid #ccc;
            padding-bottom: 1.5rem;
        }

        form.updates-form label {
            font-weight: 600;
            display: block;
            margin-bottom: 0.25rem;
        }

        form.updates-form input[type="text"],
        form.updates-form input[type="date"],
        form.updates-form input[type="file"],
        form.updates-form textarea {
            width: 100%;
            border: none;                 /* removed all borders */
            border-bottom: 1px solid #ccc; /* only border-bottom kept */
            border-radius: 0;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            font-family: inherit;
            box-sizing: border-box;
            outline-offset: 2px;
        }

        form.updates-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        form.updates-form button {
            background-color: #924FC2;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form.updates-form button:hover {
            background-color:  #0A1128;
        }

        /* Error messages */
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Success message */
        .success-message {
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background-color: #bbf7d0;
            color: #166534;
            border-radius: 6px;
        }

        /* Updates list */
        .updates-list > div {
            display: flex;
            flex-direction: column;
            border-bottom: 1px solid #ccc;
            padding: 1rem 0;
        }

        @media (min-width: 768px) {
            .updates-list > div {
                flex-direction: row;
                align-items: center;
            }
        }

        .update-details {
            flex: 1 1 auto;
        }

        .update-details h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0 0 0.25rem 0;
        }

        .update-details p.date-location {
            font-size: 0.875rem;
            color: #6b7280; /* gray-600 */
            margin: 0 0 0.5rem 0;
        }

        .update-details p.description {
            margin: 0;
        }

        .update-image {
            margin-top: 0.75rem;
            max-width: 200px;
            border-radius: 8px;
            flex-shrink: 0;
        }

        @media (min-width: 768px) {
            .update-image {
                margin-left: 1.5rem;
                margin-top: 0;
            }
        }

        .remove-form {
            margin-top: 0.75rem;
        }

        @media (min-width: 768px) {
            .remove-form {
                margin-top: 0;
                margin-left: 1.5rem;
                flex-shrink: 0;
            }
        }

        .remove-btn {
            background-color: #dc2626;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
        }

        .remove-btn:hover {
            background-color: #991b1b;
        }
    </style>
</head>
<body class="updates-report-body">

<div class="updates-form-container">

    <h2 class="text-2xl font-semibold mb-4">Create Updates To The Website Visitors</h2>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.updates.store') }}" method="POST" enctype="multipart/form-data" class="updates-form">
        @csrf

        <div class="mb-4">
            <label for="event_name">Event Name</label>
            <input
                type="text"
                name="event_name"
                id="event_name"
                value="{{ old('event_name') }}"
                placeholder="Enter event name"
            >
            @error('event_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date">Date</label>
            <input
                type="date"
                name="date"
                id="date"
                value="{{ old('date') }}"
                placeholder="Select date"
            >
            @error('date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="location">Location</label>
            <input
                type="text"
                name="location"
                id="location"
                value="{{ old('location') }}"
                placeholder="Enter location"
            >
            @error('location')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image">Image (optional)</label>
            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                placeholder="Select image"
            >
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea
                name="description"
                id="description"
                rows="4"
                placeholder="Enter description"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Publish</button>
    </form>

    <h2 class="text-2xl font-semibold mb-4">Existing Updates</h2>

    <div class="updates-list">
        @forelse($updates as $update)
            <div>
                <div class="update-details">
                    <h3>{{ $update->event_name }}</h3>
                    <p class="date-location">{{ \Carbon\Carbon::parse($update->date)->format('F j, Y') }} — {{ $update->location }}</p>
                    <p class="description">{{ \Illuminate\Support\Str::limit($update->description, 150) }}</p>
                </div>
                @if($update->image)
                    <div class="update-image">
                        <img src="{{ asset('storage/' . $update->image) }}" alt="{{ $update->event_name }}" style="width: 100%; border-radius: 8px;">
                    </div>
                @endif
                <form action="{{ route('admin.updates.destroy', $update->id) }}" method="POST" class="remove-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="remove-btn">Remove</button>
                </form>
            </div>
        @empty
            <p>No updates found.</p>
        @endforelse
    </div>

</div>

</body>
</html>
@include('layouts.footer')
