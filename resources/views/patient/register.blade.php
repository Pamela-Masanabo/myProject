<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link rel="stylesheet" href="{{ asset('css/patient-register.css') }}">
</head>

<body>
    <div class="container">

        <div class="card">

            <h2>🏥 Patient Registration</h2>

            <form

                action="{{ route('patient.store') }}"

                method="POST">

                @csrf

                <div class="grid">

                    <input

                        type="text"

                        name="first_name"

                        placeholder="First Name"

                        required>

                    <input

                        type="text"

                        name="last_name"

                        placeholder="Last Name"

                        required>

                </div>

                <input
                    type="text"
                    name="id_number"
                    value="{{ old('id_number') }}" 
                    minlength="13"
                    maxlength="13"
                    pattern="[0-9]{13}"
                    inputmode="numeric"
                    placeholder="ID Number"
                    required>

                <div class="grid">

                    <input

                        type="date"

                        name="date_of_birth"

                        required>

                    <select

                        name="gender"

                        required>

                        <option value="">

                            Gender

                        </option>

                        <option value="MALE">

                            Male

                        </option>

                        <option value="FEMALE">

                            Female

                        </option>

                    </select>

                </div>

<div class="grid">

                    <input
                    type="text"
                    name="phone"
                    placeholder="Phone Number"
                    minlength="10"
                    maxlength="10"
                    pattern="[0-9]{10}"
                    inputmode="numeric"
                    required>       

                    <input

                        type="text"

                        name="address"

                        placeholder="Home Address"

                        required>

                </div>            

                <button type="submit">

                    Register

                </button>

            </form>

        </div>

    </div>

</body>

</html>