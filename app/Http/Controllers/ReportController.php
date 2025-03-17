<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function downloadReport()
    {
        $reportData = [
            'number' => 'INV-20250317',
            'date' => now()->format('d/m/Y'),
            'items' => [
                ['name' => 'Produk A', 'qty' => 2, 'price' => 100000],
                ['name' => 'Produk B', 'qty' => 1, 'price' => 150000],
            ],
            'total' => 350000,
        ];

        $pdf = Pdf::loadView('pdf.report', ['report' => $reportData]);

        return $pdf->download('report-' . $reportData['number'] . '.pdf');
    }
}
