<?php

namespace App\Models;

use App\Helpers\Helpers;
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

    public static function updateSeats($id = null, $seats = null){

        $car_request = self::whereId($id)->first();

        if (($car_request->seats - $car_request->booked_seats) < $seats){

            return Helpers::serverErrorResponse('Remaining seats are '. ($car_request->seats - $car_request->booked_seats));

        }else{

            $car_request->booked_seats = $car_request->booked_seats + $seats;

            return Helpers::successResponse('Seat Booked Successfully');

        }

    }
}
