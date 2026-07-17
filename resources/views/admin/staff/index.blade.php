<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Management</title>

    <link rel="stylesheet" href="{{ asset('css/staff-index.css') }}">

</head>

<body>

<div class="layout">

    <!-- Sidebar -->
    <div class="sidebar">

        <h2>Clinic Admin</h2>

        <ul>

            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>

            <li class="active">
                <a href="{{ route('staff.index') }}">Staff Management</a>
            </li>

            <li>
                <a href="#">Room Management</a>
            </li>

            <li>
                <a href="#">Reports</a>
            </li>

            <li>
                <a href="{{ route('referrals.dashboard') }}">Referrals</a>
            </li>

            <li>
                <a href="#">Logout</a>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="main">

        <div class="page-header">

            <h1>Staff Management</h1>

            <a href="{{ route('staff.create') }}" class="add-btn">

                + Add Staff

            </a>

        </div>

        @if(session('success'))

            <div class="success">

                {{ session('success') }}

            </div>

        @endif

        <!-- Search & Filter -->

        <form method="GET" action="{{ route('staff.index') }}">

            <div class="filters">

                <input
                    type="text"
                    name="search"
                    placeholder="Search by name or Employee ID..."
                    value="{{ request('search') }}">

                <select name="role">

                    <option value="">All Roles</option>

                    <option value="ADMIN"
                        {{ request('role') == 'ADMIN' ? 'selected' : '' }}>
                        Administrator
                    </option>

                    <option value="RECEPTIONIST"
                        {{ request('role') == 'RECEPTIONIST' ? 'selected' : '' }}>
                        Receptionist
                    </option>

                    <option value="STAFF_NURSE"
                        {{ request('role') == 'STAFF_NURSE' ? 'selected' : '' }}>
                        Staff Nurse
                    </option>

                    <option value="PROFESSIONAL_NURSE"
                        {{ request('role') == 'PROFESSIONAL_NURSE' ? 'selected' : '' }}>
                        Professional Nurse
                    </option>

                    <option value="DOCTOR"
                        {{ request('role') == 'DOCTOR' ? 'selected' : '' }}>
                        Doctor
                    </option>

                </select>

                <button type="submit">

                    Search

                </button>

            </div>

        </form>

        <!-- Staff Table -->

        <div class="table-container">

            <table>

                <thead>

                <tr>

                    <th>Employee ID</th>

                    <th>Name</th>

                    <th>Role</th>

                    <th>Department</th>

                    <th>Status</th>

                    <th>Actions</th>

                </tr>

                </thead>

                <tbody>

                @forelse($staff as $member)

                    <tr>

                        <td>{{ $member->employee_id }}</td>

                        <td>

                            {{ $member->first_name }}

                            {{ $member->last_name }}

                        </td>

                        <td>{{ str_replace('_',' ', $member->role) }}</td>

                        <td>{{ str_replace('_',' ', $member->department) }}</td>

                        <td>

                            @if($member->is_active)

                                <span class="badge active">

                                    Active

                                </span>

                            @else

                                <span class="badge inactive">

                                    Inactive

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('staff.edit',$member->id) }}"
                               class="edit-btn">

                                Edit

                            </a>

                            <form
                                action="{{ route('staff.status',$member->id) }}"
                                method="POST"
                                class="inline-form">

                                @csrf

                                @method('PATCH')

                                <button
                                    class="{{ $member->is_active ? 'deactivate-btn' : 'activate-btn' }}">

                                    {{ $member->is_active ? 'Deactivate' : 'Activate' }}

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6">

                            No staff members found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="pagination">

            {{ $staff->links() }}

        </div>

    </div>

</div>

</body>

</html>