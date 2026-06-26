<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChronicRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'condition',
        'enrollment_date',
        'status',
        'notes'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }    


}
