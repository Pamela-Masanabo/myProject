<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In</title>
    <link rel="stylesheet" href="{{ asset('css/check-in.css') }}">
</head>
<body>
    
<body>

<div class="container">

<div class="card">

<h2>🏥 Start Visit</h2>

<form

action="{{ route('visit.store') }}"

method="POST">

@csrf

<label>

Reason For Visit

</label>

<select

name="reason_for_visit"

required>

<option value="">

Select

</option>

<option value="GENERAL_CONSULTATION">

General Consultation

</option>

<option value="CHRONIC_MEDICATION">

Chronic Medication

</option>

<option value="PEDIATRIC_CARE">

Pediatric Care

</option>

<option value="MATERNITY">

Maternity

</option>

</select>

<h3>

Guardian Information

(Optional)

</h3>

<input

type="text"

name="guardian_name"

placeholder="Guardian Name">

<input

type="text"

name="guardian_relationship"

placeholder="Relationship">

<input

type="text"

name="guardian_phone"

placeholder="Phone Number">

<label>

Additional Notes

</label>

<textarea

name="additional_notes">

</textarea>

<button type="submit">

Start Visit

</button>

</form>

</div>

</div>

</body>

</html>