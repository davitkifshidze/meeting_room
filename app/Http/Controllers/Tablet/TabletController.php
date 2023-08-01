<?php

namespace App\Http\Controllers\Tablet;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TabletController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index($room_id)
    {
        
        $room = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date', 'room_translations.locale', 'room_translations.name')
            ->join('room_translations', 'room_translations.room_id', '=', 'rooms.id')
            ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
            ->where('rooms.id', '=', $room_id)
            ->first();

        return view('tablet.booking.create', with(['room_id' => $room_id, 'room' => $room]));

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




    /**
     * Check User
     */
    public function check_user(Request $request)
    {

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {


            if($user->hasPermissionTo('Booking Create', 'admin')):

                return response()->json([
                    'success' => true,
                    'message' => 'მომხმარებელი ვალიდურია',
                    'user' => $user,
                ]);


            else:

                return response()->json([
                    'success' => true,
                    'permission' => false,
                    'message' => 'მომხმარებელს არ აქვს დაჯავშნის უფლება',
                    'user' => $user,
                ]);

            endif;



        } else {
            return response()->json([
                'success' => false,
                'message' => 'მსგავსი მომხმარებელი არარსებობს',
            ]);
        }

    }



    /**
     * Booking Info
     */
    public function booking_info($room_id,$reserved_date)
    {

        $booking_info = Booking::select('bookings.id', 'bookings.room_id', 'bookings.user_id', 'bookings.start_date')
            ->addSelect('users.name')
            ->join('users','users.id','=','bookings.user_id')
            ->where('bookings.room_id', '=', $room_id)
            ->where('bookings.start_date', '=', $reserved_date)
            ->first();


        return response()->json([
            'status' => true,
            'booking_info' => $booking_info,
        ]);


    }


}
