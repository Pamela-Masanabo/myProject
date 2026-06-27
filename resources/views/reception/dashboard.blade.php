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

            <h2>Today's Patient Check-ins</h2>

            <p>
                Patients waiting for queue generation
            </p>

        </div>

        <!-- Statistics -->

        <div class="cards">

            <div class="card">

                <h3>{{ $visits->count() }}</h3>

                <p>Waiting Patients</p>

            </div>

            <div class="card">

                <h3>{{ date('d M Y') }}</h3>

                <p>Today's Date</p>

            </div>

        </div>

        <!-- Table -->

        <table>

            <tr>

                <th>Patient</th>

                <th>Visit Type</th>

                <th>Arrival</th>

                <th>Queue</th>

                <th>Action</th>

            </tr>

            @forelse($visits as $visit)

            <tr>

                <td>

                    {{ $visit->patient->first_name }}

                    {{ $visit->patient->last_name }}

                </td>

                <td>

                    {{ str_replace('_',' ', $visit->reason_for_visit) }}

                </td>

                <td>

                    {{ $visit->created_at->format('H:i') }}

                </td>

                <td>

                    @if($visit->queue_number)

                        <span class="badge">

                            {{ $visit->queue_number }}

                        </span>

                    @else

                        Not Assigned

                    @endif

                </td>

                <td>

                    @if(!$visit->queue_number)

                    <form method="POST"
                          action="{{ route('reception.generateQueue',$visit->id) }}">

                        @csrf

                        <button class="queue-btn">

                            Generate Queue

                        </button>

                    </form>

                    @else

                        <button class="done-btn" disabled>

                            Assigned

                        </button>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5">

                    No patients checked in today.

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

</body>
</html>