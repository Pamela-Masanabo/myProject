<!DOCTYPE html>
<html>

<head>

    <title>Maternity Consultation</title>

    <link rel="stylesheet"
        href="{{ asset('css/maternity-consultation.css') }}">

</head>

<body>

    <div class="container">

        <h2>Maternity Consultation</h2>

        <!-- ========================================= -->
        <!-- PATIENT INFORMATION -->
        <!-- ========================================= -->

        <div class="card">

            <h3>Patient Information</h3>

            <div class="grid">

                <div>

                    <label>Queue Number</label>

                    <input type="text"
                        value="{{ $visit->queue_number }}"
                        readonly>

                </div>

                <div>

                    <label>Patient Name</label>

                    <input type="text"
                        value="{{ $visit->patient->first_name }} {{ $visit->patient->last_name }}"
                        readonly>

                </div>

                <div>

                    <label>Age</label>

                    <input type="text"
                        value="{{ $visit->patient->age }}"
                        readonly>

                </div>

                <div>

                    <label>Gender</label>

                    <input type="text"
                        value="{{ $visit->patient->gender }}"
                        readonly>

                </div>

            </div>

        </div>

        <!-- ========================================= -->
        <!-- PREGNANCY INFORMATION -->
        <!-- ========================================= -->

        <div class="card">

            <h3>Pregnancy Information</h3>

            <div class="grid">

                <div>

                    <label>Last Menstrual Period (LMP)</label>

                    <input type="text"
                        value="{{ optional($maternity)->lmp_date }}"
                        readonly>

                </div>

                <div>

                    <label>Estimated Due Date (EDD)</label>

                    <input type="text"
                        value="{{ optional($maternity)->edd_date }}"
                        readonly>

                </div>

                <div>

                    <label>Pregnancy Number</label>

                    <input type="text"
                        value="{{ optional($maternity)->pregnancy_number }}"
                        readonly>

                </div>

                <div>

                    <label>High Risk Pregnancy</label>

                    <input type="text"
                        value="{{ optional($maternity)->high_risk ? 'YES' : 'NO' }}"
                        readonly>

                </div>

            </div>

        </div>

          <!-- ========================================= -->
<!-- PREGNANCY SUMMARY -->
<!-- ========================================= -->

<div class="card">

    <h3>Pregnancy Summary</h3>

    <div class="summary-grid">

        <div class="summary-box">

            <h4>Weeks Pregnant</h4>

            <h2>{{ $weeks ?? 'N/A' }}</h2>

        </div>

        <div class="summary-box">

            <h4>Trimester</h4>

            <h2>{{ $trimester ?? 'N/A' }}</h2>

        </div>

        <div class="summary-box">

            <h4>Expected Due Date</h4>

            <h2>{{ optional($maternity)->edd_date }}</h2>

        </div>

        <div class="summary-box">

            <h4>High Risk</h4>

            <h2>

                {{ optional($maternity)->high_risk ? 'YES' : 'NO' }}

            </h2>

        </div>

    </div>

</div>

        <!-- ========================================= -->
        <!-- SCREENING RESULTS -->
        <!-- ========================================= -->

        <div class="card">

            <h3>Screening Results</h3>

            <div class="grid">

                <div>

                    <label>Temperature</label>

                    <input type="text"
                        value="{{ $visit->screening->temperature }} °C"
                        readonly>

                </div>

                <div>

                    <label>Blood Pressure</label>

                    <input type="text"
                        value="{{ $visit->screening->blood_pressure }}"
                        readonly>

                </div>

                <div>

                    <label>Pulse Rate</label>

                    <input type="text"
                        value="{{ $visit->screening->pulse_rate }}"
                        readonly>

                </div>

                <div>

                    <label>Respiratory Rate</label>

                    <input type="text"
                        value="{{ $visit->screening->respiratory_rate }}"
                        readonly>

                </div>

                <div>

                    <label>Weight</label>

                    <input type="text"
                        value="{{ $visit->screening->weight }} kg"
                        readonly>

                </div>

                <div>

                    <label>Height</label>

                    <input type="text"
                        value="{{ $visit->screening->height }} cm"
                        readonly>

                </div>

            </div>

            <label>Symptoms</label>

            <textarea readonly>{{ $visit->screening->symptoms }}</textarea>

        </div>

        <!-- ========================================= -->
        <!-- CONSULTATION -->
        <!-- ========================================= -->

        <form method="POST"
            action="{{ route('maternity.store',$visit->id) }}">

            @csrf

            <div class="card">

                <h3>Consultation</h3>

                <label>Diagnosis</label>

                <textarea name="diagnosis"
                    required></textarea>

                <label>Treatment</label>

                <textarea name="treatment"
                    required></textarea>

                <label>Medication</label>

                <textarea name="medication"
                    required></textarea>

                <label>Consultation Notes</label>

                <textarea name="notes"></textarea>

                <div class="checkbox">

                    <input type="checkbox"
                        id="doctor"
                        name="referred_to_doctor">

                    <label for="doctor">

                        Refer Patient to Doctor

                    </label>

                </div>

                <button class="save-btn">

                    Complete Consultation

                </button>

            </div>

        </form>

    </div>

</body>

</html>