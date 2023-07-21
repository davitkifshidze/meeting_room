<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TabletController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($room_id)
    {

        return view('tablet.booking.create', with(['room_id' => $room_id]));

    }


    /**
     * Room Info
     */
    public function room_info($room_id)
    {
        
        $room = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date')
            ->where('rooms.status', '=', 1)
            ->where('rooms.id', '=', $room_id)
            ->first();

        return response()->json(['room' => $room]);

    }

    /**
     * Room Booking Info
     */
    public function room_booking_info($room_id, $selected_date)
    {

        $booking = Booking::select('bookings.id', 'bookings.room_id', 'bookings.start_date', 'bookings.end_date', 'users.id as user_id', 'users.color')
            ->join('users','users.id','=','bookings.user_id')
            ->where('bookings.room_id', '=', $room_id)
            ->where('bookings.start_date', 'LIKE', '%' . $selected_date . '%')
            ->get();


        if (!$booking->isEmpty()) {
            return response()->json(['booking' => $booking]);
        } else {
            return response()->json(false);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        foreach($request->dates as $key => $item):

            $carbon = Carbon::createFromFormat('Y-m-d H:i', $item);
            $carbon->addMinutes(15);
            $end_date = $carbon->format('Y-m-d H:i');

            $booking = Booking::create([
                'room_id' => $request->room_id,
                'user_id' => $request->user_id,
                'start_date' => $item,
                'end_date' => $end_date,
            ]);

        endforeach;

        return response()->json(['success' => 'booking_succes']);

    }
}
