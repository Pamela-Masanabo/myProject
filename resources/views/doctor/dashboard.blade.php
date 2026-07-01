<!DOCTYPE html>
<html>

<head>

<title>Doctor Dashboard</title>

<link rel="stylesheet"

href="{{ asset('css/doctor-dashboard.css') }}">

</head>

<body>

<div class="layout">

<div class="sidebar">

<h2>Doctor</h2>

<ul>

<li class="active">

Waiting Referrals

</li>

<li>

Completed Today

</li>

<li>

Logout

</li>

</ul>

</div>

<div class="main">

<h2>

Doctor Dashboard

</h2>

<p>

Patients referred by Professional Nurse.

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

Age

</th>

<th>

Priority

</th>

<th>

Referral Reason

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

{{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age }}

</td>

<td>

{{ $visit->screening->priority_level }}

</td>

<td>

{{ $visit->referral->referral_reason }}

</td>

<td>

<a href="{{ route('doctor.consultation',$visit->id) }}">

<button class="consult-btn">

Consult

</button>

</a>

</td>

</tr>

@empty

<tr>

<td colspan="6">

No referred patients.

</td>

</tr>

@endforelse

</table>

</div>

</div>

</body>

</html>