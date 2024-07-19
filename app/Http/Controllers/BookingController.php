<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\CarRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function bookRide(BookingRequest $request){

        DB::beginTransaction();

        try {

            $booking = Booking::create([
                'user_id' => Helpers::getUser()->id,
                'car_request_id' => $request->input('car_request_id'),
                'is_paid' => 0,
                'seats' => $request->input('seats'),
            ]);

            CarRequests::updateSeats($request->input('car_request_id'), $request->input('seats'));

            DB::commit();

            return Helpers::successResponse('Booked Successfully', $booking);

        }catch (\Exception $exception){

            DB::rollBack();

            return Helpers::serverErrorResponse($exception->getMessage());

        }

    }

    public function myBookings(){

        $my_bookings = Booking::Where('user_id', Helpers::getUser()->id)->where('start_date','>=',Carbon::now()->format('Y-m-d'))->get();

        Helpers::successResponse('Your Incoming Bookings', $my_bookings);

    }

    public function pastBookings(){

        $my_bookings = Booking::Where('user_id', Helpers::getUser()->id)->where('start_date','<',Carbon::now()->format('Y-m-d'))->get();

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
