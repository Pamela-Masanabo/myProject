<h1>

Welcome

{{ $patient->first_name }}

</h1>


<div>

    <h3>Patient Information</h3>

    <p>

        ID:

        {{ $patient->id_number }}

    </p>

</div>


<div>

    <h3>Today's Status</h3>

    @if($latestVisit)

        <p>

            {{ $latestVisit->status }}

        </p>

    @else

        <p>

            No active visit.

        </p>

    @endif

</div>


<a href="{{ route('visit.create') }}">

    Start Visit

</a>


<a href="#">

    View History

</a>