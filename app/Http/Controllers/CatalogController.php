<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index() {
        return view('main_layout', [
            '_content' => view('catalog.index')
        ]);
    }

    public function edit() {
        return view('catalog.edit');
    }
}
