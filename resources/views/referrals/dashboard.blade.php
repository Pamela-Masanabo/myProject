<!DOCTYPE html>
<html>

<head>

    <title>Referral Management</title>

    <link rel="stylesheet"
        href="{{ asset('css/referral-dashboard.css') }}">

</head>

<body>

    <div class="layout">

        <div class="sidebar">

            <h2>

                Referral Management

            </h2>

            <ul>

                <li class="active">

                    Pending Referrals

                </li>

                <li>

                    Completed

                </li>

                <li>

                    Logout

                </li>

            </ul>

        </div>

        <div class="main">

            <h2>

                Hospital Referrals

            </h2>

            <p>

                Manage hospital referrals created by doctors.

            </p>

            <div class="cards">

                <div class="card">

                    <h1>

                        {{ $referrals->count() }}

                    </h1>

                    <p>

                        Total Referrals

                    </p>

                </div>

            </div>

            <table>

                <thead>

                    <tr>

                        <th>

                            Patient

                        </th>

                        <th>

                            Hospital

                        </th>

                        <th>

                            Doctor

                        </th>

                        <th>

                            Status

                        </th>

                        <th>

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($referrals as $referral)

                    <tr>

                        <td>

                            {{ $referral->visit->patient->first_name }}

                            {{ $referral->visit->patient->last_name }}

                        </td>

                        <td>

                            {{ $referral->referral_hospital_name }}

                        </td>

                        <td>

                            {{ $referral->referrer->first_name }}

                            {{ $referral->referrer->last_name }}

                        </td>

                        <td>

                            <span class="status">

                                {{ $referral->status }}

                            </span>

                        </td>

                        <td>

                            <a href="{{ route('referrals.show',$referral->id) }}">

                                <button class="view-btn">

                                    View

                                </button>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            No referrals found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>