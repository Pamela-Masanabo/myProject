<!DOCTYPE html>
<html>
<head>
    <title>Room Management</title>
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
            <h2>Room Management</h2>
            <p>Manage clinic rooms and departments</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="actions">
            <a href="{{ route('rooms.create') }}" class="btn">
                + Add Room
            </a>
        </div>

        <div class="card">

            <h3>Clinic Rooms</h3>

            @if($rooms->count() > 0)

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room Name</th>
                            <th>Department</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rooms as $room)

                            <tr>

                                <td>
                                    {{ $room->id }}
                                </td>

                                <td>
                                    {{ $room->name }}
                                </td>

                                <td>
                                    {{ str_replace('_', ' ', $room->department) }}
                                </td>

                                <td>
                                    {{ $room->room_type ?? 'Not specified' }}
                                </td>

                                <td>

                                    @if($room->is_active)
                                        <span>Active</span>
                                    @else
                                        <span>Inactive</span>
                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('rooms.edit', $room) }}">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('rooms.status', $room) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit">
                                            {{ $room->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>

            @else

                <p>No rooms have been added yet.</p>

            @endif

        </div>

    </div>

</div>

</body>
</html>