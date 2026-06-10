<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screening extends Model
{
    protected $fillable = [
     'visit_id',
     'user_id',
     'temperature',
     'blood_pressure',
     'weight',
     'pulse_rate',
    'priority_level',
    'height',
    'notes',
    'referred_to_doctor'
    ];
    
    public function visit()
    {
        return $this->hasOne(Visit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

}
