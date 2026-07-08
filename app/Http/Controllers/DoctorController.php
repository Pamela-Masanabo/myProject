<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use App\Models\Consultation;

class DoctorController extends Controller
{
 public function dashboard()
    {
        $visits = Visit::with([
            'patient',
            'screening',
            'consultation',
            'referral'
        ])
        ->where('status','WAITING_DOCTOR')
        ->orderBy('queue_number')
        ->get();

        return view(
            'doctor.dashboard',
            compact('visits')
        );
    }


    public function consultation(Visit $visit)
{
    $visit->load([
        'patient',
        'screening',
        'consultations'
    ]);

    return view(
        'doctor.consultation',
        compact('visit')
    );
}

  public function store(Request $request, Visit $visit)
{
    $validated = $request->validate([

        'diagnosis'=>'required',

        'treatment'=>'required',

        'medication'=>'required',

        'notes'=>'nullable'

    ]);

    Consultation::create([

        'visit_id'=>$visit->id,

        'user_id'=>Auth::id(),

        'consultation_type'=>'DOCTOR',

        'diagnosis'=>$validated['diagnosis'],

        'treatment'=>$validated['treatment'],

        'medication'=>$validated['medication'],

        'notes'=>$validated['notes'],

        'hospital_referral'=>$request->has('hospital_referral')

    ]);

    if($request->has('hospital_referral'))
    {

        $visit->referral->update([

            'hospital_referral'=>true,

            'status'=>'COMPLETED'

        ]);

    }

    $visit->update([

        'status'=>'COMPLETED'

    ]);

    return redirect()

        ->route('doctor.dashboard')

        ->with(
            'success',
            'Consultation completed successfully.'
        );
}
}
