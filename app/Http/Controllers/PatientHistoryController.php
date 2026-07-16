<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class PatientHistoryController extends Controller
{
    public function index()
    {
        if(!session()->has('patient_id'))
        {
            return redirect()

                ->route('patient.login');
        }

        $patient = Patient::with([

            'visits.screening',

            'visits.consultations',

            'visits.referral'

        ])

        ->findOrFail(

            session('patient_id')

        );

        return view(

            'patient.history',

            compact('patient')

        );
    }
}
