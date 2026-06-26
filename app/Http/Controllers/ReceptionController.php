<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
class ReceptionController extends Controller
{
    
public function index()
{
    $visits = Visit::with('patient')

        ->whereDate('created_at', today())

        ->where('status', 'CHECKED_IN')

        ->get();

    return view('reception.dashboard',compact('visits')

    );
}

public function verify(Visit $visit)
{
    $prefix = match($visit->reason){
        'GENERAL_CONSULTATION' => 'G',
        'CHRONIC_MEDICATION' => 'C',
        'PEDIATRIC_CARE' => 'P',
        'MATERNITY' => 'M'
    };  
    
    $count = Visit::whereDate(
        
        'created_at', today()           
    ) ->where(
        'reason', $visit->reason
    )->whereNotNull(
        'queue_number'
    )->count();

    $visit->queue_number = $prefix . str_pad(
       $count + 1,
       3,
         '0',
        STR_PAD_LEFT 
    );

    $visit->status = 'WAITING_SCREENING';
    $visit->save();
    return back();
} 

}
