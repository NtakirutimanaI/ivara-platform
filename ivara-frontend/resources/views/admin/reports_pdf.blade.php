<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Devices Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #fff;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header .logo img {
            max-height: 60px;
        }

        .header .title {
            font-size: 24px;
            font-weight: bold;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info div {
            width: 48%;
        }

        .info strong {
            display: block;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table th, table td {
            border: 1px solid #666;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f0f0f0;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
        }

        .sign-box {
            width: 250px;
            text-align: center;
        }

        .sign-box img {
            max-height: 60px;
        }

        .sign-box .label {
            border-top: 1px solid #000;
            margin-top: 10px;
            padding-top: 5px;
            font-style: italic;
            font-size: 13px;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/company_logo.png') }}" alt="Company Logo">
        </div>
        <div class="title">Devices Report</div>
    </div>

    {{-- Report Info --}}
    <div class="info">
        <div>
            <strong>Report Date Range</strong>
            From: {{ $start_date ?? 'N/A' }}<br>
            To: {{ $end_date ?? 'N/A' }}
        </div>
        <div style="text-align: right;">
            <strong>Generated on:</strong> {{ $generated_on ?? \Carbon\Carbon::now()->format('m/d/Y') }}
        </div>
    </div>

    {{-- Devices Table --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Phone</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial #</th>
                <th>Status</th>
                <th>Technician</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($devices as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $d->client->name ?? 'N/A' }}</td>
                    <td>{{ $d->client->phone ?? 'N/A' }}</td>
                    <td>{{ $d->brand }}</td>
                    <td>{{ $d->model }}</td>
                    <td>{{ $d->serial_number }}</td>
                    <td>{{ ucfirst($d->status) }}</td>
                    <td>{{ $d->technician->name ?? 'Unassigned' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No devices found for the selected date range.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Signature --}}
    <div class="signature">
        <div class="sign-box">
            <img src="{{ public_path('images/signature.png') }}" alt="Signature">
            <div class="label">Tech Guard Ltd</div>
        </div>
        <div class="sign-box">
            <div class="label">Date: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</div>
        </div>
    </div>

</body>
</html>
