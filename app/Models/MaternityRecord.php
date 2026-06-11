<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaternityRecord extends Model
{
    protected $fillable =[
  'patient_id',
  'lmp_date',
  'edd_date',
  'enrollment_date',
  'pregnancy_number',
  'high_risk',
  'status' 
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }   

    
}
