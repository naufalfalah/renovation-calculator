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

        $pdf = Pdf::loadView('pdf.report', $report);
        $pdfContent = $pdf->output();

        Mail::to($email)->send(new ReportMail($report, $pdfContent));

        // return $pdf->stream('report.pdf');
        return response()->json([
            'success' => true,
            'message' => 'Email berhasil dikirim dengan PDF!',
            'data' => [
                'email' => $email,
                'budget_range' => $result['budget_range'],
            ],
        ]);
    }
}
