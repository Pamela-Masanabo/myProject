<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    public function create()
{
    return view('patient.check-in');
}

public function store(Request $request)
{
    $validated = $request->validate([

        'reason_for_visit' => 'required',

        'guardian_name' => 'nullable',

        'guardian_relationship' => 'nullable',

        'guardian_phone' => 'nullable',

        'additional_notes' => 'nullable'

    ]);

    // $validated['patient_id'] = auth()->user()->patient->id;

    $validated['status'] = 'CHECKED_IN';

    $validated['queue_number'] = null;

    /*
    ELDERLY CHECK
    */

    // $patient = auth()->user()->patient;

    // $age = $patient->date_of_birth->age;

    // $validated['is_elderly'] = $age >= 65;

    Visit::create($validated);

    return redirect()

        ->route('patient.dashboard')

        ->with('success','Visit started successfully.');
}
}
