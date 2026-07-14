<!DOCTYPE html>
<html>
<head>

    <title>Professional Nurse Consultation</title>

    <link rel="stylesheet" href="{{ asset('css/consultation.css') }}">

</head>
<body>

<div class="container">

    <h2>Professional Nurse Consultation</h2>

    <!-- ==========================
         PATIENT INFORMATION
    =========================== -->

    <div class="card">

        <h3>Patient Information</h3>

        <div class="grid">

            <div>

                <label>Queue Number</label>

                <input
                    type="text"
                    value="{{ $visit->queue_number }}"
                    readonly>

            </div>

            <div>

                <label>Visit Type</label>

                <input
                    type="text"
                    value="{{ str_replace('_',' ',$visit->reason_for_visit) }}"
                    readonly>

            </div>

            <div>

                <label>Patient Name</label>

                <input
                    type="text"
                    value="{{ $visit->patient->first_name }} {{ $visit->patient->last_name }}"
                    readonly>

            </div>

            <div>

                <label>Age</label>

                <input
                    type="text"
                    value="{{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age }}"
                    readonly>

            </div>

            <div>

                <label>Gender</label>

                <input
                    type="text"
                    value="{{ $visit->patient->gender }}"
                    readonly>

            </div>

            <div>

                <label>Race</label>

                <input
                    type="text"
                    value="{{ $visit->patient->race }}"
                    readonly>

            </div>

        </div>

    </div>

    <!-- ==========================
         SCREENING RESULTS
    =========================== -->

    <div class="card">

        <h3>Screening Results</h3>

        <div class="grid">

            <div>

                <label>Temperature</label>

                <input
                    type="text"
                    value="{{ $visit->screening->temperature }} °C"
                    readonly>

            </div>

            <div>

                <label>Blood Pressure</label>

                <input
                    type="text"
                    value="{{ $visit->screening->blood_pressure }}"
                    readonly>

            </div>

            <div>

                <label>Pulse Rate</label>

                <input
                    type="text"
                    value="{{ $visit->screening->pulse_rate }} bpm"
                    readonly>

            </div>

            <div>

                <label>Respiratory Rate</label>

                <input
                    type="text"
                    value="{{ $visit->screening->respiratory_rate }}"
                    readonly>

            </div>

            <div>

                <label>Oxygen Saturation</label>

                <input
                    type="text"
                    value="{{ $visit->screening->oxygen_saturation }}%"
                    readonly>

            </div>

            <div>

                <label>Weight</label>

                <input
                    type="text"
                    value="{{ $visit->screening->weight }} kg"
                    readonly>

            </div>

            <div>

                <label>Height</label>

                <input
                    type="text"
                    value="{{ $visit->screening->height }} cm"
                    readonly>

            </div>

            <div>

                <label>BMI</label>

                <input
                    type="text"
                    value="{{ $visit->screening->bmi }}"
                    readonly>

            </div>

        </div>

        <label>Symptoms</label>

        <textarea readonly>{{ $visit->screening->symptoms }}</textarea>

        <label>Priority Level</label>

        <input
            type="text"
            value="{{ $visit->screening->priority_level }}"
            readonly>

    </div>

    <!-- ==========================
         CONSULTATION
    =========================== -->

    <form
        action="{{ route('consultation.store',$visit->id) }}"
        method="POST">

        @csrf

        <div class="card">

            <h3>Consultation</h3>

            <label>Diagnosis</label>

            <textarea
                name="diagnosis"
                rows="4"
                required></textarea>

            <label>Treatment</label>

            <textarea
                name="treatment"
                rows="4"
                required></textarea>

            <label>Medication</label>

            <textarea
                name="medication"
                rows="4"
                required></textarea>

            <label>Consultation Notes</label>

            <textarea
                name="notes"
                rows="4"></textarea>

        </div>

        <!-- ==========================
             CLINICAL DECISIONS
        =========================== -->

        <div class="card">

            <h3>Clinical Decisions</h3>

            <div class="checkbox">

                <input
                    type="checkbox"
                    id="doctor"
                    name="referred_to_doctor">

                <label for="doctor">

                    Refer Patient to Doctor

                </label>

            </div>

            <div class="checkbox">

                <input
                    type="checkbox"
                    id="chronic"
                    name="enrol_chronic">

                <label for="chronic">

                    Enrol into Chronic Care

                </label>

            </div>

            @if($visit->patient->gender == 'FEMALE')

            <div class="checkbox">

                <input
                    type="checkbox"
                    id="maternity"
                    name="enrol_maternity">

                <label for="maternity">

                    Enrol into Maternity

                </label>

            </div>

            @endif

        </div>

        <!-- ==========================
             MATERNITY DETAILS
        =========================== -->

        @if($visit->patient->gender == 'FEMALE')

        <div
            id="maternitySection"
            class="card"
            style="display:none;">

            <h3>Maternity Information</h3>

            <label>Last Menstrual Period (LMP)</label>

            <input
                type="date"
                id="lmp"
                name="lmp_date">

            <label>Estimated Due Date (EDD)</label>

            <input
                type="date"
                id="edd"
                readonly>

            <label>Pregnancy Number</label>

            <input
                type="number"
                name="pregnancy_number">

            <div class="checkbox">

                <input
                    type="checkbox"
                    id="risk"
                    name="high_risk">

                <label for="risk">

                    High Risk Pregnancy

                </label>

            </div>

        </div>

        @endif

        <button
            type="submit"
            class="save-btn">

            Complete Consultation

        </button>

    </form>

</div>

@if($visit->patient->gender == 'FEMALE')

<script>

const maternity =
document.getElementById("maternity");

const section =
document.getElementById("maternitySection");

maternity.addEventListener("change",function(){

    if(this.checked){

        section.style.display="block";

    }

    else{

        section.style.display="none";

    }

});

document.getElementById("lmp")

.addEventListener("change",function(){

    let lmp = new Date(this.value);

    lmp.setDate(lmp.getDate()+280);

    document.getElementById("edd").value =
    lmp.toISOString().split("T")[0];

});

</script>

@endif

</body>
</html>