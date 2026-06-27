<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function dashboard()
{
    $visits = Visit::with(['patient','screening'])

        ->where('status','WAITING_CONSULTATION')

        ->orderBy('queue_number')

        ->get();

    return view(
        'consultation.dashboard',
        compact('visits')
    );
  }
  
}
