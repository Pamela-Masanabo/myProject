<!DOCTYPE html>
<html>

<head>

    <title>General Screening Dashboard</title>

    <link rel="stylesheet"
          href="{{ asset('css/screening-dashboard.css') }}">

</head>

<body>

<div class="layout">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>Screening Nurse</h2>

        <ul>

            <li class="active">Waiting Patients</li>

            <li>Completed Today</li>

            <li>Logout</li>

        </ul>

    </div>

    <!-- Main -->

    <div class="main">

        <h2>General Screening Dashboard</h2>

        <p>Patients waiting for screening.</p>

        <!-- Statistics -->

        <div class="cards">

            <div class="card">

                <h1>{{ $visits->count() }}</h1>

                <p>Waiting Patients</p>

            </div>

        </div>

        <!-- Waiting Patients -->

        <table>

            <tr>

                <th>Queue</th>

                <th>Patient</th>

                <th>Age</th>

                <th>Arrival</th>

                <th>Priority</th>

                <th>Action</th>

            </tr>

            @forelse($visits as $visit)

            <tr>

                <td>

                    <span class="queue">

                        {{ $visit->queue_number }}

                    </span>

                </td>

                <td>

                    {{ $visit->patient->first_name }}

                    {{ $visit->patient->last_name }}

                </td>

                <td>

                    {{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age }}

                    @if(\Carbon\Carbon::parse($visit->patient->date_of_birth)->age >= 65)

                        <span class="elderly">

                            Elderly

                        </span>

                    @endif

                </td>

                <td>

                    {{ $visit->created_at->format('H:i') }}

                </td>

                <td>

                    Waiting

                </td>

                <td>

                    <a href="{{ route('screening.create',$visit->id) }}">

                        <button class="screen-btn">

                            Screen

                        </button>

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6">

                    No patients waiting for screening.

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

</body>

</html>