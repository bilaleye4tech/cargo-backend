<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        $my_bookings = Booking::Where('user_id', Helpers::getUser()->id)->where('start_date','>=',Carbon::now()->format('d-m-Y'))->get();

        Helpers::successResponse('Your Incoming Bookings', $my_bookings);

    }

    public function pastBookings(){

        $my_bookings = Booking::Where('user_id', Helpers::getUser()->id)->where('start_date','<',Carbon::now()->format('d-m-Y'))->get();

        Helpers::successResponse('Your Past Bookings', $my_bookings);

    }

    public function deleteBooking(Request $request){

        Booking::whereId($request->input('id'))->delete();

        Helpers::successResponse('Booking Deleted Successfully');

    }

    public function viewBooking(Request $request){

        $booking = Booking::whereId($request->input('id'))->first();

        Helpers::successResponse('Booking', $booking);

    }

    public function updateBooking(Request $request){

        $booking = Booking::find($request->input('id'))->update($request->all());

        Helpers::successResponse('Booking Updated Successfully', $booking);

    }

}
