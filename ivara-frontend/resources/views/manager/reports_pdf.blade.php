<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Devices Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            margin-top:80px;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }

        .container {
            width: 95%;
            max-width: 1000px;
            margin-left: 260px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            flex-wrap: wrap;
        }

        .header .logo img {
            max-height: 40px;
        }

        .header .title {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 10px;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .report-info .section {
            flex: 1 1 45%;
            margin-bottom: 10px;
        }

        .report-info strong {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #222;
        }

        form.filter-form {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        form.filter-form input[type="date"] {
            padding: 5px 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 12px;
        }

        form.filter-form button {
            padding: 6px 12px;
            background-color: #2d89ef;
            border: none;
            border-radius: 3px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 12px;
        }

        .download-buttons {
            margin: 10px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .download-buttons a {
            text-decoration: none;
            background: #27ae60;
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            font-size: 12px;
            transition: background 0.2s;
        }

        .download-buttons a:hover {
            background-color: #219150;
        }

        .table-responsive {
            overflow-x: auto;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            white-space: nowrap;
        }

        th {
            background-color: #666;
            color: white;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            font-size: 12px;
        }

        .signature .sign-box {
            width: 45%;
            text-align: center;
            border-top: 1px solid #999;
            padding-top: 8px;
            margin-top: 20px;
        }

        .signature img {
            max-height: 50px;
        }

        @media (max-width: 600px) {
            .header, .report-info, .signature {
                flex-direction: column;
                align-items: flex-start;
            }

            .signature .sign-box {
                width: 100%;
                margin-bottom: 20px;
            }

            th, td {
                font-size: 11px;
                padding: 6px;
            }

            .download-buttons a {
                font-size: 11px;
                padding: 6px 10px;
            }
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
