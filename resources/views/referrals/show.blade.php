<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Referral Details</title>

    <link rel="stylesheet"
          href="{{ asset('css/referral-show.css') }}">

</head>

<body>

<div class="container">

    <h1>Referral Details</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- Patient Information --}}
    <div class="card">

        <h2>Patient Information</h2>

        <table>

            <tr>
                <th>Patient Name</th>
                <td>{{ $referral->visit->patient->first_name }}
                    {{ $referral->visit->patient->last_name }}
                </td>
            </tr>

            <tr>
                <th>ID Number</th>
                <td>{{ $referral->visit->patient->id_number }}</td>
            </tr>

            <tr>
                <th>Gender</th>
                <td>{{ $referral->visit->patient->gender }}</td>
            </tr>

            <tr>
                <th>Age</th>
                <td>{{ $referral->visit->patient->age }}</td>
            </tr>

            <tr>
                <th>Phone</th>
                <td>{{ $referral->visit->patient->phone_number }}</td>
            </tr>

        </table>

    </div>

    {{-- Doctor Information --}}
    <div class="card">

        <h2>Doctor Information</h2>

        @php
            $consultation = $referral->visit->consultations->last();
        @endphp

        <table>

            <tr>
                <th>Doctor</th>
                <td>
                    {{ $referral->referrer->first_name }}
                    {{ $referral->referrer->last_name }}
                </td>
            </tr>

            <tr>
                <th>Date</th>
                <td>{{ $referral->created_at->format('d M Y') }}</td>
            </tr>

            <tr>
                <th>Diagnosis</th>
                <td>{{ $consultation->diagnosis ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Treatment</th>
                <td>{{ $consultation->treatment ?? 'N/A' }}</td>
            </tr>

        </table>

    </div>

    {{-- Referral Information --}}
    <div class="card">

        <h2>Referral Information</h2>

        <table>

            <tr>
                <th>Hospital</th>
                <td>{{ $referral->referral_hospital_name }}</td>
            </tr>

            <tr>
                <th>Specialist</th>
                <td>{{ $referral->specialist_name }}</td>
            </tr>

            <tr>
                <th>Reason for Referral</th>
                <td>{{ $referral->referral_reason }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    <span class="status">

                        {{ $referral->status }}

                    </span>

                </td>
            </tr>

        </table>

    </div>

    {{-- Action Buttons --}}
    <div class="actions">

        <a href="{{ route('referrals.letter',$referral->id) }}">

            <button class="print-btn">

                Print Referral Letter

            </button>

        </a>

        @if($referral->status == 'PENDING')

        <form action="{{ route('referrals.review',$referral->id) }}"
              method="POST">

            @csrf

            <button class="review-btn">

                Mark as Reviewed

            </button>

        </form>

        @endif

        @if($referral->status != 'COMPLETED')

        <form action="{{ route('referrals.complete',$referral->id) }}"
              method="POST">

            @csrf

            <button class="complete-btn">

                Mark as Completed

            </button>

        </form>

        @endif

        <a href="{{ route('referrals.dashboard') }}">

            <button class="back-btn">

                Back

            </button>

        </a>

    </div>

</div>

</body>

</html>