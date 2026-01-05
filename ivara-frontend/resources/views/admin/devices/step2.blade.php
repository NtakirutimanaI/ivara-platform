
<h2>Step 2: Assign Client</h2>
<form action="{{ route('tracking.storeStep', 2) }}" method="POST">
    @csrf
    <label>Select Client</label>
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }}</option>
        @endforeach
    </select><br>

    <button type="submit">Next</button>
</form>

