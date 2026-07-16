<!DOCTYPE html>
<html>

<head>

    <title>Medical History</title>

    <link rel="stylesheet"
          href="{{ asset('css/patient-history.css') }}">

</head>

<body>

<div class="container">

<h1>Medical History</h1>

<p>

View all your previous clinic visits.

</p>

@forelse($patient->visits->sortByDesc('created_at') as $visit)

<div class="history-card">

    <div class="history-header">

        <div>

            <h3>

                {{ \Carbon\Carbon::parse($visit->created_at)->format('d F Y') }}

            </h3>

            <p>

                Queue :

                {{ $visit->queue_number }}

            </p>

            <p>

                Reason :

                {{ str_replace('_',' ',$visit->reason_for_visit) }}

            </p>

            <p>

                Status :

                {{ $visit->status }}

            </p>

        </div>

        <button

            class="toggle-btn"

            onclick="toggleDetails({ $visit:id })"> //to be reviewed

            View Details

        </button>

    </div>

    <div

        class="details"

        id="details{{ $visit->id }}">

        <!-- ===================== -->
        <!-- SCREENING -->
        <!-- ===================== -->

        <div class="section">

            <h4>

                Screening Results

            </h4>

            @if($visit->screening)

            <div class="grid">

                <div>

                    Blood Pressure

                    <strong>

                        {{ $visit->screening->blood_pressure }}

                    </strong>

                </div>

                <div>

                    Temperature

                    <strong>

                        {{ $visit->screening->temperature }} °C

                    </strong>

                </div>

                <div>

                    Weight

                    <strong>

                        {{ $visit->screening->weight }} kg

                    </strong>

                </div>

                <div>

                    Height

                    <strong>

                        {{ $visit->screening->height }} cm

                    </strong>

                </div>

            </div>

            @else

            <p>

                No screening information available.

            </p>

            @endif

        </div>

        <!-- ===================== -->
        <!-- CONSULTATIONS -->
        <!-- ===================== -->

        <div class="section">

            <h4>

                Consultation

            </h4>

            @forelse($visit->consultations as $consultation)

            <div class="consultation-box">

                <h5>

                    {{ str_replace('_',' ',$consultation->consultation_type) }}

                </h5>

                <p>

                    <strong>Diagnosis:</strong>

                    {{ $consultation->diagnosis }}

                </p>

                <p>

                    <strong>Treatment:</strong>

                    {{ $consultation->treatment }}

                </p>

                <p>

                    <strong>Medication:</strong>

                    {{ $consultation->medication }}

                </p>

            </div>

            @empty

            <p>

                No consultation available.

            </p>

            @endforelse

        </div>

        <!-- ===================== -->
        <!-- REFERRAL -->
        <!-- ===================== -->

        <div class="section">

            <h4>

                Referral

            </h4>

            @if($visit->referral)

                <p>

                    Hospital Referral :

                    <span class="yes">

                        YES

                    </span>

                </p>

                <p>

                    Status :

                    {{ $visit->referral->status }}

                </p>

            @else

                <p>

                    Hospital Referral :

                    <span class="no">

                        NO

                    </span>

                </p>

            @endif

        </div>

    </div>

</div>

@empty

<div class="empty">

No medical history found.

</div>

@endforelse

</div>

<script>

function toggleDetails(id){

    let details = document.getElementById("details"+id);

    if(details.style.display==="block"){

        details.style.display="none";

    }

    else{

        details.style.display="block";

    }

}

</script>

</body>

</html>