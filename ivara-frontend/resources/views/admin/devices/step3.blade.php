
<h2>Step 3: Confirm & Save</h2>

@php
    $step1 = session('step1');
    $step2 = session('step2');
@endphp

<h4>Device Information</h4>
<p>Brand: {{ $step1['brand'] }}</p>
<p>Model: {{ $step1['model'] }}</p>
<p>Serial: {{ $step1['serial_number'] }}</p>
<p>Type: {{ $step1['type'] }}</p>

<h4>Client</h4>
<p>Client ID: {{ $step2['client_id'] }}</p>

<form action="{{ route('tracking.storeStep', 3) }}" method="POST">
    @csrf
    <button type="submit">Save Device</button>
</form>

