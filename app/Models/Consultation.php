<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'visit_id',
        'user_id',
        'diagnosis',
        'medication',
        'dosage_instructions',
        'notes',
        'next_visit_date',
        'referred_to_doctor',
        'hospital_referral'
    ];


    // defining the relationship
    


// public visit {
//   this->hasOne->class::Visit
// }
// public user {
//     This->belongsTo->class::User();
// }

}
