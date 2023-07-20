<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = User::all();
        $rooms = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date', 'room_translations.locale', 'room_translations.name')
            ->join('room_translations','room_translations.room_id','=','rooms.id')
            ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
            ->where('rooms.status', '=', 1)
            ->get();

        $user = auth()->guard('admin')->user();

        if ($user->hasRole('Super Admin')) {

            $query = Booking::select('bookings.id', 'bookings.room_id', 'bookings.user_id', 'room_translations.name as room_name', 'users.username', 'bookings.start_date', 'bookings.end_date')
                ->join('room_translations', 'room_translations.room_id', '=', 'bookings.room_id')
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale());

            if(!empty($request->user)){
                $query->where('bookings.user_id', '=', $request->input('user'));
            }

        } else {

            $query = Booking::select('bookings.id', 'bookings.room_id', 'bookings.user_id', 'room_translations.name as room_name', 'users.username', 'bookings.start_date', 'bookings.end_date')
                ->join('room_translations', 'room_translations.room_id', '=', 'bookings.room_id')
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
                ->where('bookings.user_id', '=', $user->id);

        }

        if(!empty($request->room)){
            $query->where('bookings.room_id', '=', $request->input('room'));
        }
        $bookings = $query->paginate(5)->withQueryString();


        return view('admin.booking.index', compact('bookings','user', 'users', 'rooms'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->guard('admin')->user();

        $rooms = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date', 'room_translations.locale', 'room_translations.name')
            ->join('room_translations','room_translations.room_id','=','rooms.id')
            ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
            ->where('rooms.status', '=', 1)
            ->get();

        return view('admin.booking.create', compact('rooms','user'));

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
            
            dd($e);

            return response()->json(['warning' => 'not booking']);

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user = auth()->guard('admin')->user();

        $booking = Booking::select('bookings.id', 'bookings.room_id', 'bookings.user_id', 'bookings.start_date', 'bookings.end_date')
            ->where('bookings.id', '=', $id)
            ->first();

        $rooms = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date', 'room_translations.locale', 'room_translations.name')
            ->join('room_translations','room_translations.room_id','=','rooms.id')
            ->where('room_translations.locale', '=', LaravelLocalization::getCurrentLocale())
            ->where('rooms.status', '=', 1)
            ->get();

        $selected_room = Room::findOrFail($booking->room_id);
//        dd($booking);

        return view('admin.booking.edit', compact('rooms', 'booking', 'user','selected_room'));

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
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking_list',$id)->with( ['delete' => 'success'] );
    }
}
