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

        return $pdf->download('report-'.$reportData['number'].'.pdf');
    }

    public function streamReport()
    {
        $reportData = [
            'number' => 'INV-20250317',
            'date' => now()->format('d/m/Y'),
            'property_type' => 'Condo',
            'property_status' => 'New',
            'size' => number_format(1100, 0, ',', '.'),
            'base_unit' => 'm2',
            'items' => [
                ['name' => 'Produk A', 'qty' => 2, 'price' => 100000],
                ['name' => 'Produk B', 'qty' => 1, 'price' => 150000],
            ],
            'total' => 350000,
            'minimum_budget_range' => number_format(34500, 0, '.', ','),
            'maximum_budget_range' => number_format(41600, 0, '.', ','),
        ];

        $pdf = Pdf::loadView('pdf.report', $reportData);

        return $pdf->stream('report-'.$reportData['number'].'.pdf');
    }
}
