@include('layouts.header')
@include('layouts.sidebar')
@include('manager.connect')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Devices Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin-left:260px;
            margin-top:80px;
            background: white;
            padding: 25px 40px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }

        .header .logo img {
            max-height: 60px;
        }

        .header .title {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Report Info */
        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 14px;
            color: #555;
        }

        .report-info .section {
            width: 48%;
        }

        .report-info strong {
            display: block;
            margin-bottom: 6px;
            color: #222;
            font-weight: 600;
        }

        /* Filter form */
        form.filter-form {
            margin-bottom: 25px;
        }

        form.filter-form label {
            font-weight: 600;
            margin-right: 8px;
        }

        form.filter-form input[type="date"] {
            padding: 6px 8px;
            margin-right: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        form.filter-form button {
            padding: 7px 15px;
            background-color: #2d89ef;
            border: none;
            border-radius: 3px;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        /* Download buttons */
        .download-buttons {
            margin-bottom: 20px;
        }

        .download-buttons a {
            text-decoration: none;
            background: #27ae60;
            color: white;
            padding: 10px 16px;
            border-radius: 5px;
            margin-right: 12px;
            font-size: 14px;
            display: inline-block;
            transition: background-color 0.2s ease;
        }

        .download-buttons a:hover {
            background-color: #219150;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 35px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 12px 10px;
            text-align: left;
        }

        th {
            background-color: #777;
            color: white;
            font-weight: 600;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        /* Signature block */
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .signature .sign-box {
            width: 280px;
            border-top: 1px solid #777;
            text-align: center;
            padding-top: 8px;
            color: #555;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 720px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header .title {
                margin-top: 15px;
            }

            .report-info {
                flex-direction: column;
            }

            .report-info .section {
                width: 100%;
                margin-bottom: 20px;
            }

            .download-buttons a {
                display: block;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header with logo and title --}}
        <div class="header">
            <div class="logo">
                {{-- Replace the path below with your actual logo path --}}
                <img src="{{ asset('images/company_logo.png') }}" alt="Company Logo" />
            </div>
            <div class="title">Devices Report</div>
        </div>

        {{-- Report info example --}}
        <div class="report-info">
            <div class="section">
                <strong>Report Date Range</strong>
                From: {{ request('start_date') ?? 'N/A' }}<br/>
                To: {{ request('end_date') ?? 'N/A' }}
            </div>
            <div class="section" style="text-align: right;">
                <strong>Generated on</strong>
                {{ \Carbon\Carbon::now()->format('m/d/Y') }}
            </div>
        </div>

        {{-- Filter form --}}
        <form method="GET" action="{{ route('reports.index') }}" class="filter-form">
            <label for="start_date">From:</label>
            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

            <label for="end_date">To:</label>
            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

            <button type="submit">Filter</button>
        </form>

        {{-- Download buttons --}}
        <div class="download-buttons">
            <a href="{{ route('reports.download.pdf', request()->only(['start_date', 'end_date'])) }}" target="_blank">Download PDF</a>
            <a href="{{ route('reports.download.excel', request()->only(['start_date', 'end_date'])) }}" target="_blank">Download Excel</a>
        </div>

        {{-- Devices table --}}
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
                    <th>Technician Name</th>
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
                        <td colspan="8" style="text-align:center;">No devices found for selected date range.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Signature block --}}
        <div class="signature">
            <div class="sign-box">
                <img src="{{ asset('images/signature.png') }}" alt="Signature" style="max-height: 60px;">
                <br>
                <em>Tech Guard Ltd</em>
            </div>


            <div class="sign-box" style="text-align: right;">
                Date: {{ \Carbon\Carbon::now()->format('m/d/Y') }}
            </div>
        </div>
    </div>
</body>
</html>
@include('layouts.footer')

