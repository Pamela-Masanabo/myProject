<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Consultation;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KidsController extends Controller
{
    public function dashboard()
    {
        $visits = Visit::with([
            'patient',
            'screening'
        ])

        ->where('reason_for_visit','PEDIATRIC_CARE')

        ->where('status','WAITING_CONSULTATION')

        ->orderBy('queue_number')

        ->get();

        return view(

            'kids.dashboard',

            compact('visits')

        );
    }

    public function create(Visit $visit)
    {
        $visit->load([

            'patient',

            'screening'

        ]);

        return view(

            'kids.consultation',

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

                ->route('kids.dashboard')

                ->with(

                    'success',

                    'Patient referred to Doctor.'

                );
        }

        $visit->update([

            'status'=>'COMPLETED'

        ]);

        return redirect()

            ->route('kids.dashboard')

            ->with(

                'success',

                'Consultation completed successfully.'

            );
    }
}