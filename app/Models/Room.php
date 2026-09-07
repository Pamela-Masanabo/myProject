<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'department',
        'room_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
