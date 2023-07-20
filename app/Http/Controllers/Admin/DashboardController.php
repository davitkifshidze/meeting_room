<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $room = Room::count();
        $booking = Booking::count();


        return view('admin.dashboard', compact('room', 'booking'));

    }

}
