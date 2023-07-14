<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomTranslations;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $rooms = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date', 'room_translations.locale', 'room_translations.name')
            ->join('room_translations','room_translations.room_id','=','rooms.id')
            ->where('locale', '=', LaravelLocalization::getCurrentLocale())
            ->get();

        return view('admin.room.index', compact('rooms'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $room = new Room();
        $room->status = $request->has('status') ? 1 : 0;
        $room->start_date = $request->start_date;
        $room->end_date = $request->end_date;

        $room->save();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $local):
            $translation = new RoomTranslations([
                'locale' => $localeCode,
                'name' => $request->name[$localeCode] ?? null,
            ]);
            $room->translations()->save($translation);

        endforeach;

        return redirect(route('room_list'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room_id = $id;

        foreach(LaravelLocalization::getSupportedLocales() as $locale_code => $locale):

            $room[$locale_code] = Room::select('rooms.id', 'rooms.status', 'rooms.start_date', 'rooms.end_date')
                ->addSelect(
                    'room_translations.id as translation_id',
                    'room_translations.locale',
                    'room_translations.name'
                )
                ->join('room_translations', 'room_translations.room_id', '=', 'rooms.id')
                ->where('room_translations.locale', '=', $locale_code)
                ->where('rooms.id', '=', $room_id)
                ->first();
        endforeach;

        return view('admin.room.edit', compact('room', 'room_id'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $room = Room::findOrFail($id);
        $room->status = $request->has('status') ? 1 : 0;
        $room->start_date = $request->start_date;
        $room->end_date = $request->end_date;
        $room->save();

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $local) {
            $translation = RoomTranslations::where('room_id', $room->id)
                ->where('locale', $localeCode)
                ->firstOrFail();

            $translation->name = $request->name[$localeCode] ?? null;
            $translation->save();
        }

        return redirect()->route('room_edit',$id)->with( ['update' => 'success'] );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('room_list',$id)->with( ['delete' => 'success'] );
    }
}
