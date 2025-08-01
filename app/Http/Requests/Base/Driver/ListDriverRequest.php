<?php

namespace App\Http\Requests\Base\Driver;

use Illuminate\Foundation\Http\FormRequest;

class ListDriverRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'nullable|string|min:3|max:255',
            'phone' => 'required|string|min:3|max:255',
            'email_verified_at' => 'nullable|date',
            'password' => 'required|string|min:3|max:255',
            'photo' => 'nullable|string|min:3|max:255',
            'vehicle_type' => 'nullable|string|min:3|max:255',
            'vehicle_license_plate' => 'nullable|string|min:3|max:255',
            'is_available' => 'required|boolean',
            'latitude' => 'nullable|decimal:8,10',
            'longitude' => 'nullable|decimal:8,11',
            'status' => 'required|string|min:3|max:255',
            'license_photo' => 'nullable|string|min:3|max:255',
            'language' => 'required|string|min:3|max:10',
            'remember_token' => 'nullable|string|min:3|max:100',
        ];
    }
}
