<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schoolclass;
use App\Models\Catalog;
use App\Libraries\CatalogManager;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function rooms() {
        return Room::all();
    }

    public function classes() {
        return Schoolclass::all();
    }

    public function assignmentOfDay($nap) {
        $nap = (int)$nap;
        if (!Catalog::isDayValid($nap)) return $this->errorResponse(400, "Érvénytelen paraméter: nap = " . $nap);        
        return Catalog::where('nap', $nap)->get();
    }

    /*  format:
        {
            class_id: id,
            roomcatalog: [ [roomid, roomid], [] ... ]
        }
    */
    public function catalogOfDay($nap) {
        $nap = (int)$nap;
        if (!Catalog::isDayValid($nap)) return $this->errorResponse(400, "Érvénytelen paraméter: nap = " . $nap);
        return CatalogManager::getCatalogOfDay($nap);
    }

    public function checkduplicate($nap) {
        $nap = (int)$nap;
        if (!Catalog::isDayValid($nap)) return $this->errorResponse(400, "Érvénytelen paraméter: nap = " . $nap);

        $catalog = Catalog::select('idopont', 'terem_id')
            ->selectRaw('count(terem_id) AS num')
            ->where('nap', $nap)->where('terem_id', '<>', 0)
            ->groupBy('nap', 'idopont', 'terem_id')
            ->having('num', '>', 1)
            ->get();
        return $catalog;
    }

    //  post
    public function saveAssignment() {
        $catalog = new Catalog();
        $catalog->osztaly_id = (int)request()->input('osztalyid', -1);
        $catalog->nap = (int)request()->input('nap', -1);
        $catalog->idopont = (int)request()->input('idopont', -1);
        $catalog->pozicio = (int)request()->input('pozicio', -1);
        $catalog->terem_id = (int)request()->input('teremid', -1);

        //if (Schoolclass::find($catalog->osztaly_id) == null) return $this->errorResponse(400, "Érvénytelen paraméter: osztaly_id (" . $catalog->osztaly_id . ')');
        if (!Schoolclass::where('id', $catalog->osztaly_id)->exists()) return $this->errorResponse(400, "Érvénytelen paraméter: osztaly_id = " . $catalog->osztaly_id);
        if (!Catalog::isDayValid($catalog->nap)) return $this->errorResponse(400, "Érvénytelen paraméter: nap = " . $catalog->nap);
        if (!Catalog::isTimeValid($catalog->idopont)) return $this->errorResponse(400, "Érvénytelen paraméter: idopont = " . $catalog->idopont);
        if (!Catalog::isPositionValid($catalog->pozicio)) return $this->errorResponse(400, "Érvénytelen paraméter: pozicio = " . $catalog->pozicio);
        if (Room::find($catalog->terem_id) == null) return $this->errorResponse(400, "Érvénytelen paraméter: terem_id = " . $catalog->terem_id);

        $catalog->save();

        return response()->json(['success' => 'success'], 200);
    }

    public function updateAssignment($osztalyid, $nap, $idopont, $pozicio, $teremid) {
        $teremid = (int)$teremid;
        if (Room::find($teremid) == null) return $this->errorResponse(400, "Érvénytelen paraméter: terem_id = " . $teremid);

        $affectedRows = Catalog::
            where('osztaly_id', $osztalyid)->where('nap', $nap)
            ->where('idopont', $idopont)->where('pozicio', $pozicio)
            ->update(['terem_id'  => $teremid]);

        if ($affectedRows == 0) return $this->errorResponse(400, "Érvénytelen paraméter: nincs ilyen rekord!");
        
        return response()->json(['success' => 'success'], 200);
    }

    public function deleteAssignment($osztalyid, $nap, $idopont, $pozicio, $teremid) {
        $affectedRows = Catalog::where('osztaly_id', $osztalyid)
            ->where('nap', $nap)->where('idopont', $idopont)
            ->where('pozicio', $pozicio)->where('terem_id', $teremid)
            ->delete();

        if ($affectedRows == 0) return $this->errorResponse(400, "Érvénytelen paraméter: nincs ilyen rekord!");
    
        return response()->json(['success' => 'success'], 200);
    }

    public function deleteOneDayAssignment($nap) {
        $nap = (int)$nap;
        if (!Catalog::isDayValid($nap)) return $this->errorResponse(400, "Érvénytelen paraméter: nap = " . $nap);

        Catalog::where('nap', $nap)->delete();
        return response()->json(['success' => 'success'], 200);
    }

    protected function errorResponse($code, $message = null)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}

}
