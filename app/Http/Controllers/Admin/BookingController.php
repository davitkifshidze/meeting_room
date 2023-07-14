<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);

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
