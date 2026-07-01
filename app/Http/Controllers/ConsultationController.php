<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Consultation;
use App\Models\Referral;
use App\Models\ChronicRecord;
use App\Models\MaternityRecord;
use Carbon\Carbon;

class ConsultationController extends Controller
{
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
            'consultation.dashboard',
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
            'consultation.consultation',
            compact('visit')
        );
    }

    public function store(Request $request, Visit $visit)
    {
        $validated = $request->validate([

            'diagnosis' => 'required',

            'treatment' => 'required',

            'medication' => 'required',

            'notes' => 'nullable',

            'referred_to_doctor' => 'nullable',

            'hospital_referral' => 'nullable',

            'enrol_chronic' => 'nullable',

            'enrol_maternity' => 'nullable',

            'lmp_date' => 'nullable|date',

            'pregnancy_number' => 'nullable|integer',

            'high_risk' => 'nullable'

        ]);

        Consultation::create([

            'visit_id' => $visit->id,

            'diagnosis' => $validated['diagnosis'],

            'treatment' => $validated['treatment'],

            'medication' => $validated['medication'],

            'notes' => $validated['notes'],

            'referred_to_doctor' => $request->has('referred_to_doctor'),

            'hospital_referral' => $request->has('hospital_referral')

        ]);

        /*
        REFER TO DOCTOR
        */

        if($request->has('referred_to_doctor'))
        {

            Referral::create([

                'visit_id' => $visit->id,

                //'referred_by' => auth()->id(),

                'referral_reason' => $validated['diagnosis'],

                'status' => 'PENDING'

            ]);

            $visit->update([

                'status' => 'WAITING_DOCTOR'

            ]);

            return redirect()

                ->route('consultation.dashboard')

                ->with('success','Patient referred to Doctor.');

        }

        /*
        ENROL INTO CHRONIC
        */

        if($request->has('enrol_chronic'))
        {

            ChronicRecord::create([

                'patient_id' => $visit->patient_id,

                'condition' => $validated['diagnosis'],

                'enrollment_date' => today(),

                'status' => 'ACTIVE'

            ]);

        }

        /*
        ENROL INTO MATERNITY
        */

        if($request->has('enrol_maternity'))
        {

            $lmp = Carbon::parse($validated['lmp_date']);

            MaternityRecord::create([

                'patient_id' => $visit->patient_id,

                'lmp_date' => $validated['lmp_date'],

                'edd_date' => $lmp->copy()->addDays(280),

                'pregnancy_number' => $validated['pregnancy_number'],

                'high_risk' => $request->has('high_risk')

            ]);

        }

        $visit->update([

            'status' => 'COMPLETED'

        ]);

        return redirect()

            ->route('consultation.dashboard')

            ->with('success','Consultation completed successfully.');

    }
}
