<!DOCTYPE html>
<html>

<head>

    <title>Professional Nurse Dashboard</title>

    <link rel="stylesheet"
          href="{{ asset('css/professional-dashboard.css') }}">

</head>

<body>

<div class="layout">

<div class="sidebar">

<h2>Professional Nurse</h2>

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

<div class="main">

<h2>

Professional Nurse Dashboard

</h2>

<p>

Patients waiting for consultation.

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

{{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age }}

</td>

<td>

<span class="priority">

{{ $visit->screening->priority_level }}

</span>

</td>

<td>

{{ $visit->created_at->format('H:i') }}

</td>

<td>

<a href="{{ route('professional.consultation',$visit->id) }}">

<button class="consult-btn">

Consult

</button>

</a>

</td>

</tr>

@empty

<tr>

<td colspan="6">

No patients waiting.

</td>

</tr>

@endforelse

</table>

</div>

</div>

</body>

</html>