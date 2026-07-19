<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Staff</title>

    <link rel="stylesheet"
          href="{{ asset('css/staff-form.css') }}">

</head>

<body>

<div class="container">

    <div class="form-card">

        <h1>Add New Staff Member</h1>

        @if ($errors->any())

            <div class="errors">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('staff.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="input-group">

                    <label>First Name</label>

                    <input
                        type="text"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        required>

                </div>

                <div class="input-group">

                    <label>Last Name</label>

                    <input
                        type="text"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        required>

                </div>

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Employee ID</label>

                    <input
                        type="text"
                        name="employee_id"
                        value="{{ old('employee_id') }}"
                        required>

                </div>

                <div class="input-group">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required>

                </div>

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required>

                </div>

                <div class="input-group">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}">

                </div>

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Role</label>

                    <select name="role" required>

                        <option value="">Select Role</option>

                        <option value="ADMIN">Administrator</option>

                        <option value="RECEPTIONIST">Receptionist</option>

                        <option value="STAFF_NURSE">Staff Nurse</option>

                        <option value="PROFESSIONAL_NURSE">Professional Nurse</option>

                        <option value="DOCTOR">Doctor</option>

                    </select>

                </div>

                <div class="input-group">

                    <label>Department</label>

                    <select name="department" required>

                        <option value="">Select Department</option>

                        <option value="GENERAL_SCREENING">General Screening</option>

                        <option value="PEDIATRIC_SCREENING">Pediatric Screening</option>

                        <option value="MATERNITY_SCREENING">Maternity Screening</option>

                        <option value="GENERAL">General</option>

                        <option value="PEDIATRIC">Pediatrics</option>

                        <option value="MATERNITY">Maternity</option>

                        <option value="CHRONIC">Chronic Care</option>

                    </select>

                </div>

            </div>

            <div class="input-group">

                <label>Specialty</label>

                <input
                    type="text"
                    name="specialty"
                    value="{{ old('specialty') }}">

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        required>

                </div>

                <div class="input-group">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required>

                </div>

            </div>

            <div class="buttons">

                <button type="submit" class="save-btn">

                    Save Staff Member

                </button>

                <a href="{{ route('staff.index') }}" class="cancel-btn">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>