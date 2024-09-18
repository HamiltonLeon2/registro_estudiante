<?php

// app/Http/Controllers/ExportController.php

namespace App\Http\Controllers;


use App\Models\Postulante;
use App\Models\Estudiante;

use Illuminate\Support\Facades\DB;

use PDF;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EntesExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ente;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function pdf(Request $request)
    {
        $fecha = Carbon::now()->format('d/m/Y');
        // Obtener los IDs de los entes seleccionados 
        $selectedEntesIds = $request->input('selectedEntes');
        if (empty($selectedEntesIds)) {
            return redirect()->back()->with('error', 'Debe seleccionar al menos un ente para generar el PDF.');
        }

        // Obtener los datos de los entes seleccionados
        $selectedEntes = Ente::whereIn('id', $selectedEntesIds)->withCount('postulantes')->get();
        $observaciones = $request->input('observaciones');

        // Generar el PDF con los entes seleccionados
        $pdf = PDF::loadView('exports.pdf', compact('selectedEntes', 'observaciones', 'fecha'));

        // Pasar las observaciones a la vista del PDF
        $pdf->observaciones = $observaciones;

        // Descargar el PDF
        return $pdf->stream('reporte.pdf');
    }
    public function exportExcel(Request $request)
    {
        $fecha = Carbon::now()->format('d/m/Y');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $selectedEntesIds = $request->input('selectedEntes');

        if (empty($selectedEntesIds)) {
            return redirect()->back()->with('error', 'Debe seleccionar al menos un ente para generar el Excel.');
        }

        $selectedEntes = Ente::whereIn('id', $selectedEntesIds)->withCount('postulantes')->get();
        $observaciones = $request->input('observaciones');

        //Cintillo
        $drawing = new Drawing();
        $drawing->setName('Cintillo');
        $drawing->setDescription('Cintillo');
        $drawing->setPath(public_path('img\cintillo.png')); // ruta de la imagen
        $drawing->setHeight(50); // altura de la imagen
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        //Fecha
        $sheet->mergeCells('A3:B3');
        $sheet->mergeCells('C3:D3');
        $sheet->setCellValue('A3', 'Fecha:');
        $sheet->setCellValue('C3', $fecha);
        //Titulo
        $sheet->mergeCells('A5:J5');
        $sheet->setCellValue('A5', 'Total de postulados por ente');
        $sheet->getStyle('A5:J5')->applyFromArray([
            'font' => [
                'size' => 20,
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getRowDimension('1')->setRowHeight(40);

        

        // Agregar encabezados
        $sheet->mergeCells('A7:C7');
        $sheet->mergeCells('D7:G7');
        $sheet->mergeCells('H7:J7');
        $sheet->setCellValue('A7', 'Id');
        $sheet->setCellValue('D7', 'Ente');
        $sheet->setCellValue('H7', 'Cantidad de registrados');

        //Cuerpo
        $row = 8;
        foreach ($selectedEntes as $selectedEnte) {
            $sheet->setCellValue('A' . $row, $selectedEnte->id);
            $sheet->setCellValue('D' . $row, $selectedEnte->ente);
            $sheet->setCellValue('H' . $row, $selectedEnte->postulantes_count);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="Reporte Total ente.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;

        // $fecha = Carbon::now()->format('d/m/Y');
        // $selectedEntesIds = $request->input('selectedEntes');

        // if (empty($selectedEntesIds)) {
        //     return redirect()->back()->with('error', 'Debe seleccionar al menos un ente para generar el Excel.');
        // }

        // $selectedEntes = Ente::whereIn('id', $selectedEntesIds)->withCount('postulantes')->get();

        // $observaciones = $request->input('observaciones');

        // $export = new EntesExport($selectedEntes, $observaciones, $fecha);

        // return Excel::download($export, 'reporte.xlsx');
    }
    public function exportarAnioPDF()
    {

        $pdf = PDF::loadView('exports.pdfanio');

        return $pdf->stream('postulados_anuales.pdf');
    }
}
