<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schoolclass;
use App\Models\Catalog;
use App\Libraries\CatalogManager;
use App\Libraries\CatalogExportManager;
use App\Libraries\EmptyroomsExportManager;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function catalogToPdf() {

        $termek = Room::getForPdf();
        $osztalyok = Schoolclass::getForPdf();
        $teremrend = CatalogManager::getCatalogForPdf();

        $napok = array("Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek");
        $idopontok = array(0, 1, 2, 3, 4, 5, 6, 7, 8);

        $pdfExport = new CatalogExportManager();
        $pdf = $pdfExport->toPdf($osztalyok, $termek, $teremrend, $napok, $idopontok);

        return response($pdf->Output('terembeosztas.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');
    }

    public function emptyroomsToPdf() {
        $termek = Room::getForPdf();  
        $urestermek = CatalogManager::getEmptyRooms();
        $idopontok = array(0, 1, 2, 3, 4, 5, 6, 7, 8);
        $napok = array("Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek");

        $pdfExport = new EmptyroomsExportManager();
        $pdf = $pdfExport->toPdf($termek, $urestermek, $napok, $idopontok);

        return response($pdf->Output('urestermek.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
