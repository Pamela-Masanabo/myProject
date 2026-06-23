<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Clinic System</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">   
</head>
<body>
<div class="background-languages">

    <span>Welcome</span>

    <span>Wamkelekile</span>

    <span>Siyakwamukela</span>

    <span>Amogela</span>

    <span>Le amogetswe</span>

    <span>Ri amukela</span>

    <span>Re a le amogela</span>

    <span>Mi amukeriwile</span>

    <span>Welkom</span>

    <span>Nemukelekile</span>

    <span>Amukelekile</span>

</div>

<div class="container">

    <div class="card">

        <h1>🏥 Public Clinic System</h1>

        <p>

            Your health, our priority.

        </p>

        <a href="{{ route('patient.login') }}"

           class="btn">

            Login With ID Number

        </a>

        <p>

            Are you new here?

        </p>

        <a href="{{ route('patient.register') }}"

           class="btn secondary">

            Register

        </a>

        <div class="staff-section">

            <a href="/login"

               class="staff-btn">

                Staff

            </a>

        </div>

    </div>

</div>

</body>

</html>