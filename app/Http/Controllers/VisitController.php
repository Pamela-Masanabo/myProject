<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\MaternityRecord;
use Carbon\Carbon;

class VisitController extends Controller
{
    public function create()
{
     if(!session()->has('patient_id'))
    {
        return redirect()->route('patient.login');
    }
     $patient = Patient::find(session('patient_id'));

    $age = Carbon::parse($patient->date_of_birth)->age;

    $visitTypes = [];

    // Everyone can have a general consultation
    $visitTypes[] = [
        'value' => 'GENERAL_CONSULTATION',
        'label' => 'General Consultation'
    ];

    // Children
    if ($age < 18) {
        $visitTypes[] = [
            'value' => 'PEDIATRIC_CARE',
            'label' => 'Pediatric Care'
        ];
    }

    // Female patients
    if ($patient->gender == 'FEMALE') {

        $visitTypes[] = [
            'value' => 'MATERNITY',
            'label' => 'Maternity'
        ];
    }

    // Chronic Programme
    // We'll improve this once we build chronic enrolment

    return view('patient.check-in', compact(
        'patient',
        'visitTypes'
    ));
}

public function store(Request $request)
{
    if(!session()->has('patient_id'))
    {
        return redirect()->route('patient.login');
    }
    $validated = $request->validate([

        'reason_for_visit' => 'required',

        'guardian_name' => 'nullable',

        'guardian_relationship' => 'nullable',

        'guardian_phone' => 'nullable',

        'additional_notes' => 'nullable'

    ]);

    $patient = Patient::find(session('patient_id')); 
    $age = Carbon::parse($patient->date_of_birth)->age; 
    $existingVisit = Visit::where(

        'patient_id',

        $patient->id

    )->whereDate(
        'created_at',today()

    )->whereNotIn(
        'status',
        [
            'COMPLETED',
            'LEFT'
        ]
    )->first();

    if($existingVisit)
{
    return redirect()

        ->route('patient.dashboard')

        ->with('error','You already have an active visit today.'

        );
}
    Visit::create([
        'patient_id' => $patient->id,
        'reason' => $validated['reason'],
        'guardian_name' => $validated['guardian_name'] ?? null,
        'guardian_relationship' => $validated['guardian_relationship'] ?? null,
        'guardian_contact' => $validated['guardian_contact'] ?? null,
        'notes' => $validated['notes'] ?? null,
        'status' => 'CHECKED_IN',
        'queue_number' => null,
        'is_elderly' => $age >= 65, 
    ]); 
     return redirect()->route('patient.dashboard')->with('success', 'Visit started successfully.');

}
}