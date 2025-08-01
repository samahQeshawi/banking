<?php

namespace App\Http\Requests\Base\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'user_id' => 'required|int|exists:users,id',
            'name' => 'required|string|min:3|max:255',
            'category_id' => 'nullable|int|exists:categories,id',
            'iban' => 'nullable|string|min:3|max:255',
            'logo' => 'nullable|string|min:3|max:255',
            'order_type' => 'nullable|in:scheduled,current',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'has_driver' => 'required|boolean',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'required|boolean',
        ];
    }
}
