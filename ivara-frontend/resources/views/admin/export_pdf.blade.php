<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Feedback Export PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>User Feedback Export</h2>
    <table>
        <thead>
            <tr>
                <th>User Type</th>
                <th>Module</th>
                <th>Urgency</th>
                <th>Category</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $feedback)
                <tr>
                    <td>{{ $feedback->user_type }}</td>
                    <td>{{ $feedback->module }}</td>
                    <td>{{ $feedback->urgency }}</td>
                    <td>{{ $feedback->category }}</td>
                    <td>{{ $feedback->message }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
