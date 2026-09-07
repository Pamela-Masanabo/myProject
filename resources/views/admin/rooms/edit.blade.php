<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <link rel="stylesheet" href="{{ asset('css/room.css') }}">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Admin</h2>

        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>

            <li class="active">
                Room Management
            </li>

            <li>
                <a href="{{ route('staff.index') }}">Staff Management</a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="header">
            <h2>Edit Room</h2>
            <p>Update room information</p>
        </div>

        <div class="card">

            <form
                action="{{ route('rooms.update', $room) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <label>Room Name / Number</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $room->name) }}"
                    required
                >

                @error('name')
                    <p>{{ $message }}</p>
                @enderror


                <label>Department</label>

                <select name="department" required>

                    <option value="RECEPTION"
                        {{ old('department', $room->department) == 'RECEPTION' ? 'selected' : '' }}>
                        Reception
                    </option>

                    <option value="SCREENING"
                        {{ old('department', $room->department) == 'SCREENING' ? 'selected' : '' }}>
                        Screening
                    </option>

                    <option value="CONSULTATION"
                        {{ old('department', $room->department) == 'CONSULTATION' ? 'selected' : '' }}>
                        Consultation
                    </option>

                    <option value="MATERNITY"
                        {{ old('department', $room->department) == 'MATERNITY' ? 'selected' : '' }}>
                        Maternity
                    </option>

                    <option value="CHRONIC"
                        {{ old('department', $room->department) == 'CHRONIC' ? 'selected' : '' }}>
                        Chronic Care
                    </option>

                    <option value="ADMINISTRATION"
                        {{ old('department', $room->department) == 'ADMINISTRATION' ? 'selected' : '' }}>
                        Administration
                    </option>

                </select>


                <label>Room Type</label>

                <input
                    type="text"
                    name="room_type"
                    value="{{ old('room_type', $room->room_type) }}"
                    placeholder="Example: Examination Room"
                >

                @error('room_type')
                    <p>{{ $message }}</p>
                @enderror


                <div class="actions">

                    <button type="submit">
                        Update Room
                    </button>

                    <a href="{{ route('rooms.index') }}">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>