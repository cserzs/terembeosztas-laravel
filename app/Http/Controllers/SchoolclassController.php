<?php
namespace App\Http\Controllers;

use App\Models\Schoolclass;
use App\Models\Catalog;
use Illuminate\Http\Request;

class SchoolclassController extends Controller
{
    public function index() {
        return view('main_layout', [
            '_content' => view('schoolclass.index', [
                'osztalyok' => Schoolclass::orderBy('evfolyam')->orderBy('betujel')->get()
            ])
        ]);
    }

    public function create() {
        return view('main_layout', [
            '_content' => view('schoolclass.create')
        ]);
    }

    //  post
    public function store() {
        $attributes = request()->validate(Schoolclass::getValidationRules());

        Schoolclass::create($attributes);

        return redirect('/schoolclass/index')->with('system_message', 'Új osztály sikeresen elmentve! (' . $attributes['nev'] . ')');
    }

    public function edit($id) {
        $schoolclass = Schoolclass::findOrFail($id);

        return view('main_layout', [
            '_content' => view('schoolclass.edit', [
                'osztaly' => $schoolclass
            ])
        ]);
    }

    //  put
    public function update($id) {
        $attributes = request()->validate(Schoolclass::getValidationRules());

        $schoolclass = Schoolclass::findOrFail($id);
        $schoolclass->fill($attributes)->save();

        return redirect('/schoolclass/index')->with('system_message', $attributes['rovid_nev'] . ' osztály frissítve!');
    }

    public function delete($id) {
        $schoolclass = Schoolclass::findOrfail($id);

        if (Catalog::where('osztaly_id', $schoolclass->id)->count() > 0) {
            return redirect('/schoolclass/index')->with('system_message', 'Egy osztály nem törölhető, amíg van terem kiosztva számára!');
        }

        $schoolclass->delete();
        return redirect('/schoolclass/index')->with('system_message', 'A(z) ' . $schoolclass->rovid_nev . ' osztály törölve! (#' . $schoolclass->id . ')');
    }
}
