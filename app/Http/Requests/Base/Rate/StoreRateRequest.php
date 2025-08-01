<?php

namespace App\Http\Requests\Base\Rate;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
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
            'customer_id' => 'required|int|exists:customers,id',
            'order_id' => 'required|int|exists:orders,id',
            'restaurant_id' => 'required|int|exists:restaurants,id',
            'driver_id' => 'nullable|int|exists:drivers,id',
            'restaurant_rate' => 'required|int',
            'driver_rate' => 'required|int',
            'comment' => 'nullable|string|min:3|max:255',
        ];
    }
}
