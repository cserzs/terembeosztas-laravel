<?php
namespace App\Libraries;

use App\Models\Room;
use App\Models\Catalog;
use App\Models\Schoolclass;

class CatalogManager {

    /*
    private static $instance = null;

    public static function ins() {
        if (self::$instance == null) {
            self::$instance = new CatalogManager();
        }
        return self::$instance;
    }

    private function __construct() {}
    */

    /**
     * Osztalyonkent csoportositott teremrend.
     * Formatum
     *  {
     *      class_id: id,
     *      roomcatalog: [ [roomid, roomid], [], ...]
     *  }
     */
    public static function getCatalogOfDay($day) {
        $osztalyok = Schoolclass::orderBy('evfolyam')->orderBy('rovid_nev')->get();
        $beosztas = array();
        foreach($osztalyok as $osztaly) {
            $beosztas[$osztaly->id] = array();
            for($idopont = 0; $idopont < 9; $idopont++) {
                $beosztas[$osztaly->id][$idopont] = array();
            }
        }

        $catalogs = Catalog::where('nap', $day)
            ->orderBy('osztaly_id')
            ->orderBy('idopont')
            ->orderBy('pozicio')
            ->get();
        foreach($catalogs as $item) {
            $beosztas[$item->osztaly_id][$item->idopont][] = (int)$item->terem_id;
        }
        
        $result = array();
        foreach($beosztas as $key => $value) {
            $result[] = array(
                'class_id' => $key,
                'roomcatalog' => $value
            );
        }

        return $result;
    }

    public static function getCatalogForPdf() {
        $osztalyok = Schoolclass::orderBy('evfolyam')->orderBy('rovid_nev')->get();

        $beosztas = array();
        foreach($osztalyok as $osztaly) {
            $beosztas[$osztaly->id] = array();
            for($nap = 0; $nap < 5; $nap++) {
                $beosztas[$osztaly->id][$nap] = array();
                for($idopont = 0; $idopont < 9; $idopont++) {
                    $beosztas[$osztaly->id][$nap][$idopont] = array();
                }
            }
        }

        $catalog = Catalog::orderBy('osztaly_id')
            ->orderBy('nap')->orderBy('idopont')
            ->orderBy('pozicio')->get();
        foreach($catalog as $item) {
            $beosztas[$item->osztaly_id][$item->nap][$item->idopont][] = $item->terem_id;
        }

        return $beosztas;
    }

    public static function getEmptyRooms() {
        //  az 1-es spec terem
        $termek = Room::where('id', '<>', 1)->orderBy('rovid_nev')->get();

        //  ne legyenek benne a listaban
        $exceptions = array('133', '417');

        $uresek = array();
        for($i = 0; $i < 5; $i++)
        {
            $uresek[$i] = array();
            for($idopont = 0; $idopont <= 9; $idopont++)
            {
                $uresek[$i][$idopont] = array();
                foreach($termek as $terem)
                {
                    if ($idopont > 0 && $idopont < 7 && in_array($terem->rovid_nev, $exceptions)) continue;
                    $uresek[$i][$idopont][] = $terem->id;
                }
            }
        }

        $catalog = Catalog::orderBy('nap')->orderBy('idopont')->orderBy('pozicio')->get();
        foreach($catalog as $row)
        {
            $nap = $row->nap;
            $idopont = $row->idopont;
            $terem = $row->terem_id;
            
            if (($key = array_search($terem, $uresek[$nap][$idopont])) !== false)
            {
                unset($uresek[$nap][$idopont][$key]);
            }        
        }
        return $uresek;        
    }
}