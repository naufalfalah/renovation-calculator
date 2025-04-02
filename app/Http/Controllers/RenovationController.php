<?php

namespace App\Http\Controllers;

use App\Enums\BaseUnitEnum;
use App\Enums\PropertyStatusEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Requests\StoreRenovationRequest;
use App\Mail\ReportMail;
use App\Models\OtherWork;
use App\Models\OtherWorkPackage;
use App\Models\Renovation;
use App\Models\Room;
use App\Models\Work;
use App\Models\WorkPackage;
use App\Services\BudgetCalculationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

require_once base_path('vendor/ianw/quickchart/QuickChart.php');

class RenovationController extends Controller
{
    protected BudgetCalculationService $service;

    public function __construct()
    {
        $this->service = new BudgetCalculationService;
    }

    public function index()
    {
        $propertyTypes = PropertyTypeEnum::cases();
        $propertyStatuses = PropertyStatusEnum::cases();
        $baseUnit = BaseUnitEnum::SQFT;
        $roomsWithQuanity = Room::where('have_quantity', true)->get();
        $rooms = Room::all();
        $living = Room::find(1);
        $kitchen = Room::find(2);
        $bedroom = Room::find(3);
        $bathroom = Room::find(4);
        $otherWorks = OtherWork::all();

        return view('index', compact('propertyTypes', 'propertyStatuses', 'baseUnit', 'roomsWithQuanity', 'rooms', 'living', 'kitchen', 'bedroom', 'bathroom', 'otherWorks'));
    }

    public function store(StoreRenovationRequest $request)
    {
        // dd($request->all());

        $propertyType = $request->property_type;
        $propertyStatus = $request->property_status;
        $main = $request->main;
        $additional = $request->additional;
        $email = $request->email;

        $rooms = array_keys($main);
        $roomLabels = [];
        foreach ($rooms as $key => $value) {
            $roomLabels[] = ucfirst(strtolower($value));
        }

        $userSelection = [];
        foreach ($main as $roomName => $works) {
            if ($roomName === 'living') {
                $room = Room::find(1);
            } else if ($roomName === 'kitchen') {
                $room = Room::find(2);
            } else if ($roomName === 'bedroom') {
                $room = Room::find(3);
            } else if ($roomName === 'bathroom') {
                $room = Room::find(4);
            }

            foreach ($works as $workId => $workPackageId) {
                $work = Work::find($workId);
                $workPackage = WorkPackage::find($workPackageId);
                $works[$workId] = $workPackage;

                $userSelection[] = [
                    'room' => $room,
                    'work' => $work,
                    'work_package' => $workPackage,
                ];
            }
        }
        // dd($userSelection);

        $result = $this->service->calculate($propertyType, $userSelection);
        // dd($result);

        $works = [];
        foreach ($main as $room) {
            foreach ($room as $workId => $workPackageId) {
                $workPackage = WorkPackage::find($workPackageId);
                $works[$workId] = $workPackage;
            }
        }

        $otherWorks = [];
        if ($additional) {
            foreach ($additional as $otherWorkId => $otherWorkPackageId) {
                $otherWorkPackage = OtherWorkPackage::find($otherWorkPackageId);
                $otherWorks[$otherWorkId] = $otherWorkPackage;
            }
        }

        $report = [
            'date' => date('jS F Y'),
            'property_type' => $propertyType,
            'property_status' => $request->property_status,
            'base_unit' => $request->base_unit,
            'size' => $request->size,
            'number_of_rooms' => $request->number_of_rooms,
            'rooms' => $request->rooms,
            'room_labels' => $roomLabels,
            'main' => $main,
            'works' => $works,
            'other_works' => $otherWorks,
            'full_name' => 'Naufal',
            'email' => $email,
            'country_code' => $request->country_code,
            'contact_number' => $request->contact_number,
            'shortlist_designers' => 'on',
            'accept_terms' => 'on',
            'result' => $result,
        ];
        // dd($report);

        Renovation::create([
            'property_type' => $propertyType,
            'property_status' => $propertyStatus,
            'base_unit' => $request->base_unit,
            'size' => $request->size,
            // 'main' => $request->main,
            // 'additional' => $request->additional,
        ]);

        $chartFolder = public_path('chart');
        if (!file_exists($chartFolder)) {
            mkdir($chartFolder, 0777, true);
        }

        $qcWork = new \QuickChart();
        $qcWork->setWidth(500);
        $qcWork->setHeight(300);
        $qcWork->setFormat('png');

        $qcWork->setConfig(json_encode([
            'type' => 'pie',
            'data' => [
                // 'labels' => array_keys($report['result']['work_percentages']),
                'datasets' => [[
                    'data' => array_values($report['result']['work_percentages']),
                    'backgroundColor' => array_slice($report['result']['work_colors'], 0, count($report['result']['work_percentages'])),
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'datalabels' => [
                        'display' => false
                    ]
                ]
            ]
        ]));

        $workChartName = 'work_chart_' . date('Y-m-d H:i:s') . '.png';
        $workChartPath = $chartFolder . '/' . $workChartName;
        file_put_contents($workChartPath, $qcWork->toBinary());

        // Room Chart
        $qcRoom = new \QuickChart();
        $qcRoom->setWidth(500);
        $qcRoom->setHeight(300);
        $qcRoom->setFormat('png');

        $qcRoom->setConfig(json_encode([
            'type' => 'pie',
            'data' => [
                // 'labels' => array_keys($report['result']['room_percentages']),
                'datasets' => [[
                    'data' => array_values($report['result']['room_percentages']),
                    'backgroundColor' => array_slice($report['result']['room_colors'], 0, count($report['result']['room_percentages'])),
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'datalabels' => [
                        'display' => false
                    ]
                ]
            ]
        ]));

        $roomChartName = 'room_chart_' . date('Y-m-d H:i:s') . '.png';
        $roomChartPath = $chartFolder . '/' . $roomChartName;
        file_put_contents($roomChartPath, $qcRoom->toBinary());

        $report['work_image_path'] = $workChartPath;
        $report['room_image_path'] = $roomChartPath;

        $pdf = Pdf::loadView('pdf.report', $report);
        $pdfContent = $pdf->output();

        if (!file_exists(public_path('pdf'))) {
            mkdir(public_path('pdf'), 0777, true);
        }

        $pdfFileName = 'renovation_report_' . time() . '.pdf';
        $pdfPath = public_path('pdf/' . $pdfFileName);
        $pdf->save($pdfPath);

        Mail::to($email)->send(new ReportMail($report, $pdfContent));

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil dikirim dengan PDF!',
            'data' => [
                'email' => $email,
                'budget_range' => $result['budget_range'],
                'pdf_url' => asset('pdf/' . $pdfFileName),
            ],
        ]);
    }

    public function pdf()
    {
        $report = [
            'date' => date('jS F Y'),
            'property_type' => 'hdb',
            'property_status' => 'new',
            'number_of_rooms' => [
                3 => 1,
                4 => 1,
            ],
            'rooms' => [],
            'room_labels' => [],
            'shortlist_designers' => 'on',
            'accept_terms' => 'on',
            'result' => [
                "budget_range" => "$10,040 - $14,060",
                "work_percentages" => [
                    "Hacking" => 4.0,
                    "Masonry" => 28.0,
                    "Carpentry" => 4.0,
                    "Ceiling & Partition" => 4.0,
                    "Plumbing" => 4.0,
                    "Electrical" => 14.67,
                    "Painting" => 14.67,
                    "Glass & Aluminium" => 21.33,
                    "Cleaning & Polishing" => 5.33,
                ],
                "work_budgets" => [
                    "Hacking" => 4.0,
                    "Masonry" => 28.0,
                    "Carpentry" => 4.0,
                    "Ceiling & Partition" => 4.0,
                    "Plumbing" => 4.0,
                    "Electrical" => 14.67,
                    "Painting" => 14.67,
                    "Glass & Aluminium" => 21.33,
                    "Cleaning & Polishing" => 5.33,
                ],
                "work_colors" => [
                    '#3498db', '#e84393', '#f1c40f', '#2ecc71',
                    '#9b59b6', '#34495e', '#16a085', '#d35400', '#c0392b'
                ],
                "room_percentages" => [
                    "Living/Dining" => 25.0,
                    "Kitchen" => 25.0,
                    "Bedroom" => 25.0,
                    "Bathroom" => 25.0,
                ],
                "room_budgets" => [
                    "Living/Dining" => 25.0,
                    "Kitchen" => 25.0,
                    "Bedroom" => 25.0,
                    "Bathroom" => 25.0,
                ],
                "room_colors" => [
                    '#e67e22', '#e74c3c', '#8e44ad', '#3498db'
                ],
                "market_position" => "lower-end range",
            ],
        ];
        // dd($report);

        $chartFolder = public_path('chart');
        if (!file_exists($chartFolder)) {
            mkdir($chartFolder, 0777, true);
        }

        $qcWork = new \QuickChart();
        $qcWork->setWidth(500);
        $qcWork->setHeight(300);
        $qcWork->setFormat('png');

        $qcWork->setConfig(json_encode([
            'type' => 'pie',
            'data' => [
                // 'labels' => array_keys($report['result']['work_percentages']),
                'datasets' => [[
                    'data' => array_values($report['result']['work_percentages']),
                    'backgroundColor' => array_slice($report['result']['work_colors'], 0, count($report['result']['work_percentages'])),
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'datalabels' => [
                        'display' => false
                    ]
                ]
            ]
        ]));

        $workChartName = 'work_chart_' . date('Y-m-d H:i:s') . '.png';
        $workChartPath = $chartFolder . '/' . $workChartName;
        file_put_contents($workChartPath, $qcWork->toBinary());

        // Room Chart
        $qcRoom = new \QuickChart();
        $qcRoom->setWidth(500);
        $qcRoom->setHeight(300);
        $qcRoom->setFormat('png');

        $qcRoom->setConfig(json_encode([
            'type' => 'pie',
            'data' => [
                // 'labels' => array_keys($report['result']['room_percentages']),
                'datasets' => [[
                    'data' => array_values($report['result']['room_percentages']),
                    'backgroundColor' => array_slice($report['result']['room_colors'], 0, count($report['result']['room_percentages'])),
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'datalabels' => [
                        'display' => false
                    ]
                ]
            ]
        ]));

        $roomChartName = 'room_chart_' . date('Y-m-d H:i:s') . '.png';
        $roomChartPath = $chartFolder . '/' . $roomChartName;
        file_put_contents($roomChartPath, $qcRoom->toBinary());

        $report['work_image_path'] = $workChartPath;
        $report['room_image_path'] = $roomChartPath;

        // Generate PDF
        $pdf = Pdf::loadView('pdf.report', $report);
        return $pdf->stream('report.pdf');

        // return view('pdf.report', $report);
    }

    public function web()
    {
        $report = [
            'date' => date('jS F Y'),
            'property_type' => 'hdb',
            'property_status' => 'new',
            'number_of_rooms' => [
                3 => 1,
                4 => 1,
            ],
            'rooms' => [],
            'room_labels' => [],
            'shortlist_designers' => 'on',
            'accept_terms' => 'on',
            'result' => [
                "budget_range" => "$10,040 - $14,060",
                "work_percentages" => [
                    "Hacking" => 4.0,
                    "Masonry" => 28.0,
                    "Carpentry" => 4.0,
                    "Ceiling & Partition" => 4.0,
                    "Plumbing" => 4.0,
                    "Electrical" => 14.67,
                    "Painting" => 14.67,
                    "Glass & Aluminium" => 21.33,
                    "Cleaning & Polishing" => 5.33,
                ],
                "work_budgets" => [
                    "Hacking" => 4.0,
                    "Masonry" => 28.0,
                    "Carpentry" => 4.0,
                    "Ceiling & Partition" => 4.0,
                    "Plumbing" => 4.0,
                    "Electrical" => 14.67,
                    "Painting" => 14.67,
                    "Glass & Aluminium" => 21.33,
                    "Cleaning & Polishing" => 5.33,
                ],
                "work_colors" => [
                    '#3498db', '#e84393', '#f1c40f', '#2ecc71',
                    '#9b59b6', '#34495e', '#16a085', '#d35400', '#c0392b'
                ],
                "room_percentages" => [
                    "Living/Dining" => 25.0,
                    "Kitchen" => 25.0,
                    "Bedroom" => 25.0,
                    "Bathroom" => 25.0,
                ],
                "room_budgets" => [
                    "Living/Dining" => 25.0,
                    "Kitchen" => 25.0,
                    "Bedroom" => 25.0,
                    "Bathroom" => 25.0,
                ],
                "room_colors" => [
                    '#e67e22', '#e74c3c', '#8e44ad', '#3498db'
                ],
                "market_position" => "lower-end range",
            ],
        ];
        // dd($report);

        $chartFolder = public_path('chart');
        if (!file_exists($chartFolder)) {
            mkdir($chartFolder, 0777, true);
        }

        $qcWork = new \QuickChart();
        $qcWork->setWidth(500);
        $qcWork->setHeight(300);
        $qcWork->setFormat('png');

        $qcWork->setConfig(json_encode([
            'type' => 'pie',
            'data' => [
                // 'labels' => array_keys($report['result']['work_percentages']),
                'datasets' => [[
                    'data' => array_values($report['result']['work_percentages']),
                    'backgroundColor' => array_slice($report['result']['work_colors'], 0, count($report['result']['work_percentages'])),
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'datalabels' => [
                        'display' => false
                    ]
                ]
            ]
        ]));

        $workChartName = 'work_chart_' . date('Y-m-d H:i:s') . '.png';
        $workChartPath = $chartFolder . '/' . $workChartName;
        file_put_contents($workChartPath, $qcWork->toBinary());

        // Room Chart
        $qcRoom = new \QuickChart();
        $qcRoom->setWidth(500);
        $qcRoom->setHeight(300);
        $qcRoom->setFormat('png');

        $qcRoom->setConfig(json_encode([
            'type' => 'pie',
            'data' => [
                // 'labels' => array_keys($report['result']['room_percentages']),
                'datasets' => [[
                    'data' => array_values($report['result']['room_percentages']),
                    'backgroundColor' => array_slice($report['result']['room_colors'], 0, count($report['result']['room_percentages'])),
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => [
                        'display' => false,
                    ],
                    'datalabels' => [
                        'display' => false
                    ]
                ]
            ]
        ]));

        $roomChartName = 'room_chart_' . date('Y-m-d H:i:s') . '.png';
        $roomChartPath = $chartFolder . '/' . $roomChartName;
        file_put_contents($roomChartPath, $qcRoom->toBinary());

        $report['work_image_path'] = $workChartPath;
        $report['room_image_path'] = $roomChartPath;

        return view('pdf.report', $report);
    }
}
