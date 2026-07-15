<!DOCTYPE html>
<html>

<head>

    <title>Chronic Care Dashboard</title>

    <link rel="stylesheet"
          href="{{ asset('css/chronic-dashboard.css') }}">

</head>

<body>

<div class="layout">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>Chronic Care</h2>

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

        <h2>

            Chronic Care Dashboard

        </h2>

        <p>

            Patients waiting for chronic medication.

        </p>

        <div class="cards">

            <div class="card">

                <h1>

                    {{ $visits->count() }}

                </h1>

                <p>

                    Waiting Patients

                </p>

            </div>

        </div>

        <table>

            <tr>

                <th>

                    Queue

                </th>

                <th>

                    Patient

                </th>

                <th>

                    Condition

                </th>

                <th>

                    Arrival

                </th>

                <th>

                    Action

                </th>

            </tr>

            @forelse($visits as $visit)

            <tr>

                <td>

                    {{ $visit->queue_number }}

                </td>

                <td>

                    {{ $visit->patient->first_name }}

                    {{ $visit->patient->last_name }}

                </td>

                <td>

                    {{ optional($visit->patient->chronicRecord)->condition }}

                </td>

                <td>

                    {{ $visit->created_at->format('H:i') }}

                </td>

                <td>

                    <a href="{{ route('chronic.process',$visit->id) }}">

                        <button class="process-btn">

                            Process

                        </button>

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5">

                    No chronic patients waiting.

                </td>

            </tr>

            @endforelse

        </table>

    </div>

</div>

</body>

</html>