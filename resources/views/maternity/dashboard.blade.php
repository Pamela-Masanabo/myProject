<!DOCTYPE html>
<html>

<head>

    <title>Maternity Dashboard</title>

    <link rel="stylesheet"
          href="{{ asset('css/maternity-dashboard.css') }}">

</head>

<body>

<div class="layout">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>Maternity</h2>

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

        <h2>Maternity Dashboard</h2>

        <p>Pregnant patients waiting for consultation.</p>

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

                <th>Pregnancy No.</th>

                <th>Weeks</th>

                <th>Trimester</th>

                <th>High Risk</th>

                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($visits as $visit)

                @php

                    $maternity = $visit->patient->maternityRecord;

                    $weeks = null;

                    $trimester = '';

                    if($maternity){

                        $weeks = \Carbon\Carbon::parse($maternity->lmp_date)

                            ->diffInWeeks(now());

                        if($weeks <=12){

                            $trimester='First';

                        }
                        elseif($weeks <=27){

                            $trimester='Second';

                        }
                        else{

                            $trimester='Third';

                        }

                    }

                @endphp

            <tr>

                <td>

                    {{ $visit->queue_number }}

                </td>

                <td>

                    {{ $visit->patient->first_name }}

                    {{ $visit->patient->last_name }}

                </td>

                <td>

                    {{ optional($maternity)->pregnancy_number }}

                </td>

                <td>

                    {{ $weeks }}

                </td>

                <td>

                    {{ $trimester }}

                </td>

                <td>

                    @if(optional($maternity)->high_risk)

                        <span class="high-risk">

                            YES

                        </span>

                    @else

                        <span class="normal">

                            NO

                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('maternity.consultation',$visit->id) }}">

                        <button class="consult-btn">

                            Consult

                        </button>

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7">

                    No maternity patients waiting.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>

</html>