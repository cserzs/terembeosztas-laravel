<?php
namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Catalog extends Model
{
    use HasFactory;

    protected $casts = [
        'osztaly_id' => 'integer',
        'nap' => 'integer',
        'idopont' => 'integer',
        'pozicio' => 'integer',
        'terem_id' => 'integer',
    ];

    /**
     * Egy osztaly terembeosztasat adja vissza egyszeru, egymasba agyazott tomb formaban!
     * Formatum:
     * array(
     *      'nap_0' => array(
     *          'idopont_0' => array(terem_id, terem_id, ...)
     *          'idopont_1' => array(terem_id, terem_id, ...)
     *          ...
     *      ),
     *      'nap_1' => array(
     *          'idopont_0' => array(terem_id, terem_id, ...)
     *          'idopont_1' => array(terem_id, terem_id, ...)
     *          ...
     *      )
     *      ...
     * )
     */
    public static function getForClass($osztalyId) {
        $catalog = Catalog::where('osztaly_id', $osztalyId)
            ->orderBy('nap')
            ->orderBy('idopont')
            ->orderBy('pozicio')
            ->with('room')
            ->get();
        
        $teremrend = array();
        for($nap = 0; $nap < 5; $nap++) {
            $teremrend[$nap] = array();
            for($idopont = 0; $idopont < 9; $idopont++) {
                $teremrend[$nap][$idopont] = array();
            }
        }
        foreach($catalog as $item) {
            $teremrend[$item->nap][$item->idopont][$item->pozicio] = $item->room->rovid_nev;
        }
        return $teremrend;
    }

    public static function isDayValid($day) {
        return ($day >= 0 && $day < 5);
    }

    public static function isTimeValid($t) {
        return ($t >= 0 && $t < 9);
    }

    public static function isPositionValid($pos) {
        return $pos >= 0;
    }

    public function room() {
        return $this->belongsTo(Room::class, 'terem_id');
    }
}
