<?php

namespace App\Http\Controllers;

use App\Enums\BaseUnitEnum;
use App\Enums\PropertyStatusEnum;
use App\Enums\PropertyTypeEnum;
use App\Http\Requests\StoreRenovationRequest;
use App\Models\OtherWork;
use App\Models\Renovation;
use App\Models\Room;

class RenovationController extends Controller
{
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
        dd($request->all());

        Renovation::create([
            'property_type' => $request->property_type,
            'property_status' => $request->property_status,
            'base_unit' => $request->base_unit,
            'size' => $request->size,
            'main' => $request->main,
            'additional' => $request->additional,
        ]);
    }
}
