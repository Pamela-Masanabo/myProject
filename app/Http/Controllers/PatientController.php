<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class PatientController extends Controller
{
public function dashboard()
{
    if(!session()->has('patient_id'))
    {
        return redirect()
               ->route('patient.login');
    }

    $patient = Patient::find(
        session('patient_id')
    );

    $latestVisit = Visit::where(
            'patient_id',
            $patient->id
        )
        ->latest()
        ->first();

    return view(
        'patient.dashboard',compact(
            'patient',
            'latestVisit'
        )
    );
}
    public function welcome()
{
    return view('patient.welcome');
}

public function showLogin()
{
    return view('patient.login');
}

public function create()
{
    return view('patient.register');
}

public function login(Request $request)
{
    $request->validate([

        'id_number' => 'required'

    ]);

    $patient = Patient::where(

        'id_number',

        $request->id_number

    )->first();

    if(!$patient)
    {
        return back()->withErrors(['id_number' =>'Patient not found.'
            ]);
    }

    session([

        'patient_id' => $patient->id

    ]);

    return redirect()->route('patient.dashboard');
}



}
