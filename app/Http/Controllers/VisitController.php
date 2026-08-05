<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\MaternityRecord;
use Carbon\Carbon;

class VisitController extends Controller
{
    public function create()
    {
        if (!session()->has('patient_id')) {
            return redirect()->route('patient.login');
        }
        $patient = Patient::find(session('patient_id'));

        $age = Carbon::parse($patient->date_of_birth)->age;

        $visitTypes = [];

        // Everyone can have a general consultation
        $visitTypes[] = [
            'value' => 'GENERAL_CONSULTATION',
            'label' => 'General Consultation'
        ];

        // Children
        if ($age < 18) {
            $visitTypes[] = [
                'value' => 'PEDIATRIC_CARE',
                'label' => 'Pediatric Care'
            ];
        }

        // Female patients
        if ($patient->gender == 'FEMALE') {

            $visitTypes[] = [
                'value' => 'MATERNITY',
                'label' => 'Maternity'
            ];
        }

        // Chronic Programme
        // We'll improve this once we build chronic enrolment

        return view('patient.check-in', compact(
            'patient',
            'visitTypes',
            'age'
        ));
    }
    public function store(Request $request)
    {
        if (!session()->has('patient_id')) {
            return redirect()->route('patient.login');
        }

        $validated = $request->validate([
            'reason' => 'required|in:GENERAL_CONSULTATION,CHRONIC_MEDICATION,PEDIATRIC_CARE,MATERNITY',

            'guardian_name' => 'nullable|string|max:255',

            'guardian_relationship' =>
            'nullable|in:MOTHER,FATHER,GRANDPARENT,GUARDIAN',

            'guardian_contact' => 'nullable|string|max:20',

            'notes' => 'nullable|string',
        ]);

        $patient = Patient::findOrFail(session('patient_id'));

        $age = Carbon::parse($patient->date_of_birth)->age;

        if ($age < 18) {

            $request->validate([
                'guardian_name' => 'required|string|max:255',

                'guardian_relationship' =>
                'required|in:MOTHER,FATHER,GRANDPARENT,GUARDIAN',

                'guardian_contact' =>
                'required|string|max:20',
            ]);
        }

        // Check if patient already has an active visit today
        $existingVisit = Visit::where('patient_id', $patient->id)
            ->whereDate('created_at', today())
            ->whereNotIn('status', [
                'COMPLETED',
                'LEFT'
            ])
            ->first();

        if ($existingVisit) {

            return redirect()
                ->route('patient.dashboard')
                ->with(
                    'error',
                    'You already have an active visit today.'
                );
        }
        $queue = Visit::with('patient')
            ->whereIn('status', [
                'WAITING_SCREENING',
                'WAITING_DOCTOR',
                'SCREENING',
                'CONSULTATION'
            ])
            ->orderBy('queue_number')
            ->get();

        // Get today's last queue number
        $lastVisit = Visit::whereDate('created_at', today())
            ->whereNotNull('queue_number')
            ->orderByDesc('id')
            ->first();

        if ($lastVisit) {

            // Remove the "A" and convert to number
            $lastNumber = (int) substr($lastVisit->queue_number, 1);

            $nextNumber = $lastNumber + 1;
        } else {

            $nextNumber = 1;
        }

        // Format: A001, A002, A003...
        $queueNumber = 'A' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Create visit
        Visit::create([

            'patient_id' => $patient->id,

            'reason' => $validated['reason'],

            'notes' => $validated['notes'] ?? null,

            'guardian_name' =>
            $validated['guardian_name'] ?? null,

            'guardian_relationship' =>
            $validated['guardian_relationship'] ?? null,

            'guardian_contact' =>
            $validated['guardian_contact'] ?? null,

            'is_elderly' => $age >= 65,

            'status' => 'CHECKED_IN',

            'queue_number' => $queueNumber,

        ]);

        return redirect()
            ->route('patient.dashboard')
            ->with(
                'success',
                'Visit started successfully.'
            );
    }
}
