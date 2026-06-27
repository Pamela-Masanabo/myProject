<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Screening;

class ScreeningController extends Controller
{
    public function dashboard(){

        $visits = Visit::with('patient')
            ->where('status','WAITING_SCREENING')
            ->where('reason_for_visit','GENERAL_CONSULTATION')
            ->orderBy('queue_number')
            ->get();

        return view('screening.dashboard',compact('visits'));
    }

    public function create(Visit $visit)
{
    return view('screening.screen', compact('visit'));
}

public function store(Request $request, Visit $visit)
{
    $validated = $request->validate([

        'temperature' => 'required|numeric',

        'blood_pressure' => 'required',

        'pulse_rate' => 'required|integer',

        'respiratory_rate' => 'required|integer',

        'oxygen_saturation' => 'required|integer',

        'weight' => 'required|numeric',

        'height' => 'required|numeric',

        'symptoms' => 'required',

        'priority_level' => 'required'

    ]);

    // Calculate BMI
    $heightInMeters = $validated['height'] / 100;

    $bmi = round(
        $validated['weight'] /
        ($heightInMeters * $heightInMeters),
        2
    );

    Screening::create([

        'visit_id' => $visit->id,

        'temperature' => $validated['temperature'],

        'blood_pressure' => $validated['blood_pressure'],

        'pulse_rate' => $validated['pulse_rate'],

        'respiratory_rate' => $validated['respiratory_rate'],

        'oxygen_saturation' => $validated['oxygen_saturation'],

        'weight' => $validated['weight'],

        'height' => $validated['height'],

        'bmi' => $bmi,

        'symptoms' => $validated['symptoms'],

        'priority_level' => $validated['priority_level']

    ]);

    $visit->update([

        'status' => 'WAITING_CONSULTATION'

    ]);

    return redirect()

        ->route('screening.dashboard')

        ->with('success', 'Screening completed successfully.');
}

}
