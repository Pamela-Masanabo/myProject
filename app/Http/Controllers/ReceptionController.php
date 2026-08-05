<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
class ReceptionController extends Controller
{
    
public function index()
{
    $queue = Visit::with('patient')

        ->whereDate('created_at', today())

        ->where('status', 'CHECKED_IN')
        ->orderBy('queue_number')
        ->get();

    return view('reception.dashboard', compact('queue'));



}

public function generateQueue(Visit $visit)
{
    $prefix = match($visit->reason){
        'GENERAL_CONSULTATION' => 'G',
        'CHRONIC_MEDICATION' => 'C',
        'PEDIATRIC_CARE' => 'P',
        'MATERNITY' => 'M',
        'default' => 'G'
    };  
    
    $count = Visit::whereDate(
        
        'created_at', today()           
    ) ->where(
        'reason', $visit->reason
    )->whereNotNull(
        'queue_number'
    )->count();

     $queue = $prefix .
        str_pad($count + 1, 3, '0', STR_PAD_LEFT);

    $visit->update([

        'queue_number' => $queue,

        'status' => 'WAITING_SCREENING'

    ]);

    return back()->with(
        'success',
        'Queue number generated successfully.'
    );
} 
 public function sendToScreening(Visit $visit)
{
    $visit->update([

        'status' => 'WAITING_SCREENING'

    ]);

    return back()->with(

        'success',

        'Patient sent to Screening.'

    );
}
}
