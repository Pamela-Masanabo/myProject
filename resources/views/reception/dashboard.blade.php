<!DOCTYPE html>
<html>

<head>
    <title>Reception Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/reception-dashboard.css') }}">
</head>

<body>

    <div class="layout">

        <!-- SIDEBAR -->
        <div class="sidebar">

            <h2>Reception</h2>

            <ul>
                <li class="active">Today's Check-ins</li>
                <li>Patients</li>
                <li>Logout</li>
            </ul>

        </div>

        <!-- MAIN CONTENT -->
        <div class="main">

            <div class="header">

                <h2>Today's Patient Queue</h2>

                <table>

                    <thead>

                        <tr>

                            <th>Queue</th>

                            <th>Patient</th>

                            <th>Reason</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($queue as $visit)

                        <tr>

                            <td>{{ $visit->queue_number }}</td>

                            <td>
                                {{ $visit->patient->first_name }}
                                {{ $visit->patient->last_name }}
                            </td>

                            <td>{{ str_replace('_',' ', $visit->reason) }}</td>

                            <td>{{ $visit->status }}</td>

                            <td>

                                <form
                                    action="{{ route('reception.screening',$visit) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit">

                                        Send to Screening

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5">

                                No patients waiting.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

</body>

</html>