<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function bookRide(BookingRequest $request){

        $booking = Booking::create([
            'user_id' => Helpers::getUser()->id,
            'car_request_id' => $request->input('car_request_id'),
            'is_paid' => 0,
            'seats' => $request->input('seats'),
        ]);

        Helpers::successResponse('Booked Successfully', $booking);

    }

    public function myBookings(){

    }

    public function pastBookings(){

    }

    public function deleteBooking(){

    }

    public function viewBooking(){

    }

    public function updateBooking(){

    }

}
