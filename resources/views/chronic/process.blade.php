<!DOCTYPE html>
<html>

<head>

    <title>

        Chronic Care Consultation

    </title>

    <link rel="stylesheet"

        href="{{ asset('css/chronic-process.css') }}">

</head>

<body>

    <div class="container">

        <h2>

            Chronic Care Consultation

        </h2>

        <!-- ============================= -->
        <!-- Patient Information -->
        <!-- ============================= -->

        <div class="card">

            <h3>

                Patient Information

            </h3>

            <div class="grid">

                <div>

                    <label>Queue Number</label>

                    <input
                        type="text"
                        value="{{ $visit->queue_number }}"
                        readonly>

                </div>

                <div>

                    <label>Patient Name</label>

                    <input
                        type="text"
                        value="{{ $visit->patient->first_name }} {{ $visit->patient->last_name }}"
                        readonly>

                </div>

                <div>

                    <label>Age</label>

                    <input
                        type="text"
                        value="{{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age }}"
                        readonly>

                </div>

                <div>

                    <label>Gender</label>

                    <input
                        type="text"
                        value="{{ $visit->patient->gender }}"
                        readonly>

                </div>

                <div>

                    <label>Condition</label>

                    <input
                        type="text"
                        value="{{ optional($visit->patient->chronicRecord)->condition }}"
                        readonly>

                </div>

            </div>

        </div>
        //Medical History

        <div class="card">

            <h3>

                Medication History

            </h3>

            <table>

                <tr>

                    <th>Date</th>

                    <th>Diagnosis</th>

                    <th>Medication</th>

                    <th>Consulted By</th>

                </tr>

                @forelse($visit->patient->consultations as $consultation)

                <tr>

                    <td>

                        {{ $consultation->created_at->format('d M Y') }}

                    </td>

                    <td>

                        {{ $consultation->diagnosis }}

                    </td>

                    <td>

                        {{ $consultation->medication }}

                    </td>

                    <td>

                        {{ $consultation->user->first_name }}

                        {{ $consultation->user->last_name }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4">

                        No previous medication history.

                    </td>

                </tr>

                @endforelse

            </table>

        </div>

        //Today Consultation
        <form
            method="POST"
            action="{{ route('chronic.store',$visit->id) }}">

            @csrf

            <div class="card">

                <h3>

                    Today's Consultation

                </h3>

                <label>

                    Diagnosis

                </label>

                <textarea
                    name="diagnosis"
                    required></textarea>

                <label>

                    Treatment

                </label>

                <textarea
                    name="treatment"
                    required></textarea>

                <label>

                    Medication

                </label>

                <textarea
                    name="medication"
                    required></textarea>

                <label>

                    Notes

                </label>

                <textarea
                    name="notes"></textarea>

                <button
                    class="save-btn">

                    Complete Visit

                </button>

            </div>

        </form>

    </div>

</body>

</html>