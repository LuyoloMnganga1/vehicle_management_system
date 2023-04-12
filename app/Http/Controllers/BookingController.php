<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookings(){
        return view('bookings.book_vehicle');
    }

    public function bookHistory(){
        return view('bookings.booking_history');
    }

    public function logBook(){
        return view('bookings.log_book');
    }
}
