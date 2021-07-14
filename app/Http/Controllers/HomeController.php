<?php
namespace App\Http\Controllers;

use App\Models\Schoolclass;
use App\Models\Catalog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        return view('public_layout', [
            'osztalyok' => Schoolclass::orderBy('evfolyam')->orderBy('betujel')->get(),
            '_content' => view('home.index')
        ]);
    }

    public function view($id) {
        $mClass = Schoolclass::findOrFail($id);
        
        return view('public_layout', [
            'osztalyok' => Schoolclass::orderBy('evfolyam')->orderBy('betujel')->get(),
            '_content' => view('home.view', [
                'osztaly' => $mClass,
                'teremrend' => Catalog::getForClass($id),
            ]),
        ]);
    }
}
