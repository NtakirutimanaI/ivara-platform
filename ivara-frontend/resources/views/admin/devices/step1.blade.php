
<h2>Step 1: Device Info</h2>
<form action="{{ route('tracking.storeStep', 1) }}" method="POST">
    @csrf
    <label>Brand</label>
    <input type="text" name="brand" required><br>

    <label>Model</label>
    <input type="text" name="model" required><br>

    <label>Serial Number</label>
    <input type="text" name="serial_number" required><br>

    <label>Type</label>
    <input type="text" name="type" required><br>

    <button type="submit">Next</button>
</form>
