<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{

protected $fillable =[
  'patient_id',
  'reason',
  'notes',
  'status',
  'queue_number',
  'guardian_name',
  'guardian_relationship',
  'guardian_contact',
  'is_elderly'
    
  ];

  public function consultation()
  {
    return $this->hasMany(Consultation::class);
  }

  public function patient()
  {
    return $this->belongsTo(Patient::class);
  }
       
}
