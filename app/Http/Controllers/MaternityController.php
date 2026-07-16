<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Consultation;
use App\Models\Referral;
use App\Models\MaternityRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaternityController extends Controller
{
   public function dashboard()
{
    $visits = Visit::with([

        'patient',

        'patient.maternityRecord',

        'screening'

    ])

    ->where('reason_for_visit','MATERNITY')

    ->where('status','WAITING_CONSULTATION')

    ->orderBy('queue_number')

    ->get();

    return view(

        'maternity.dashboard',

        compact('visits')

    );
}

   public function create(Visit $visit)
{
    $visit->load([
        'patient',
        'screening'
    ]);

    $maternity = MaternityRecord::where(
        'patient_id',
        $visit->patient_id
    )->first();

    $weeks = null;
    $trimester = null;

    if ($maternity && $maternity->lmp_date) {

        $weeks = \Carbon\Carbon::parse($maternity->lmp_date)
                    ->diffInWeeks(now());

        if ($weeks <= 12) {

            $trimester = "First Trimester";

        } elseif ($weeks <= 27) {

            $trimester = "Second Trimester";

        } else {

            $trimester = "Third Trimester";

        }
    }

    return view(
        'maternity.consultation',
        compact(
            'visit',
            'maternity',
            'weeks',
            'trimester'
        )
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

            'notes'=>$validated['notes'],

            'referred_to_doctor'=>$request->has('referred_to_doctor')

        ]);

        if($request->has('referred_to_doctor'))
        {
            Referral::create([

                'visit_id'=>$visit->id,

                'referred_by'=>Auth::id(),

                'referral_reason'=>$validated['diagnosis'],

                'status'=>'PENDING'

            ]);

            $visit->update([

                'status'=>'WAITING_DOCTOR'

            ]);

            return redirect()
                ->route('maternity.dashboard')
                ->with('success','Patient referred to Doctor.');
        }

        $visit->update([

            'status'=>'COMPLETED'

        ]);

        return redirect()
            ->route('maternity.dashboard')
            ->with('success','Consultation completed successfully.');
    }
}
