<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

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
}
