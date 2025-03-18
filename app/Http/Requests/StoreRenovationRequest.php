<?php

namespace App\Http\Requests;

use App\Enums\BaseUnitEnum;
use App\Enums\PropertyStatusEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRenovationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_type' => ['required', new Enum(PropertyTypeEnum::class)],
            'property_status' => ['required', new Enum(PropertyStatusEnum::class)],
            'base_unit' => ['required', new Enum(BaseUnitEnum::class)],
            'size' => 'required|min:1|max:999',
            'number_of_rooms' => 'required|array',
            'number_of_rooms.*' => 'nullable|string|in:0,1,2,3,4,5+',
            'main' => 'required',
            'additional' => 'nullable',
        ];
    }
}
