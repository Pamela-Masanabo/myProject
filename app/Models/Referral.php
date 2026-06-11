<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
      'visit_id',
      'referred_by',
      'referral_reason',
      'referral_hospital_name',
      'specialist_name',
      'status',

    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

}
