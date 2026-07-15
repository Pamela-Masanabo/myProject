<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Consultation;
use App\Models\Referral;
use App\Models\ChronicRecord;
use App\Models\MaternityRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfessionalNurseController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $visits = Visit::with([
            'patient',
            'screening'
        ])
        ->where('status','WAITING_CONSULTATION')
        ->orderBy('queue_number')
        ->get();

        return view(
            'professional_nurse.dashboard',
            compact('visits')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Open Consultation
    |--------------------------------------------------------------------------
    */

    public function create(Visit $visit)
    {
        $visit->load([

            'patient',

            'screening'

        ]);

        return view(

            'professional_nurse.consultation',

            compact('visit')

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Save Consultation
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Visit $visit)
    {
        $validated = $request->validate([

            'diagnosis'=>'required',

            'treatment'=>'required',

            'medication'=>'required',

            'notes'=>'nullable',

            'lmp_date'=>'nullable|date',

            'pregnancy_number'=>'nullable|integer'

        ]);

        Consultation::create([

            'visit_id'=>$visit->id,

            'user_id'=>Auth::id(),

            'consultation_type'=>'PROFESSIONAL_NURSE',

            'diagnosis'=>$validated['diagnosis'],

            'treatment'=>$validated['treatment'],

            'medication'=>$validated['medication'],

            'notes'=>$validated['notes'] ?? null,

            'referred_to_doctor'=>$request->has('referred_to_doctor'),

            'hospital_referral'=>false

        ]);

        /*
        ----------------------------------
        REFER TO DOCTOR
        ----------------------------------
        */

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

                ->route('professional_nurse.dashboard')

                ->with(

                    'success',

                    'Patient referred to Doctor.'

                );
        }

        /*
        ----------------------------------
        CHRONIC CARE
        ----------------------------------
        */

        if($request->has('enrol_chronic'))
        {
            ChronicRecord::create([

                'patient_id'=>$visit->patient_id,

                'condition'=>$validated['diagnosis'],

                'enrollment_date'=>today(),

                'status'=>'ACTIVE'

            ]);
        }

        /*
        ----------------------------------
        MATERNITY
        ----------------------------------
        */

        if($request->has('enrol_maternity'))
        {
            $lmp = Carbon::parse($validated['lmp_date']);

            MaternityRecord::create([

                'patient_id'=>$visit->patient_id,

                'lmp_date'=>$validated['lmp_date'],

                'edd_date'=>$lmp->copy()->addDays(280),

                'pregnancy_number'=>$validated['pregnancy_number'],

                'high_risk'=>$request->has('high_risk')

            ]);
        }

        /*
        ----------------------------------
        COMPLETE VISIT
        ----------------------------------
        */

        $visit->update([

            'status'=>'COMPLETED'

        ]);

        return redirect()

            ->route('professional_nurse.dashboard')

            ->with(

                'success',

                'Consultation completed successfully.'

            );
    }

}
