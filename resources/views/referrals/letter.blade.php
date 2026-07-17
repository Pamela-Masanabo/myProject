<!DOCTYPE html>
<html>

<head>

    <title>Hospital Referral Letter</title>

    <link rel="stylesheet"
          href="{{ asset('css/referral-letter.css') }}">

</head>

<body>

<div class="letter-container">

    <div class="header">

        <h1>PUBLIC CLINIC</h1>

        <h2>HOSPITAL REFERRAL LETTER</h2>

    </div>

    <hr>

    <h3>Patient Information</h3>

    <table class="info-table">

        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $referral->visit->patient->first_name }}
                {{ $referral->visit->patient->last_name }}
            </td>
        </tr>

        <tr>
            <td><strong>ID Number</strong></td>
            <td>{{ $referral->visit->patient->id_number }}</td>
        </tr>

        <tr>
            <td><strong>Gender</strong></td>
            <td>{{ $referral->visit->patient->gender }}</td>
        </tr>

        <tr>
            <td><strong>Age</strong></td>
            <td>{{ $referral->visit->patient->age }}</td>
        </tr>

    </table>

    <h3>Clinical Information</h3>

    @php
        $consultation = $referral->visit->consultations->last();
    @endphp

    <table class="info-table">

        <tr>
            <td><strong>Diagnosis</strong></td>
            <td>{{ $consultation->diagnosis ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td><strong>Treatment Given</strong></td>
            <td>{{ $consultation->treatment ?? 'N/A' }}</td>
        </tr>

        <tr>
            <td><strong>Reason for Referral</strong></td>
            <td>{{ $referral->referral_reason }}</td>
        </tr>

    </table>

    <h3>Receiving Hospital</h3>

    <table class="info-table">

        <tr>
            <td><strong>Hospital</strong></td>
            <td>{{ $referral->referral_hospital_name }}</td>
        </tr>

        <tr>
            <td><strong>Specialist</strong></td>
            <td>{{ $referral->specialist_name }}</td>
        </tr>

    </table>

    <br><br>

    <table class="signature-table">

        <tr>

            <td>

                ______________________

                <br>

                Doctor Signature

            </td>

            <td>

                ______________________

                <br>

                Clinic Stamp

            </td>

        </tr>

    </table>

    <br>

    <p>

        Date:
        {{ now()->format('d M Y') }}

    </p>

    <div class="buttons">

        <button onclick="window.print()">

            Print Letter

        </button>

        <a href="{{ route('referrals.show',$referral->id) }}">

            <button>

                Back

            </button>

        </a>

    </div>

</div>

</body>

</html>