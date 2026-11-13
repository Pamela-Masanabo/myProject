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

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="logout-btn">
                            Logout
                        </button>
                    </form>
                </li>

            </ul>

        </div>

        <!-- Main -->

        <div class="main">

            <h2>General Screening Dashboard</h2>

            <p>Patients waiting for screening.</p>

            <!-- Statistics -->

            <div class="cards">

                <div class="card">

                    <h1>{{ $patients->count() }}</h1>

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

                @forelse($patients as $patient)

                <tr>

                    <td>

                        <span class="queue">

                            {{ $patient->queue_number }}

                        </span>

                    </td>

                    <td>

                        {{ $patient->patient->first_name }}

                        {{ $patient->patient->last_name }}

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($patient->patient->date_of_birth)->age }}

                        @if(\Carbon\Carbon::parse($patient->patient->date_of_birth)->age >= 65)

                        <span class="elderly">

                            Elderly

                        </span>

                        @endif

                    </td>

                    <td>

                        {{ $patient->created_at->format('H:i') }}

                    </td>

                    <td>

                        Waiting

                    </td>

                    <td>

                        <a href="{{ route('screening.create',$patient->id) }}">

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