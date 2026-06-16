<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h3> Total Staff: {{ $staffCount }}</h3>

    <a href="{{ route('staff.create') }}">
          
        Register New Staff

    </a>
</body>
</html>