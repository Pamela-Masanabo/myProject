<!DOCTYPE html>
<html>

<head>

    <title>Pediatric Consultation Dashboard</title>

    <link rel="stylesheet"
          href="{{ asset('css/kids-dashboard.css') }}">

</head>

<body>

<div class="layout">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>Pediatrics</h2>

        <ul>

            <li class="active">
                Waiting Patients
            </li>

            <li>
                Completed Today
            </li>

            <li>
                Logout
            </li>

        </ul>

    </div>

    <!-- Main -->

    <div class="main">

        <h2>Pediatric Consultation Dashboard</h2>

        <p>Children waiting for consultation.</p>

        <div class="cards">

            <div class="card">

                <h1>{{ $visits->count() }}</h1>

                <p>Waiting Patients</p>

            </div>

        </div>

        <table>

            <thead>

            <tr>

                <th>Queue</th>

                <th>Patient</th>

                <th>Age</th>

                <th>Guardian</th>

                <th>Priority</th>

                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($visits as $visit)

            <tr>

                <td>{{ $visit->queue_number }}</td>

                <td>

                    {{ $visit->patient->first_name }}

                    {{ $visit->patient->last_name }}

                </td>

                <td>{{ $visit->patient->age }}</td>

                <td>{{ $visit->guardian_name }}</td>

                <td>

                    <span class="priority">

                        {{ $visit->screening->priority_level }}

                    </span>

                </td>

                <td>

                    <a href="{{ route('kids.consultation',$visit->id) }}">

                        <button class="consult-btn">

                            Consult

                        </button>

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6">

                    No pediatric patients waiting.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>

</html>