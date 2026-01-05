<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Tracking</title>

    <style>
        /* Container adjustments */
        .container {
            width: 80%;
            margin-left: 240px;
            margin-top: 20px;
        }

        /* Make page responsive */
        @media (max-width: 1024px) {
            .container {
                width: 95%;
                margin-left: auto;
                margin-right: auto;
            }
        }

        /* Button styling */
        .btn {
            background: #4f46e5;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
            transition: background 0.3s ease-in-out;
        }
        .btn:hover {
            background: #4338ca;
        }

        /* Table Styling */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        thead tr {
            background-color: #4f46e5;
            color: #fff;
        }
        thead th {
            padding: 12px;
            font-weight: 600;
            text-align: left;
        }
        tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        tbody tr:hover {
            background: #f9fafb;
            transition: background 0.2s ease-in-out;
        }

        /* Status Badge */
        .status-active {
            background: #bbf7d0;
            color: #166534;
            font-size: 0.875rem;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 500;
        }
        .status-inactive {
            background: #fecaca;
            color: #991b1b;
            font-size: 0.875rem;
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 500;
        }

        /* Responsive table */
        .overflow-x-auto {
            overflow-x: auto;
        }

        /* Highlight clicked row */
        .bg-selected {
            background-color: #e0e7ff !important;
        }
    </style>
</head>
<body>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold text-[#4f46e5] mb-4">Device Tracking</h2>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-[#4f46e5] text-white">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Brand</th>
                        <th class="p-3 text-left">Model</th>
                        <th class="p-3 text-left">Serial</th>
                        <th class="p-3 text-left">Type</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Location</th>
                        <th class="p-3 text-left">Last Seen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devices as $device)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-3">{{ $device->id }}</td>
                        <td class="p-3">{{ $device->brand }}</td>
                        <td class="p-3">{{ $device->model }}</td>
                        <td class="p-3">{{ $device->serial_number }}</td>
                        <td class="p-3">{{ $device->type }}</td>
                        <td class="p-3">
                            <span class="{{ $device->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                {{ ucfirst($device->status) }}
                            </span>
                        </td>
                        <td class="p-3">{{ $device->location ?? 'Unknown' }}</td>
                        <td class="p-3">{{ $device->last_seen_at ?? 'Never' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Optional: highlight row on click
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                row.addEventListener("click", () => {
                    rows.forEach(r => r.classList.remove("bg-selected"));
                    row.classList.add("bg-selected");
                });
            });
        });
    </script>

</body>
</html>
