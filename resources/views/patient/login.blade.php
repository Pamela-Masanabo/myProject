<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <link rel="stylesheet" href="{{ asset('css/patient-login.css') }}">
</head>
<body>
<div class="container">

    <div class="card">

        <h2>🏥 Patient Login</h2>

        <p>

            Enter your ID Number

        </p>

        <form action="{{ route('patient.login.store') }}"

              method="POST">

            @csrf

            <input

                type="text"

                name="id_number"

                placeholder="ID Number"

                required>

            @error('id_number')

            <p class="error">

                {{ $message }}

            </p>

            @enderror

            <button type="submit">

                Login

            </button>

        </form>

        <a href="{{ route('patient.register') }}">

            Are you new here?

            Register

        </a>

    </div>

</div>

</body>
</html>