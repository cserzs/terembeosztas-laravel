<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Catalog;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {
        return view('main_layout', [
            '_content' => view('rooms.index', [
                'termek' => Room::all()
            ])
        ]);
    }

    public function create() {
        return view('main_layout', [
            '_content' => view('rooms.create')
        ]);
    }

    //  post
    public function store() {
        $attributes = request()->validate(Room::getValidationRules());

        Room::create($attributes);

        return redirect('/room/index')->with('system_message', 'Új terem sikeresen elmentve! (' . $attributes['nev'] . ')');
    }

    public function edit($id) {
        $room = Room::findOrFail($id);

        return view('main_layout', [
            '_content' => view('rooms.edit', [
                'terem' => $room
            ])
        ]);
    }

    //  put
    public function update($id) {
        $attributes = request()->validate(Room::getValidationRules());

        $room = Room::findOrFail($id);
        $room->fill($attributes)->save();

        return redirect('/room/index')->with('system_message', $attributes['rovid_nev'] . ' terem frissítve!');
    }

    public function delete($id) {
        $room = Room::findOrfail($id);

        if ($room->id == 1) {
            return redirect('/room/index')->with('system_message', 'Speciális terem az üres órákhoz, nem törölhető!');            
        }
        if (Catalog::where('terem_id', $room->id)->count() > 0) {
            return redirect('/room/index')->with('system_message', 'A terem nem törölhető, amíg ki van osztva!');
        }

        $room->delete();
        return redirect('/room/index')->with('system_message', 'A(z) ' . $room->rovid_nev . ' terem törölve! (#' . $room->id . ')');
    }
}
