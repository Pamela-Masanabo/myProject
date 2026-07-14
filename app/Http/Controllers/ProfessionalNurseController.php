<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class ProfessionalNurseController extends Controller
{
     public function dashboard()
    {
        $visits = Visit::with([
            'patient',
            'screening'
        ])
        ->where('status', 'WAITING_CONSULTATION')
        ->orderBy('queue_number')
        ->get();

        return view(
            'professional_nurse.dashboard',
              compact('visits')
        );
    }

}
