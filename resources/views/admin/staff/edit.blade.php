<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Staff Member</title>

    <link rel="stylesheet"
          href="{{ asset('css/staff-form.css') }}">

</head>

<body>

<div class="container">

    <div class="form-card">

        <h1>Edit Staff Member</h1>

        @if($errors->any())

            <div class="errors">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('staff.update',$user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="input-group">

                    <label>First Name</label>

                    <input
                        type="text"
                        name="first_name"
                        value="{{ old('first_name',$user->first_name) }}"
                        required>

                </div>

                <div class="input-group">

                    <label>Last Name</label>

                    <input
                        type="text"
                        name="last_name"
                        value="{{ old('last_name',$user->last_name) }}"
                        required>

                </div>

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Employee ID</label>

                    <input
                        type="text"
                        value="{{ $user->employee_id }}"
                        disabled>

                </div>

                <div class="input-group">

                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username',$user->username) }}"
                        required>

                </div>

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email',$user->email) }}"
                        required>

                </div>

                <div class="input-group">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone',$user->phone) }}">

                </div>

            </div>

            <div class="row">

                <div class="input-group">

                    <label>Role</label>

                    <select name="role" required>

                        <option value="ADMIN"
                            {{ $user->role=='ADMIN'?'selected':'' }}>
                            Administrator
                        </option>

                        <option value="RECEPTIONIST"
                            {{ $user->role=='RECEPTIONIST'?'selected':'' }}>
                            Receptionist
                        </option>

                        <option value="STAFF_NURSE"
                            {{ $user->role=='STAFF_NURSE'?'selected':'' }}>
                            Staff Nurse
                        </option>

                        <option value="PROFESSIONAL_NURSE"
                            {{ $user->role=='PROFESSIONAL_NURSE'?'selected':'' }}>
                            Professional Nurse
                        </option>

                        <option value="DOCTOR"
                            {{ $user->role=='DOCTOR'?'selected':'' }}>
                            Doctor
                        </option>

                    </select>

                </div>

                <div class="input-group">

                    <label>Department</label>

                    <select name="department" required>

                        <option value="GENERAL_SCREENING"
                            {{ $user->department=='GENERAL_SCREENING'?'selected':'' }}>
                            General Screening
                        </option>

                        <option value="PEDIATRIC_SCREENING"
                            {{ $user->department=='PEDIATRIC_SCREENING'?'selected':'' }}>
                            Pediatric Screening
                        </option>

                        <option value="MATERNITY_SCREENING"
                            {{ $user->department=='MATERNITY_SCREENING'?'selected':'' }}>
                            Maternity Screening
                        </option>

                        <option value="GENERAL"
                            {{ $user->department=='GENERAL'?'selected':'' }}>
                            General
                        </option>

                        <option value="PEDIATRIC"
                            {{ $user->department=='PEDIATRIC'?'selected':'' }}>
                            Pediatrics
                        </option>

                        <option value="MATERNITY"
                            {{ $user->department=='MATERNITY'?'selected':'' }}>
                            Maternity
                        </option>

                        <option value="CHRONIC"
                            {{ $user->department=='CHRONIC'?'selected':'' }}>
                            Chronic Care
                        </option>

                    </select>

                </div>

            </div>

            <div class="input-group">

                <label>Specialty</label>

                <input
                    type="text"
                    name="specialty"
                    value="{{ old('specialty',$user->specialty) }}">

            </div>

            <div class="buttons">

                <button
                    type="submit"
                    class="save-btn">

                    Update Staff Member

                </button>

                <a href="{{ route('staff.index') }}"
                   class="cancel-btn">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>