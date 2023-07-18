<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::enableQueryLog();
        $bookings = Booking::select('bookings.id','bookings.room_id','bookings.user_id', 'room_translations.name as room_name', 'users.name as username', 'bookings.start_date', 'bookings.end_date')
            ->join('room_translations','room_translations.room_id','=','bookings.room_id')
            ->join('users','users.id','=','bookings.user_id')
            ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
            ->get();
        $query = DB::getQueryLog();
//        dd($query);

        return view('admin.booking.index', compact('bookings'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $rooms = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date', 'room_translations.locale', 'room_translations.name')
            ->join('room_translations','room_translations.room_id','=','rooms.id')
            ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
            ->where('rooms.status', '=', 1)
            ->get();

        return view('admin.booking.create', compact('rooms'));

    }

    /**
     * Room Info
     */
    public function room_info($id)
    {

        $room = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date')
            ->where('rooms.status', '=', 1)
            ->where('rooms.id', '=', $id)
            ->first();

        return response()->json(['room' => $room]);

    }

    /**
     * Room Booking Info
     */
    public function room_booking_info($room_id, $selected_date)
    {

        $booking = Booking::select('bookings.id', 'bookings.room_id', 'bookings.start_date', 'bookings.end_date')
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

        try{
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


        } catch (\Exception $e) {

            return response()->json(['warning' => 'not booking']);

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
