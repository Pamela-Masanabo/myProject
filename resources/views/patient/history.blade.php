
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient History | DPCMS</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6f9;
            color: #263445;
        }

        .header {
            background: #1f4e8c;
            color: white;
            padding: 22px 30px;
        }

        .header h2 {
            margin: 0 0 5px;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 20px;
        }

        .history-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .history-card h3 {
            color: #1f4e8c;
            margin-top: 0;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #eaf1f9;
            color: #1f4e8c;
        }

        .status {
            padding: 6px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .waiting {
            background: #fef3c7;
            color: #92400e;
        }

        .referred {
            background: #fee2e2;
            color: #991b1b;
        }

        .other {
            background: #e5e7eb;
            color: #374151;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 18px;
            background: #1f4e8c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-btn:hover {
            background: #163b6b;
        }

        .empty-message {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        @media(max-width: 600px) {
            .container {
                padding: 12px;
            }

            th, td {
                padding: 10px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Patient Visit History</h2>
        <p>Digital Public Clinic Management System</p>
    </div>

    <div class="container">

        <div class="history-card">

            <h3>📋 My Previous Visits</h3>

            <p>View your previous clinic visits and their current status.</p>

            <div class="table-container">

                <table>
                    <thead>
                        <tr>
                            <th>Visit Date</th>
                            <th>Queue Number</th>
                            <th>Visit Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($visits as $visit)

                            @php
                                $status = $visit->status;

                                if ($status === 'COMPLETED') {
                                    $statusClass = 'completed';
                                } elseif (in_array($status, [
                                    'WAITING_SCREENING',
                                    'WAITING_CONSULTATION',
                                    'WAITING_DOCTOR',
                                    'IN_SCREENING',
                                    'IN_CONSULTATION'
                                ])) {
                                    $statusClass = 'waiting';
                                } elseif ($status === 'REFERRED') {
                                    $statusClass = 'referred';
                                } else {
                                    $statusClass = 'other';
                                }
                            @endphp

                            <tr>
                                <td>{{ $visit->created_at->format('d M Y') }}</td>

                                <td>{{ $visit->queue_number ?? 'N/A' }}</td>

                                <td>
                                    {{ ucwords(strtolower(str_replace('_', ' ', $visit->reason))) }}
                                </td>

                                <td>
                                    <span class="status {{ $statusClass }}">
                                        {{ ucwords(strtolower(str_replace('_', ' ', $status))) }}
                                    </span>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="empty-message">
                                    You have no previous clinic visits.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>

            <a href="{{ route('patient.dashboard') }}" class="back-btn">
                ← Back to Dashboard
            </a>

        </div>

    </div>

    
</body>

</html>
