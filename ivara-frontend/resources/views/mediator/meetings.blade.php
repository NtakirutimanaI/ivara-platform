@include('layouts.header')
@include('layouts.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Published Meetings for Mediator</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
        }

        .container-meetings {
            width: 75%;
            margin-left: 240px;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            color: #924FC2;
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            text-align: center;
        }

        table thead {
            background-color: #924FC2;
            color: #fff;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px 10px;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #ece7f1;
        }

        a {
            text-decoration: none;
            color: #924FC2;
            font-weight: 600;
        }

        a:hover {
            text-decoration: underline;
        }

        .status-badge {
            background-color: #924FC2;
            color: #fff;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .no-meeting {
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            background-color: #f8d7da;
            color: #842029;
            border-radius: 8px;
            font-size: 14px;
        }

        /* Responsive adjustments */
        @media(max-width: 992px) {
            .container-meetings {
                width: 95%;
                margin-left: auto;
                margin-right: auto;
            }

            table th, table td {
                padding: 6px 8px;
                font-size: 12px;
            }

            h1 {
                font-size: 20px;
            }
        }

        @media(max-width: 576px) {
            table th, table td {
                padding: 4px 6px;
                font-size: 11px;
            }

            h1 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<div class="container-meetings">
    <h1>Published Meetings for Mediator</h1>

    @if($meetings->isEmpty())
        <div class="no-meeting">No published meetings available for mediator!</div>
    @else
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Time</th>
                        <th>Link</th>
                        <th>Description</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($meetings as $index => $meeting)
                    @php
                        $roles = $meeting->roles;

                        if (is_string($roles)) {
                            $roles = json_decode($roles, true);
                            if (!$roles) {
                                $roles = json_decode(stripslashes($meeting->roles), true) ?? [];
                            }
                        } elseif (!is_array($roles)) {
                            $roles = [];
                        }
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $meeting->time }}</td>
                        <td><a href="{{ $meeting->link }}" target="_blank">Join Meeting</a></td>
                        <td>{{ $meeting->description ?? '-' }}</td>
                        <td>{{ implode(', ', $roles) }}</td>
                        <td><span class="status-badge">{{ $meeting->status }}</span></td>
                        <td>{{ $meeting->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('layouts.footer')
</body>
</html>
