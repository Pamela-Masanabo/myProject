<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChronicRecord;
use App\Models\Visit;  
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;    

class ChronicController extends Controller
{
   public function dashboard()
{
    $visits = Visit::with([

        'patient',

        'consultations'

    ])

    ->where('reason_for_visit','CHRONIC_MEDICATION')

    ->where('status','WAITING_CONSULTATION')

    ->orderBy('queue_number')

    ->get();

    return view(

        'chronic.dashboard',

        compact('visits')

    );
}

public function process(Visit $visit)
{
    $visit->load([

        'patient',

        'consultations.user',

        'screening'

    ]);

    return view(

        'chronic.process',

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

        'consultation_type'=>'PROFESSIONAL_NURSE',

        'diagnosis'=>$validated['diagnosis'],

        'treatment'=>$validated['treatment'],

        'medication'=>$validated['medication'],

        'notes'=>$validated['notes']

    ]);

    $visit->update([

        'status'=>'COMPLETED'

    ]);

    return redirect()

        ->route('chronic.dashboard')

        ->with(

            'success',

            'Patient processed successfully.'

        );
}
}
