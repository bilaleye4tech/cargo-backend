<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRequests extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure',
        'destination',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'car_detail',
        'fare',
        'seats',
        'is_smoking',
        'is_ac',
        'is_speaker',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
