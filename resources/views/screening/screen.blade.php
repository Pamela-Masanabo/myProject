<!DOCTYPE html>
<html>

<head>

    <title>Patient Screening</title>

    <link rel="stylesheet"
          href="{{ asset('css/screening.css') }}">

</head>

<body>

<div class="container">

    <h2>Patient Screening</h2>

    <div class="patient-info">

        <h3>

            {{ $visit->patient->first_name }}

            {{ $visit->patient->last_name }}

        </h3>

        <p>

            Queue Number:

            <strong>{{ $visit->queue_number }}</strong>

        </p>

    </div>

    <form action="{{ route('screening.store',$visit->id) }}"
          method="POST">

        @csrf

        <div class="grid">

            <div>

                <label>Temperature (°C)</label>

                <input type="number"
                       step="0.1"
                       name="temperature"
                       required>

            </div>

            <div>

                <label>Blood Pressure</label>

                <input type="text"
                       name="blood_pressure"
                       placeholder="120/80"
                       required>

            </div>

            <div>

                <label>Pulse Rate</label>

                <input type="number"
                       name="pulse_rate"
                       required>

            </div>

            <div>

                <label>Respiratory Rate</label>

                <input type="number"
                       name="respiratory_rate"
                       required>

            </div>

            <div>

                <label>Oxygen Saturation (%)</label>

                <input type="number"
                       name="oxygen_saturation"
                       required>

            </div>

            <div>

                <label>Weight (kg)</label>

                <input type="number"
                       step="0.1"
                       id="weight"
                       name="weight"
                       required>

            </div>

            <div>

                <label>Height (cm)</label>

                <input type="number"
                       id="height"
                       name="height"
                       required>

            </div>

            <div>

                <label>BMI</label>

                <input type="text"
                       id="bmi"
                       readonly>

            </div>

        </div>

        <label>Symptoms</label>

        <textarea name="symptoms"
                  rows="5"
                  required></textarea>

        <label>Priority Level</label>

        <select name="priority_level" required>

            <option value="">Select</option>

            <option value="NORMAL">Normal</option>

            <option value="HIGH">High</option>

            <option value="EMERGENCY">Emergency</option>

        </select>

        <button type="submit">

            Save Screening

        </button>

    </form>

</div>

<script>

const weight=document.getElementById("weight");
const height=document.getElementById("height");
const bmi=document.getElementById("bmi");

function calculateBMI(){

    if(weight.value && height.value){

        let h=height.value/100;

        bmi.value=(weight.value/(h*h)).toFixed(2);

    }

}

weight.addEventListener("input",calculateBMI);

height.addEventListener("input",calculateBMI);

</script>

</body>

</html>