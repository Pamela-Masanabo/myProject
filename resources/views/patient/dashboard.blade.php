<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/patient-dashboard.css') }}   ">
</head>
<body>
<div class="container">

    <!-- HEADER -->

    <div class="header">

        <h2>

            Welcome,

            {{ $patient->first_name }}

        </h2>

        <p>

            Public Clinic System

        </p>

    </div>
@if(session('error'))

<div class="error">

    {{ session('error') }}

</div>

@endif


@if(session('success'))

<div class="success">

    {{ session('success') }}

</div>

@endif
    <!-- STATUS CARD -->

    <div class="status-card">

        <h3>

            Today's Status

        </h3>

        @if($latestVisit)

            <p>

                Status:

                {{ $latestVisit->status }}

            </p>

            <p>

                Queue Number:

                {{ $latestVisit->queue_number ?? 'Not Assigned Yet' }}

            </p>

        @else

            <p>

                No active visit today.

            </p>

        @endif

    </div>

    <!-- ACTIONS -->

    <div class="actions">

        <a href="{{ route('visit.create') }}"

           class="btn">

           Start Visit

        </a>

        <a href="#" class="btn">
           View History

        </a>

    </div>

</div>

<!-- CHATBOT -->

@include('partials.chatbot')

</body>

</html>