<?php

use App\Models\Room;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SchoolclassController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/view/{id}', [HomeController::class, 'view']);

Route::get('/api/rooms', [ApiController::class, 'rooms']);
Route::get('/api/classes', [ApiController::class, 'classes']);
Route::get('/api/assignment/day/{day}', [ApiController::class, 'assignmentOfDay']);
Route::get('/api/catalogofday/{day}', [ApiController::class, 'catalogOfDay']);
Route::get('/api/roombindings/checkduplicate/{day}', [ApiController::class, 'checkduplicate']);
Route::post('/api/roombindings', [ApiController::class, 'saveAssignment'])->middleware('auth');
Route::put('/api/roombindings/{osztalyid}/{nap}/{idopont}/{pozicio}/{teremid}', [ApiController::class, 'updateAssignment'])->middleware('auth');
Route::delete('/api/roombindings/{osztalyid}/{nap}/{idopont}/{pozicio}/{teremid}', [ApiController::class, 'deleteAssignment'])->middleware('auth');
Route::delete('/api/dailyroombindings/{nap}', [ApiController::class, 'deleteOneDayAssignment'])->middleware('auth');

Route::get('/catalog/index', [CatalogController::class, 'index'])->middleware('auth');
Route::get('/catalog/edit', [CatalogController::class, 'edit'])->middleware('auth');

Route::get('/export/catalog/pdf', [ExportController::class, 'catalogToPdf'])->middleware('auth');
Route::get('/export/emptyrooms/pdf', [ExportController::class, 'emptyroomsToPdf'])->middleware('auth');

Route::get('/room/index', [RoomController::class, 'index'])->middleware('auth');
Route::get('/room/new', [RoomController::class, 'create'])->middleware('auth');
Route::post('/room/new', [RoomController::class, 'store'])->middleware('auth');
Route::get('/room/delete/{id}', [RoomController::class, 'delete'])->middleware('auth');
Route::get('/room/edit/{id}', [RoomController::class, 'edit'])->middleware('auth');
Route::put('/room/edit/{id}', [RoomController::class, 'update'])->middleware('auth');

Route::get('/schoolclass/index', [SchoolclassController::class, 'index'])->middleware('auth');
Route::get('/schoolclass/new', [SchoolclassController::class, 'create'])->middleware('auth');
Route::post('/schoolclass/new', [SchoolclassController::class, 'store'])->middleware('auth');
Route::get('/schoolclass/delete/{id}', [SchoolclassController::class, 'delete'])->middleware('auth');
Route::get('/schoolclass/edit/{id}', [SchoolclassController::class, 'edit'])->middleware('auth');
Route::put('/schoolclass/edit/{id}', [SchoolclassController::class, 'update'])->middleware('auth');

Route::get('/login', [SessionController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'processLogin'])->middleware('guest');
Route::get('/logout', [SessionController::class, 'logout'])->middleware('auth');
