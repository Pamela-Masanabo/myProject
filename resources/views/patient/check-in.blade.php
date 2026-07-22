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

<label>Reason For Visit</label>

<select name="reason" required>

<option value="">Select Reason</option>

@foreach($visitTypes as $visit)

        <option value="{{ $visit['value'] }}">

            {{ $visit['label'] }}

        </option>

    @endforeach

</select>

<!-- Guadian Information Section -->

<div id="guardianSection" style="display:none;">

    <h3>Guardian Information</h3>

    <input type="text"
           name="guardian_name"
           placeholder="Guardian Name">

    <input type="text"
           name="guardian_relationship"
           placeholder="Relationship">

    <input type="text"
           name="guardian_contact"
           placeholder="Phone Number">

</div>

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

<!-- JavaScript to toggle guardian section based on visit reason -->
 <script>

const reason = document.querySelector('[name="reason"]');
const guardian = document.getElementById('guardianSection');

reason.addEventListener('change', function(){

    if(this.value === 'PEDIATRIC_CARE'){

        guardian.style.display = 'block';

    }else{

        guardian.style.display = 'none';
    }

});

</script>