<!DOCTYPE html>
<html>

<head>

    <title>Doctor Consultation</title>

    <link rel="stylesheet"
          href="{{ asset('css/doctor-consultation.css') }}">

</head>

<body>

<div class="container">

<h2>Doctor Consultation</h2>

<!-- ===================================== -->
<!-- PATIENT INFORMATION -->
<!-- ===================================== -->

<div class="card">

<h3>Patient Information</h3>

<div class="grid">

<div>

<label>Queue</label>

<input
type="text"
value="{{ $visit->queue_number }}"
readonly>

</div>

<div>

<label>Patient</label>

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

<label>Visit Reason</label>

<input
type="text"
value="{{ str_replace('_',' ',$visit->reason_for_visit) }}"
readonly>

</div>

</div>

</div>

<!-- ===================================== -->
<!-- SCREENING -->
<!-- ===================================== -->

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

<label>Pulse</label>

<input
type="text"
value="{{ $visit->screening->pulse_rate }}"
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
value="{{ $visit->screening->oxygen_saturation }}"
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

</div>
<!-- ===================================== -->
<!-- Professional Nurse Consultation -->
<!-- ===================================== -->

<div class="card">

<h3>Professional Nurse Consultation</h3>

<label>Diagnosis</label>

<textarea readonly>

{{ $visit->consultations->where('consultation_type','PROFESSIONAL_NURSE')->first()->diagnosis }}

</textarea>

<label>Treatment</label>

<textarea readonly>

{{ $visit->consultations->where('consultation_type','PROFESSIONAL_NURSE')->first()->treatment }}

</textarea>

<label>Medication</label>

<textarea readonly>

{{ $visit->consultations->where('consultation_type','PROFESSIONAL_NURSE')->first()->medication }}

</textarea>

<label>Notes</label>

<textarea readonly>

{{ $visit->consultations->where('consultation_type','PROFESSIONAL_NURSE')->first()->notes }}

</textarea>

</div>

<!-- ===================================== -->
<!-- Doctor Consultation Form -->
<!-- ===================================== -->

<form
method="POST"
action="{{ route('doctor.store',$visit->id) }}">

@csrf

<div class="card">

<h3>Doctor Consultation</h3>

<label>Diagnosis</label>

<textarea
name="diagnosis"
required></textarea>

<label>Treatment</label>

<textarea
name="treatment"
required></textarea>

<label>Medication</label>

<textarea
name="medication"
required></textarea>

<label>Doctor Notes</label>

<textarea
name="notes"></textarea>

<div class="checkbox">

<input
type="checkbox"
id="hospital"
name="hospital_referral">

<label for="hospital">

Refer Patient To Hospital

</label>

</div>

<button
class="save-btn">

Complete Consultation

</button>

</div>

</form>

</div>

</body>

</html>
