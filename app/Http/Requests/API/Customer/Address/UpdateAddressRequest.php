<?php

namespace App\Http\Requests\API\Customer\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'building_num' => 'nullable|string|min:3|max:255',
            'building_type' => 'nullable|string|min:3|max:255',
            'apartment_num' => 'nullable|string|min:3|max:255',
            'floor' => 'nullable|integer',
            'site_name' => 'nullable|string|min:3|max:255',
            'street' => 'nullable|string|min:3|max:255',
            'additional_info' => 'nullable|string|min:3|max:255',
            'default_address' => 'nullable|boolean',
        ];
    }
}
