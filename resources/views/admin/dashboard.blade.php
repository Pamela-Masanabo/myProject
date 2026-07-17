<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>

<body>

<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">

        <h2>Clinic Admin</h2>

        <ul>

            <li class="active">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>

            <li>
                <a href="#">Staff Management</a>
            </li>

            <li>
                <a href="#">Room Management</a>
            </li>

            <li>
                <a href="#">Reports</a>
            </li>

            <li>
                <a href="{{ route('referrals.dashboard') }}">Referrals</a>
            </li>

            <li>
                <a href="#">Logout</a>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="main">

        <div class="page-header">

            <h1>Admin Dashboard</h1>

            <p>
                Welcome,
                {{ auth()->user()->first_name }}
                {{ auth()->user()->last_name }}
            </p>

        </div>

        <!-- Statistics -->
        <div class="stats-grid">

            <div class="card blue">
                <h2>{{ $patientsToday }}</h2>
                <p>Patients Today</p>
            </div>

            <div class="card orange">
                <h2>{{ $waitingScreening }}</h2>
                <p>Waiting Screening</p>
            </div>

            <div class="card yellow">
                <h2>{{ $waitingDoctor }}</h2>
                <p>Waiting Doctor</p>
            </div>

            <div class="card green">
                <h2>{{ $completedVisits }}</h2>
                <p>Completed Visits</p>
            </div>

            <div class="card red">
                <h2>{{ $referrals }}</h2>
                <p>Hospital Referrals</p>
            </div>

            <div class="card purple">
                <h2>{{ $chronicPatients }}</h2>
                <p>Chronic Patients</p>
            </div>

            <div class="card pink">
                <h2>{{ $maternityPatients }}</h2>
                <p>Maternity Patients</p>
            </div>

            <div class="card grey">
                <h2>{{ $staff }}</h2>
                <p>Staff Members</p>
            </div>

        </div>

        <!-- Queue -->
        <div class="section">

            <h2>Today's Queue</h2>

            <table>

                <thead>

                <tr>

                    <th>Queue</th>
                    <th>Patient</th>
                    <th>Visit Type</th>
                    <th>Status</th>
                    <th>Priority</th>

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

                        <td>{{ $visit->visit_type }}</td>

                        <td>{{ $visit->status }}</td>

                        <td>{{ $visit->priority_level ?? 'NORMAL' }}</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            No patients in queue.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <!-- Quick Actions -->
        <div class="section">

            <h2>Quick Actions</h2>

            <div class="quick-actions">

                <a href="#" class="action-card">Staff Management</a>

                <a href="#" class="action-card">Room Management</a>

                <a href="#" class="action-card">Reports</a>

                <a href="{{ route('referrals.dashboard') }}" class="action-card">
                    Referrals
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>