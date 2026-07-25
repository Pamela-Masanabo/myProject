<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Patient Check-In</title>

    <link rel="stylesheet"
          href="{{ asset('css/check-in.css') }}">

</head>

<body>

<div class="container">

    <div class="card">

        <h2>🏥 Start Visit</h2>

        <p class="subtitle">
            Please provide the information below to start your clinic visit.
        </p>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="error-message">

                <strong>Please correct the following:</strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Check-In Form --}}
        <form action="{{ route('visit.store') }}"
              method="POST">

            @csrf


            {{-- Reason For Visit --}}
            <div class="form-group">

                <label for="reason">
                    Reason For Visit
                </label>

                <select
                    name="reason"
                    id="reason"
                    required>

                    <option value="">
                        Select Reason
                    </option>

                    @foreach($visitTypes as $visit)

                        <option
                            value="{{ $visit['value'] }}"
                            {{ old('reason') == $visit['value'] ? 'selected' : '' }}>

                            {{ $visit['label'] }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Guardian Information --}}
            <div
                @if($age < 18)

    <div class="guardian-section">

        <h3>Guardian Information</h3>

        <p class="section-note">
            Guardian information is required for patients under 18.
        </p>

        <div class="form-group">
            <label for="guardian_name">Guardian Name</label>

            <input
                type="text"
                id="guardian_name"
                name="guardian_name"
                value="{{ old('guardian_name') }}"
                placeholder="Enter guardian full name"
                required>
        </div>

        <div class="form-group">
            <label for="guardian_relationship">Relationship</label>

            <select
                name="guardian_relationship"
                id="guardian_relationship"
                required>

                <option value="">Select Relationship</option>

                <option value="MOTHER"
                    {{ old('guardian_relationship') == 'MOTHER' ? 'selected' : '' }}>
                    Mother
                </option>

                <option value="FATHER"
                    {{ old('guardian_relationship') == 'FATHER' ? 'selected' : '' }}>
                    Father
                </option>

                <option value="GRANDPARENT"
                    {{ old('guardian_relationship') == 'GRANDPARENT' ? 'selected' : '' }}>
                    Grandparent
                </option>

                <option value="GUARDIAN"
                    {{ old('guardian_relationship') == 'GUARDIAN' ? 'selected' : '' }}>
                    Guardian
                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="guardian_contact">Guardian Phone Number</label>

            <input
                type="text"
                id="guardian_contact"
                name="guardian_contact"
                value="{{ old('guardian_contact') }}"
                placeholder="Enter phone number"
                required>
        </div>

    </div>

@endif
            </div>


            {{-- Additional Notes --}}
            <div class="form-group">

                <label for="notes">
                    Additional Notes
                </label>

                <textarea
                    name="notes"
                    id="notes"
                    rows="5"
                    placeholder="Enter any additional information about your visit">{{ old('notes') }}</textarea>

            </div>


            {{-- Buttons --}}
            <div class="form-actions">

                <button
                    type="submit"
                    class="start-visit-btn">

                    Start Visit

                </button>

                <a
                    href="{{ route('patient.dashboard') }}"
                    class="cancel-btn">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>